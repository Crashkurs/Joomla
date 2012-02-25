<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionFileDownloader{
	var $formname;
	var $formid;
	var $group = array('id' => 'form_utilities', 'title' => 'Utilities');
	var $details = array('title' => 'File Downloader', 'tooltip' => 'Start a file download.');
	var $_headers = array();
	
	function run($form, $actiondata){
		$params = new JParameter($actiondata->params);
		$mainframe =& JFactory::getApplication();
		//check download type
		$dest = $params->get('type', 'D');
		$file_name = $params->get('file_name', '');
		$extension = strtolower(array_pop(explode('.', $file_name)));
		$downloads_path = $params->get('downloads_path', '');
		if(!empty($downloads_path)){
			$downloads_path = str_replace(array("/", "\\"), DS, $downloads_path);
			if(substr($downloads_path, -1) == DS){
				$downloads_path = substr_replace($downloads_path, '', -1);
			}
			$downloads_path = $downloads_path.DS;
			$params->set('downloads_path', $downloads_path);
		}else{
			//file name is empty
			$form->debug['file_downloader'][] = "File path provided is empty(wrong)!";
		}
		$file_path = $downloads_path.$params->get('file_name', '');
		if(!file_exists($file_path)){
			//file doesn't exist
			$form->debug['file_downloader'][] = "The file path doesn't exist: ".$file_path;
		}
		$mime = $this->get_mimes($file_path, $extension);
		if ($mime !== false && connection_status() == 0) {
			$chunkSize = 8192;
			$buffer = '';
			$fileSize = @filesize($file_path);
			$handle = fopen($file_path, 'rb');

			if ($handle === false) {
				return false;
			}
			
			//change later
			$modified = null;
			if (!empty($modified)) {
				$modified = gmdate('D, d M Y H:i:s', strtotime($modified, time())) . ' GMT';
			} else {
				$modified = gmdate('D, d M Y H:i:s') . ' GMT';
			}

			if ($dest == 'D') {
				$contentTypes = array('application/octet-stream');
				$agent = $_SERVER['HTTP_USER_AGENT'];

				if (preg_match('%Opera(/| )([0-9].[0-9]{1,2})%', $agent)) {
					$contentTypes[0] = 'application/octetstream';
				} else if (preg_match('/MSIE ([0-9].[0-9]{1,2})/', $agent)) {
					$contentTypes[0] = 'application/force-download';
					array_merge($contentTypes, array(
						'application/octet-stream',
						'application/download'
					));
				}
				foreach($contentTypes as $contentType) {
					$this->_header('Content-Type: ' . $contentType);
				}
				$this->_header(array(
					'Content-Disposition: attachment; filename="' . $file_name . '";',
					'Expires: 0',
					'Accept-Ranges: bytes',
					'Cache-Control: private' => false,
					'Pragma: private'));

				$httpRange = $_SERVER['HTTP_RANGE'];
				if (isset($httpRange)) {
					list($toss, $range) = explode('=', $httpRange);

					$size = $fileSize - 1;
					$length = $fileSize - $range;

					$this->_header(array(
						'HTTP/1.1 206 Partial Content',
						'Content-Length: ' . $length,
						'Content-Range: bytes ' . $range . $size . '/' . $fileSize));

					fseek($handle, $range);
				} else {
					$this->_header('Content-Length: ' . $fileSize);
				}
			} else {
				$this->_header('Date: ' . gmdate('D, d M Y H:i:s', time()) . ' GMT');
				if ($cache) {
					if (!is_numeric($cache)) {
						$cache = strtotime($cache) - time();
					}
					$this->_header(array(
						'Cache-Control: max-age=' . $cache,
						'Expires: ' . gmdate('D, d M Y H:i:s', time() + $cache) . ' GMT',
						'Pragma: cache'));
				} else {
					$this->_header(array(
						'Cache-Control: must-revalidate, post-check=0, pre-check=0',
						'Pragma: no-cache'));
				}
				$this->_header(array(
					'Last-Modified: ' . $modified,
					'Content-Type: ' . $mime,
					'Content-Length: ' . $fileSize));
			}
			$this->_output();
			$this->_clearBuffer();

			while (!feof($handle)) {
				if (!$this->_isActive()) {
					fclose($handle);
					return false;
				}
				set_time_limit(0);
				$buffer = fread($handle, $chunkSize);
				echo $buffer;
				$this->_flushBuffer();
			}
			fclose($handle);
			return;
		}
		return false;
	}
	
	function get_mimes($filename, $ext){
		$mimeType = array(
		'ai' => 'application/postscript', 'bcpio' => 'application/x-bcpio', 'bin' => 'application/octet-stream',
		'ccad' => 'application/clariscad', 'cdf' => 'application/x-netcdf', 'class' => 'application/octet-stream',
		'cpio' => 'application/x-cpio', 'cpt' => 'application/mac-compactpro', 'csh' => 'application/x-csh',
		'csv' => 'application/csv', 'dcr' => 'application/x-director', 'dir' => 'application/x-director',
		'dms' => 'application/octet-stream', 'doc' => 'application/msword', 'drw' => 'application/drafting',
		'dvi' => 'application/x-dvi', 'dwg' => 'application/acad', 'dxf' => 'application/dxf',
		'dxr' => 'application/x-director', 'eot' => 'application/vnd.ms-fontobject', 'eps' => 'application/postscript',
		'exe' => 'application/octet-stream', 'ez' => 'application/andrew-inset',
		'flv' => 'video/x-flv', 'gtar' => 'application/x-gtar', 'gz' => 'application/x-gzip',
		'bz2' => 'application/x-bzip', '7z' => 'application/x-7z-compressed', 'hdf' => 'application/x-hdf',
		'hqx' => 'application/mac-binhex40', 'ico' => 'image/vnd.microsoft.icon', 'ips' => 'application/x-ipscript',
		'ipx' => 'application/x-ipix', 'js' => 'application/x-javascript', 'latex' => 'application/x-latex',
		'lha' => 'application/octet-stream', 'lsp' => 'application/x-lisp', 'lzh' => 'application/octet-stream',
		'man' => 'application/x-troff-man', 'me' => 'application/x-troff-me', 'mif' => 'application/vnd.mif',
		'ms' => 'application/x-troff-ms', 'nc' => 'application/x-netcdf', 'oda' => 'application/oda',
		'otf' => 'font/otf', 'pdf' => 'application/pdf',
		'pgn' => 'application/x-chess-pgn', 'pot' => 'application/mspowerpoint', 'pps' => 'application/mspowerpoint',
		'ppt' => 'application/mspowerpoint', 'ppz' => 'application/mspowerpoint', 'pre' => 'application/x-freelance',
		'prt' => 'application/pro_eng', 'ps' => 'application/postscript', 'roff' => 'application/x-troff',
		'scm' => 'application/x-lotusscreencam', 'set' => 'application/set', 'sh' => 'application/x-sh',
		'shar' => 'application/x-shar', 'sit' => 'application/x-stuffit', 'skd' => 'application/x-koan',
		'skm' => 'application/x-koan', 'skp' => 'application/x-koan', 'skt' => 'application/x-koan',
		'smi' => 'application/smil', 'smil' => 'application/smil', 'sol' => 'application/solids',
		'spl' => 'application/x-futuresplash', 'src' => 'application/x-wais-source', 'step' => 'application/STEP',
		'stl' => 'application/SLA', 'stp' => 'application/STEP', 'sv4cpio' => 'application/x-sv4cpio',
		'sv4crc' => 'application/x-sv4crc', 'svg' => 'image/svg+xml', 'svgz' => 'image/svg+xml',
		'swf' => 'application/x-shockwave-flash', 't' => 'application/x-troff',
		'tar' => 'application/x-tar', 'tcl' => 'application/x-tcl', 'tex' => 'application/x-tex',
		'texi' => 'application/x-texinfo', 'texinfo' => 'application/x-texinfo', 'tr' => 'application/x-troff',
		'tsp' => 'application/dsptype', 'ttf' => 'font/ttf',
		'unv' => 'application/i-deas', 'ustar' => 'application/x-ustar',
		'vcd' => 'application/x-cdlink', 'vda' => 'application/vda', 'xlc' => 'application/vnd.ms-excel',
		'xll' => 'application/vnd.ms-excel', 'xlm' => 'application/vnd.ms-excel', 'xls' => 'application/vnd.ms-excel',
		'xlw' => 'application/vnd.ms-excel', 'zip' => 'application/zip', 'aif' => 'audio/x-aiff', 'aifc' => 'audio/x-aiff',
		'aiff' => 'audio/x-aiff', 'au' => 'audio/basic', 'kar' => 'audio/midi', 'mid' => 'audio/midi',
		'midi' => 'audio/midi', 'mp2' => 'audio/mpeg', 'mp3' => 'audio/mpeg', 'mpga' => 'audio/mpeg',
		'ra' => 'audio/x-realaudio', 'ram' => 'audio/x-pn-realaudio', 'rm' => 'audio/x-pn-realaudio',
		'rpm' => 'audio/x-pn-realaudio-plugin', 'snd' => 'audio/basic', 'tsi' => 'audio/TSP-audio', 'wav' => 'audio/x-wav',
		'asc' => 'text/plain', 'c' => 'text/plain', 'cc' => 'text/plain', 'css' => 'text/css', 'etx' => 'text/x-setext',
		'f' => 'text/plain', 'f90' => 'text/plain', 'h' => 'text/plain', 'hh' => 'text/plain', 'htm' => 'text/html',
		'html' => 'text/html', 'm' => 'text/plain', 'rtf' => 'text/rtf', 'rtx' => 'text/richtext', 'sgm' => 'text/sgml',
		'sgml' => 'text/sgml', 'tsv' => 'text/tab-separated-values', 'tpl' => 'text/template', 'txt' => 'text/plain',
		'xml' => 'text/xml', 'avi' => 'video/x-msvideo', 'fli' => 'video/x-fli', 'mov' => 'video/quicktime',
		'movie' => 'video/x-sgi-movie', 'mpe' => 'video/mpeg', 'mpeg' => 'video/mpeg', 'mpg' => 'video/mpeg',
		'qt' => 'video/quicktime', 'viv' => 'video/vnd.vivo', 'vivo' => 'video/vnd.vivo', 'gif' => 'image/gif',
		'ief' => 'image/ief', 'jpe' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'jpg' => 'image/jpeg',
		'pbm' => 'image/x-portable-bitmap', 'pgm' => 'image/x-portable-graymap', 'png' => 'image/png',
		'pnm' => 'image/x-portable-anymap', 'ppm' => 'image/x-portable-pixmap', 'ras' => 'image/cmu-raster',
		'rgb' => 'image/x-rgb', 'tif' => 'image/tiff', 'tiff' => 'image/tiff', 'xbm' => 'image/x-xbitmap',
		'xpm' => 'image/x-xpixmap', 'xwd' => 'image/x-xwindowdump', 'ice' => 'x-conference/x-cooltalk',
		'iges' => 'model/iges', 'igs' => 'model/iges', 'mesh' => 'model/mesh', 'msh' => 'model/mesh',
		'silo' => 'model/mesh', 'vrml' => 'model/vrml', 'wrl' => 'model/vrml',
		'mime' => 'www/mime', 'pdb' => 'chemical/x-pdb', 'xyz' => 'chemical/x-pdb');
		
		if(function_exists('mime_content_type')){
			return mime_content_type($filename);
		}else{
			//check file extension
			if(isset($mimeType[$ext])){
				return $mimeType[$ext];
			}elseif(function_exists('finfo_open')){
				$finfo = finfo_open(FILEINFO_MIME);
				$mimetype = finfo_file($finfo, $filename);
				finfo_close($finfo);
				return $mimetype;
			}else{
				return 'application/octet-stream';
			}
		}
	}
	
	function _header($header, $boolean = true) {
		if (is_array($header)) {
			foreach ($header as $string => $boolean) {
				if (is_numeric($string)) {
					$this->_headers[] = array($boolean => true);
				} else {
					$this->_headers[] = array($string => $boolean);
				}
			}
			return;
		}
		$this->_headers[] = array($header => $boolean);
		return;
	}
	
	function _output() {
		foreach ($this->_headers as $key => $value) {
			$header = key($value);
			header($header, $value[$header]);
		}
	}
	
	function _isActive() {
		return connection_status() == 0 && !connection_aborted();
	}
	
	function _clearBuffer() {
		return @ob_end_clean();
	}
	
	function _flushBuffer() {
		@flush();
		@ob_flush();
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'type' => 'D',
				'downloads_path' => '',
				'file_name' => ''
			);
		}
		return array('action_params' => $action_params);
	}
	
}
?>
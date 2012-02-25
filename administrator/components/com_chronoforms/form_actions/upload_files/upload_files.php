<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionUploadFiles{
	var $formname;
	var $formid;
	var $events = array('success' => 0, 'fail' => 0);
	var $fail = array('actions' => array('show_HTML'));
	var $details = array('title' => 'Upload Files', 'tooltip' => 'Upload specified files.');
		
	function run($form, $actiondata){
		$params = new JParameter($actiondata->params);
		$files_config = $params->get('files', '');
		if($actiondata->enabled == 1 && !empty($files_config)){
			jimport('joomla.utilities.error');
			jimport('joomla.filesystem.file');
			$upload_path = $params->get('upload_path');
			if(!empty($upload_path)){
				$upload_path = str_replace(array("/", "\\"), DS, $upload_path);
				if(substr($upload_path, -1) == DS){
					$upload_path = substr_replace($upload_path, '', -1);
				}
				$upload_path = $upload_path.DS;
				$params->set('upload_path', $upload_path);
			}else{
				$upload_path = JPATH_SITE.DS.'components'.DS.'com_chronoforms'.DS.'uploads'.DS.$form->form_details->name.DS;
			}
			if(!JFile::exists($upload_path.DS.'index.html')){
				if(!JFolder::create($upload_path)){
					JError::raiseWarning(100, 'Couldn\'t create upload directroy 1');
					$this->events['fail'] = 1;
					return;
				}
				$dummy_c = '<html><body bgcolor="#ffffff"></body></html>';
				if(!JFile::write($upload_path.DS.'index.html', $dummy_c)){
					JError::raiseWarning(100, 'Couldn\'t create upload directroy 2');
					$this->events['fail'] = 1;
					return;
				}
			}
			$files_array = explode(",", trim($params->get('files', '')));
	
			foreach($files_array as $file_string){
				if(strpos($file_string, ':') !== false){
					$file_data = explode(':', trim($file_string));
					$file_extensions = explode('-', $file_data[1]);
					//convert all extensions to lower case
					foreach($file_extensions as $k => $file_extension){
						$file_extensions[$k] = strtolower($file_extension);
					}
					//get the posted file details
					$file_post = JRequest::getVar($file_data[0], array('error' => 99999), 'files', 'array');
					//check errors
					if(isset($file_post['error']) && !empty($file_post['error'])){
						if($file_post['error'] == 99999){
							//the file field type is not present in the posted data
							continue;
						}else if($file_post['error'] == 4 && isset($file_post['name']) && empty($file_post['name']) && isset($file_post['size']) && ($file_post['size'] == 0)){
							//No file has been selected
							continue;
						}
						$form->debug[] = 'PHP returned this error for file upload by : '.$file_data[0].', PHP error is: '.$file_post['error'];
						$form->validation_errors[$file_data[0]] = $file_post['error'];
						$this->events['fail'] = 1;
						return;
					}else{
						$form->debug[] = 'Upload routine started for file upload by : '.$file_data[0];
					}
					if((bool)$params->get('safe_file_name', 1) === true){
						$file_name = JFile::makeSafe($file_post['name']);
					}else{
						$file_name = utf8_decode($file_post['name']);
					}
					$file_tmp_name = $file_post['tmp_name'];
					$file_info = pathinfo($file_name);
					//mask the file name
					$file_name = date('YmdHis').'_'.$file_name;
					//check the file size
					if($file_tmp_name){
						//check max size
						if(($file_post["size"] / 1024) > (int)$params->get('max_size', 100)){
							$form->debug[] = 'File : '.$file_data[0].' size is over the max limit.';
							$form->validation_errors[$file_data[0]] = $params->get('max_error', 'Sorry, Your uploaded file size ('.($file_post["size"] / 1024).' KB) exceeds the allowed limit.');
							$this->events['fail'] = 1;
							return;
						}else if(($file_post["size"] / 1024) < (int)$params->get('min_size', 0)){
							$form->debug[] = 'File : '.$file_data[0].' size is less than the minimum limit.';
							$form->validation_errors[$file_data[0]] = $params->get('min_error', 'Sorry, Your uploaded file size ('.($file_post["size"] / 1024).' KB) is less than the minimum limit.');
							$this->events['fail'] = 1;
							return;
						}else if(!in_array(strtolower($file_info['extension']), $file_extensions)){
							$form->debug[] = 'File : '.$file_data[0].' extension is not allowed.';
							$form->validation_errors[$file_data[0]] = $params->get('type_error', 'Sorry, Your uploaded file type is not allowed.');
							$this->events['fail'] = 1;
							return;
						}else{
							//$upload_path = $params->get('upload_path', JPATH_SITE.DS.'components'.DS.'com_chronoforms'.DS.'uploads'.DS.$form->form_details->name.DS);
							$uploaded_file = JFile::upload($file_tmp_name, $upload_path.$file_name);
							if($uploaded_file){
								$form->files[$file_data[0]] = array('name' => $file_name, 'path' => $upload_path.$file_name, 'size' => $file_post["size"]);
								$form->files[$file_data[0]]['link'] = JURI::Base().'components/com_chronoforms/uploads/'.$form->form_details->name.'/'.$file_name;
								$form->data[$file_data[0]] = $file_name;
								$form->debug[] = $upload_path.$file_name.' has been uploaded OK.';
								$this->events['success'] = 1;
							}else{
								$form->debug[] = $upload_path.$file_name.' could not be uploaded!!';
								$this->events['fail'] = 1;
								return;
							}
						}
					}
				}				
			}
			//add the data key
			if(!isset($form->data['_PLUGINS_']['upload_files'])){
				$form->data['_PLUGINS_']['upload_files'] = array();
			}
			$form->data['_PLUGINS_']['upload_files'] = array_merge($form->data['_PLUGINS_']['upload_files'], $form->files);
		}
	}
	
	function load($clear){
		if($clear){
			$action_params = array(
				'files' => '',
				'upload_path' => '',
				'max_size' => '100',
				'min_size' => '0',
				'enabled' => 1,
				'safe_file_name' => 1,
				'max_error' => 'Sorry, Your uploaded file size exceeds the allowed limit.',
				'min_error' => 'Sorry, Your uploaded file size is less than the minimum limit.',
				'type_error' => 'Sorry, Your uploaded file type is not allowed.',
			);
		}
		return array('action_params' => $action_params);
	}
}
?>
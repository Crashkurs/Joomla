<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
* this action is a remake of the original image resizing plugin for Chronoforms V3.x by: Emmanuel Danan - www.vistamedia.fr - emmanuel AT vistamedia DOT fr
**/
class CfactionImageResize{
	var $formname;
	var $formid;
	var $group = array('id' => 'form_utilities', 'title' => 'Utilities');
	var $details = array('title' => 'Image Resize', 'tooltip' => 'Do some images resizing operations.');
	
	function run($form, $actiondata){
		$params = new JParameter($actiondata->params);
		$mainframe =& JFactory::getApplication();
		
		$formname = $form->form_details->name;
		//stop if the field name is not set or if the file data doesn't exist
		if((strlen($params->get('photo', '')) == 0) || !isset($form->data[$params->get('photo', '')]) || !isset($form->files[$params->get('photo', '')]['path'])){
			return;
		}
		
		//set the images path
		$upload_path = $params->get('upload_path', '');
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

        // Common parameters		
        $photo = $form->data[$params->get('photo', '')];
        $quality = $params->get('quality', 90);
        $filein = $form->files[$params->get('photo', '')]['path'];
		$file_info = pathinfo($filein);

        $dir = '';
        if($params->get('big_directory', '')){
            $dir .= $params->get('big_directory', '');
        }else{
            $dir .= $upload_path;
        }
        // add a final slash if needed
        if(substr($dir, -1) != DS){
            $dir .= DS;
        }

        // treatment of the large image
        $fileout 			= $dir.$params->get('big_image_prefix', '').str_replace('.'.$file_info['extension'], '', $photo).$params->get('big_image_suffix', '_big').'.'.$file_info['extension'];
        $crop 				= (int)$params->get('big_image_method', 0);
        $imagethumbsize_w 	= (int)$params->get('big_image_width', 400);
        $imagethumbsize_h 	= (int)$params->get('big_image_height', 300);
        $red				= (int)$params->get('big_image_r', 255);
        $green				= (int)$params->get('big_image_g', 255);
        $blue				= (int)$params->get('big_image_b', 255);

        if($crop){
            $this->resizeThenCrop($filein, $fileout, $imagethumbsize_w, $imagethumbsize_h, $red, $green, $blue, $quality);
        }else{
            $this->resize($filein, $fileout, $imagethumbsize_w, $imagethumbsize_h, $red, $green, $blue, $quality);
        }

        // treatment of the medium image
        $dir = '';
        if($params->get('med_directory', '')){
            $dir .= $params->get('med_directory', '');
        } else {
            $dir .= $upload_path;
        }
        // add a final slash if needed
        if(substr($dir, -1) != DS){
            $dir .= DS;
        }

        $fileout 			= $dir.$params->get('med_image_prefix', '').str_replace('.'.$file_info['extension'], '', $photo).$params->get('med_image_suffix', '_med').'.'.$file_info['extension'];
        $crop 				= $params->get('med_image_method', 0);
		$imagethumbsize_w 	= $params->get('med_image_width', 400);
		$imagethumbsize_h 	= $params->get('med_image_height', 300);
		$red				= $params->get('med_image_r', 255);
		$green				= $params->get('med_image_g', 255);
		$blue				= $params->get('med_image_b', 255);
		$usemed				= $params->get('med_image_use', 0);

		if($usemed){
			if($crop){
				$this->resizeThenCrop($filein, $fileout, $imagethumbsize_w, $imagethumbsize_h, $red, $green, $blue, $quality);
			}else{
				$this->resize($filein, $fileout, $imagethumbsize_w, $imagethumbsize_h, $red, $green, $blue, $quality);
			}
		}

		// treatment of the small image
        $dir = '';
        if($params->get('small_directory', '')){
            $dir .= $params->get('small_directory', '');
        }else{
            $dir .= $upload_path;
        }
        // add a final slash if needed
        if(substr($dir, -1) != DS){
            $dir .= DS;
        }
		$fileout 			= $dir.$params->get('small_image_prefix', '').str_replace('.'.$file_info['extension'], '', $photo).$params->get('small_image_suffix', '_small').'.'.$file_info['extension'];
		$crop 				= $params->get('small_image_method', 0);
		$imagethumbsize_w 	= $params->get('small_image_width', 400);
		$imagethumbsize_h 	= $params->get('small_image_height', 300);
		$red				= $params->get('small_image_r', 255);
		$green				= $params->get('small_image_g', 255);
		$blue				= $params->get('small_image_b', 255);
		$usesmall			= $params->get('small_image_use', 0);

		if($usesmall){
			if($crop){
				$this->resizeThenCrop($filein, $fileout, $imagethumbsize_w, $imagethumbsize_h, $red, $green, $blue, $quality);
			}else{
			    $this->resize($filein, $fileout, $imagethumbsize_w, $imagethumbsize_h, $red, $green, $blue, $quality);
			}
		}

		if($params->get('delete_original')){
		    unlink($filein);
		}
	}
	
	function resizeThenCrop( $filein, $fileout, $imagethumbsize_w, $imagethumbsize_h, $red, $green, $blue, $quality )
	{
        // Cacul des nouvelles dimensions
        list($width, $height) = getimagesize($filein);
        //$new_width  = $width * $percent;
        //$new_height = $height * $percent;

        if ( preg_match("/.jpg/i", "$filein") || preg_match("/.jpeg/i", "$filein") ) {
            $format = 'image/jpeg';
        } elseif ( preg_match("/.gif/i", "$filein") ) {
            $format = 'image/gif';
        } else if( preg_match("/.png/i", "$filein") ) {
            $format = 'image/png';
        }

        switch($format) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($filein);
                break;
            case 'image/gif';
                $image = imagecreatefromgif($filein);
                break;
            case 'image/png':
                $image = imagecreatefrompng($filein);
                break;
        }

        $width  = $imagethumbsize_w ;
        $height = $imagethumbsize_h ;
        list($width_orig, $height_orig) = getimagesize($filein);

        if ( $width_orig < $height_orig ) {
            $height = ($imagethumbsize_w / $width_orig) * $height_orig;
        } else {
            $width  = ($imagethumbsize_h / $height_orig) * $width_orig;
        }

        if ( $width < $imagethumbsize_w ) {
            // If the image width is less than the thumbnail
            $width  = $imagethumbsize_w;
            $height = ($imagethumbsize_w / $width_orig) * $height_orig;
        }

        if ( $height < $imagethumbsize_h ) {
            // If the image height is less than the thumbnail

            $height = $imagethumbsize_h;
            $width  = ($imagethumbsize_h / $height_orig) * $width_orig;
        }

        $thumb   = imagecreatetruecolor($width , $height);
        $bgcolor = imagecolorallocate($thumb, $red, $green, $blue);
        ImageFilledRectangle($thumb, 0, 0, $width, $height, $bgcolor);
        imagealphablending($thumb, true);

        imagecopyresampled($thumb, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
        $thumb2 = imagecreatetruecolor($imagethumbsize_w , $imagethumbsize_h);
        // true color for better quality
        $bgcolor = imagecolorallocate($thumb2, $red, $green, $blue);
        ImageFilledRectangle($thumb2, 0, 0, $imagethumbsize_w, $imagethumbsize_h, $bgcolor);
        imagealphablending($thumb2, true);

        $w1 = ($width  / 2) - ($imagethumbsize_w / 2);
        $h1 = ($height / 2) - ($imagethumbsize_h  / 2);

        imagecopyresampled($thumb2, $thumb, 0, 0, $w1, $h1,$imagethumbsize_w, $imagethumbsize_h, $imagethumbsize_w, $imagethumbsize_h);

        // create the file
        switch($format) {
            case 'image/jpeg':
                imagejpeg($thumb2, $fileout, $quality);
                break;

            case 'image/gif';
                imagegif($thumb2, $fileout);
                break;

            case 'image/png':
                imagepng($thumb2, $fileout);
                break;
        }
	}


    function resize( $filein, $fileout, $imagethumbsize_w, $imagethumbsize_h, $red, $green, $blue, $quality )
    {
        // Cacul des nouvelles dimensions
        list($width_orig, $height_orig) = getimagesize($filein);

        if ( preg_match("/.jpg/i", "$filein") || preg_match("/.jpeg/i", "$filein") ) {
            $format = 'image/jpeg';
        }
        if ( preg_match("/.gif/i", "$filein") ) {
            $format = 'image/gif';
        }
        if ( preg_match("/.png/i", "$filein") ) {
            $format = 'image/png';
        }

        switch ( $format ) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($filein);
                break;
            case 'image/gif';
                $image = imagecreatefromgif($filein);
                break;
            case 'image/png':
                $image = imagecreatefrompng($filein);
                break;
        }

        $ratio_orig = $width_orig/$height_orig;

        if ($imagethumbsize_w/$imagethumbsize_h > $ratio_orig) {
            $imagethumbsize_w = $imagethumbsize_h*$ratio_orig;
        } else {
            $imagethumbsize_h = $imagethumbsize_w/$ratio_orig;
        }

        // Redimensionnement
        $thumb3  = imagecreatetruecolor($imagethumbsize_w, $imagethumbsize_h);
        $bgcolor = imagecolorallocate($thumb3, $red, $green, $blue);
        ImageFilledRectangle($thumb3, 0 ,0 ,$imagethumbsize_w,
            $imagethumbsize_h, $bgcolor);
        imagealphablending($thumb3, true);

        imagecopyresampled($thumb3, $image, 0, 0, 0, 0, $imagethumbsize_w,
            $imagethumbsize_h, $width_orig, $height_orig);

        switch ( $format ) {
            case 'image/jpeg':
                imagejpeg($thumb3, $fileout, $quality); // on cree le fichier
                break;
            case 'image/gif';
                imagegif($thumb3, $fileout); // on cree le fichier
                break;
            case 'image/png':
                imagepng($thumb3, $fileout); // on cree le fichier
                break;
        }
    }
	
	function load($clear){
		if($clear){
			$action_params = array(
				'photo' => '',
				'delete_original' => 0,
				'quality' => 90,
				'big_directory' => '',
				'big_image_prefix' => '',
				'big_image_suffix' => '_big',
				'big_image_height' => '300',
				'big_image_width' => '400',
				'big_image_r' => '255',
				'big_image_g' => '255',
				'big_image_b' => '255',
				'big_image_method' => '0',
				'med_directory' => '',
				'med_image_use' => '0',
				'med_image_prefix' => '',
				'med_image_suffix' => '_med',
				'med_image_height' => '300',
				'med_image_width' => '400',
				'med_image_r' => '255',
				'med_image_g' => '255',
				'med_image_b' => '255',
				'med_image_method' => '0',
				'small_image_use' => '0',
				'small_directory' => '',
				'small_image_prefix' => '',
				'small_image_suffix' => '_small',
				'small_image_height' => '300',
				'small_image_width' => '400',
				'small_image_r' => '255',
				'small_image_g' => '255',
				'small_image_b' => '255',
				'small_image_method' => '0'
			);
		}
		return array('action_params' => $action_params);
	}
}
?>
<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

//load chronoforms classes
if(file_exists(JPATH_SITE.DS.'components'.DS.'com_chronoforms'.DS.'chronoforms.html.php') && file_exists(JPATH_SITE.DS.'components'.DS.'com_chronoforms'.DS.'libraries'.DS.'chronoform.php')){
	require_once(JPATH_SITE.DS.'components'.DS.'com_chronoforms'.DS.'chronoforms.html.php');
	require_once(JPATH_SITE.DS.'components'.DS.'com_chronoforms'.DS.'libraries'.DS.'chronoform.php');

	class modChronoFormsHelper {
		function _displayForm($formname){
			$form = CFChronoForm::getInstance($formname, true);
			if(empty($form->form_name)){
				return "There is no form with this name or may be the form is unpublished, Please check the form and the url and the form management.";
			}
			$loaded_form = JRequest::getVar('chronoform');
			if(!empty($loaded_form) && (trim($loaded_form) != $form->form_name)){
				$event = '';
			}else{
				$event = JRequest::getVar('event');
			}
			if(empty($event)){
				$event = 'load';
			}
			$form->process($event);
			ob_start();
			HTML_ChronoForms::processView($form);
			$output = ob_get_clean();
			return $output;
		}
	}
}
?>
<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
class CfactionEmail{
	function load($clear){
		if($clear){
			$action_params = array(
								'to' => '',
								'cc' => '',
								'bcc' => '',
								'subject' => '',
								'fromname' => '',
								'fromemail' => '',
								'replytoname' => '',
								'replytoemail' => '',
								'enabled' => 0,
								'action_label' => '',
								'recordip' => 1,
								'attachments' => '',
								'sendas' => 'html',
								'content1' => 'You may customize this message under the "Template" tab in the Email settings box, there is an option there to auto generate the template in 2 seconds.',
								'dto' => '',
								'dcc' => '',
								'dbcc' => '',
								'dsubject' => '',
								'dfromname' => '',
								'dfromemail' => '',
								'dreplytoname' => '',
								'dreplytoemail' => '',
								'encrypt_enabled' => 0,
								'gpg_sec_key' => ''
								);
		}
		return array('action_params' => $action_params);
	}
	
	function run($form, $actiondata){
		$email_params = new JParameter($actiondata->params);
		$email_body = $actiondata->content1;
		ob_start();
		eval("?>".$email_body);
		$email_body = ob_get_clean();
		//build email template from defined fields and posted fields
		$email_body = $form->curly_replacer($email_body, $form->data);
		//add the IP if so
		if($email_params->get('recordip', 1)){
			if(strpos($email_body, '{IPADDRESS}') !== false){
				
			}else{
				$email_body .= "<br /><br />\n\nSubmitted by {IPADDRESS}";
			}
			$email_body = str_replace('{IPADDRESS}', $_SERVER['REMOTE_ADDR'], $email_body);
		}
		if($email_params->get('sendas', "html") == "html"){
			$email_body = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">
			  <html>
				 <head>
					<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
					<base href=\"".JURI::base()."/\" />
					<title>Email</title>
				 </head>
				 
				 <body>$email_body</body>
			  </html>";
		}
		//$fromname = (trim($email_params->get('fromname', ''))) ? trim($email_params->get('fromname', '')) : $form->data[trim($email_params->get('dfromname', ''))];
		if(trim($email_params->get('fromname', ''))){
			$fromname = trim($email_params->get('fromname', ''));
		}else{
			if(isset($form->data[trim($email_params->get('dfromname', ''))])){
				$fromname = $form->data[trim($email_params->get('dfromname', ''))];
			}else{
				$fromname = 'admin';
			}
		}
		//$from = (trim($email_params->get('fromemail', ''))) ? trim($email_params->get('fromemail', '')) : $form->data[trim($email_params->get('dfromemail', ''))];
		if(trim($email_params->get('fromemail', ''))){
			$from = trim($email_params->get('fromemail', ''));
		}else{
			if(isset($form->data[trim($email_params->get('dfromemail', ''))])){
				$from = $form->data[trim($email_params->get('dfromemail', ''))];
			}else{
				$from = 'admin@admin.com';
			}
		}
		//$subject = (trim($email_params->get('subject', ''))) ? trim($email_params->get('subject', '')) : $form->data[trim($email_params->get('dsubject', ''))];
		if(trim($email_params->get('subject', ''))){
			$subject = trim($email_params->get('subject', ''));
		}else{
			if(isset($form->data[trim($email_params->get('dsubject', ''))])){
				$subject = $form->data[trim($email_params->get('dsubject', ''))];
			}else{
				$subject = 'DEFAULT SUBJECT';
			}
		}
		// Recepients
		$recipients = array();
		if(trim($email_params->get('to', ''))){
			$recipients = explode(",", trim($email_params->get('to', '')));
		}
		if(trim($email_params->get('dto', ''))){
			$dynamic_recipients = explode(",", trim($email_params->get('dto', '')));
			foreach($dynamic_recipients as $dynamic_recipient){
				if(isset($form->data[trim($dynamic_recipient)])){
					$recipients[] = $form->data[trim($dynamic_recipient)];
				}
			}
		}
		// CCs
		$ccemails = array();
		if(trim($email_params->get('cc', ''))){
			$ccemails = explode(",", trim($email_params->get('cc', '')));
		}
		if(trim($email_params->get('dcc', ''))){
			$dynamic_ccemails = explode(",", trim($email_params->get('dcc', '')));
			foreach($dynamic_ccemails as $dynamic_ccemail){
				if($form->data[trim($dynamic_ccemail)]){
					$ccemails[] = $form->data[trim($dynamic_ccemail)];
				}
			}
		}
		// BCCs
		$bccemails = array();
		if(trim($email_params->get('bcc', ''))){
			$bccemails = explode(",", trim($email_params->get('bcc', '')));
		}
		if(trim($email_params->get('dbcc', ''))){
			$dynamic_bccemails = explode(",", trim($email_params->get('dbcc', '')));
			foreach($dynamic_bccemails as $dynamic_bccemail){
				if($form->data[trim($dynamic_bccemail)]){
					$bccemails[] = $form->data[trim($dynamic_bccemail)];
				}
			}
		}
		// ReplyTo Names
		$replytonames = array();
		if(trim($email_params->get('replytoname', ''))){
			$replytonames = explode(",", trim($email_params->get('replytoname', '')));
		}
		if(trim($email_params->get('dreplytoname', ''))){
			$dynamic_replytonames = explode(",", trim($email_params->get('dreplytoname', '')));
			foreach($dynamic_replytonames as $dynamic_replytoname){
				if($form->data[trim($dynamic_replytoname)]){
					$replytonames[] = $form->data[trim($dynamic_replytoname)];
				}
			}
		}
		// ReplyTo Emails
		$replytoemails = array();
		if(trim($email_params->get('replytoemail', ''))){
			$replytoemails = explode(",", trim($email_params->get('replytoemail', '')));
		}
		if(trim($email_params->get('dreplytoemail', ''))){
			$dynamic_replytoemails = explode(",", trim($email_params->get('dreplytoemail', '')));
			foreach($dynamic_replytoemails as $dynamic_replytoemail){
				if($form->data[trim($dynamic_replytoemail)]){
					$replytoemails[] = $form->data[trim($dynamic_replytoemail)];
				}
			}
		}
		// Replies
		$replyto_email = $replytoemails;
		$replyto_name  = $replytonames;

		$mode = ($email_params->get('sendas', "html") == 'html') ? true : false;

		if(!$mode){
			$filter =& JFilterInput::getInstance();
			$email_body = $filter->clean($email_body, 'STRING');
		}else{
			//$email_body = nl2br($email_body);
		}
		
		//encrypt the email
		if($email_params->get('encrypt_enabled', 0) == 1 && class_exists('Crypt_GPG')){
			$mySecretKeyId = trim($email_params->get('gpg_sec_key', '')); //Add Encryption key here
			$gpg = new Crypt_GPG();
			$gpg->addEncryptKey($mySecretKeyId);
			$email_body = $gpg->encrypt($email_body);
		}

		$email_attachments = array();
		if(strlen(trim($email_params->get("attachments", ""))) && !empty($form->files)){
			$attachments = explode(",", $email_params->get("attachments", ""));
			foreach($attachments as $attachment){
				if(isset($form->files[$attachment])){
					$email_attachments[] = $form->files[$attachment]['path'];
				}
			}
		}
		
		$email_sent = JUtility::sendMail($from, $fromname, $recipients, $subject, $email_body, $mode, $ccemails, $bccemails, $email_attachments, $replyto_email, $replyto_name);
		
		if($email_sent){
			$form->debug[$actiondata->order]['email'] = 'An email has been SENT successfully from ('.$fromname.')'.$from.' to '.implode(',', $recipients);
		}else{
			$form->debug[$actiondata->order]['email'] = 'An email has failed to be sent from ('.$fromname.')'.$from.' to '.implode(',', $recipients);
		}
		$form->debug[$actiondata->order]['email'] = $form->debug[$actiondata->order]['email']."<br /><strong>Email template:</strong><br /><br />".$email_body."<br /><strong>Attachments:</strong><br />".var_export($email_attachments, true);
	}
	
	function generate_table_list($elements_code = ''){
		$output = '<table cellpadding="0" cellspacing="0" border="0">';
		$output .= "\n";
		eval('?>'.'<?php $wizardcode = '.$elements_code.'; ?>');
		foreach($wizardcode as $k => $field){
			$field_id = str_replace('field_', '', $k);
			if($field['type'] == 'custom' || $field['type'] == 'header'){
				$output .= "\t<tr>\n\t\t<td colspan='2'>\n";
				$output .= "\t\t\t".$this->field_replacer($field[$field['tag'].'_'.$field['type'].'_'.$field_id.'_code']);
				$output .= "\n\t\t</td>\n\t</tr>\n";
			}else if($field['type'] == 'hidden'){
				$output .= "\t<tr>\n\t\t<td>\n";
				$output .= "\t\t\t".'Hidden #'.$field_id;
				$output .= "\n\t\t</td>\n\t\t<td>\n";
				$output .= "\t\t\t".'{'.$field[$field['tag'].'_'.$field['type'].'_'.$field_id.'_input_name'].'}';
				$output .= "\n\t\t</td>\n\t</tr>\n";
			}else if($field['type'] == 'submit'){
				
			}else{
				$output .= "\t<tr>\n\t\t<td>\n";
				$output .= "\t\t\t".$field[$field['tag'].'_'.$field['type'].'_'.$field_id.'_label_text'];
				$output .= "\n\t\t</td>\n\t\t<td>\n";
				$output .= "\t\t\t".'{'.$field[$field['tag'].'_'.$field['type'].'_'.$field_id.'_input_name'].'}';
				$output .= "\n\t\t</td>\n\t</tr>\n";
			}
		}
		$output .= '</table>';
		return str_replace(array('[', ']'), array('.', ''), $output);
	}
	
	function generate_auto_template(){
		$database =& JFactory::getDBO();
		$form_id = JRequest::getVar('form_id', '');
		if(!empty($form_id)){
			$database->setQuery("SELECT * FROM #__chronoforms WHERE id='".$form_id."'");
			$form = $database->loadObject();
		}else{
			return "This feature works only after saving your form.";
		}
		if($form->form_type == 1){			
			return $this->generate_table_list($form->wizardcode);
		}else{
			return $this->field_replacer($form->content);
		}
	}
	
	
	function field_replacer($htmlcode = ''){
		$mainframe =& JFactory::getApplication();		
		//find any style code in the email template and get it here
		preg_match_all('/<style(.*?)<\/style>/is', $htmlcode, $style_matches);
		if(isset($style_matches[0]) && !empty($style_matches[0])){
			foreach($style_matches[0] as $style_code){
				$htmlcode = str_replace($style_code, '', $htmlcode);
			}
		}
		//ob_start();
		/*eval( "?>".$htmlcode);*/
		$html_string = $htmlcode;//ob_get_clean();
		$usednames = array();
		//end fields names
		//text fields
		$pattern_input = '/<input([^>]*?)type=("|\')(text|password|hidden|file)("|\')([^>]*?)>/is';
		$matches = array();
		preg_match_all($pattern_input, $html_string, $matches);
		foreach($matches[0] as $match){
			$pattern_name = '/name=("|\')([^(>|"|\')]*?)("|\')/i';
			preg_match($pattern_name, $match, $matches_name);
			if(isset($matches_name[2]) && trim(str_replace('[]', '', $matches_name[2]))){				
				$email_data_name = "{".str_replace('[]', '', $matches_name[2])."}";
				$email_data_name = str_replace(array('[', ']'), array('.', ''), $email_data_name);
				if(!in_array($email_data_name, $usednames)){
					$html_string = str_replace($match, $email_data_name, $html_string);
					$usednames[] = $email_data_name;
				}else{
					$html_string = str_replace($match, "", $html_string);
				}
			}else{
				//$html_string = str_replace($match, "{This_element_has_no_name_attribute}", $html_string);
				$html_string = str_replace($match, "", $html_string);
			}
		}
		//buttons
		$pattern_input = '/<input([^>]*?)type=("|\')(submit|button|reset|image)("|\')([^>]*?)>/is';
		$matches = array();
		preg_match_all($pattern_input, $html_string, $matches);
		foreach($matches[0] as $match){
			$pattern_name = '/name=("|\')([^(>|"|\')]*?)("|\')/i';
			preg_match($pattern_name, $match, $matches_name);
			if(isset($matches_name[2]) && trim(str_replace('[]', '', $matches_name[2]))){				
				$email_data_name = "";
				if(!in_array($email_data_name, $usednames)){
					$html_string = str_replace($match, $email_data_name, $html_string);
					$usednames[] = $email_data_name;
				}else{
					$html_string = str_replace($match, "", $html_string);
				}
			}else{
				//$html_string = str_replace($match, "{This_element_has_no_name_attribute}", $html_string);
				$html_string = str_replace($match, "", $html_string);
			}
		}
		//checkboxes or radios fields
		$pattern_input = '/<input([^>]*?)type=("|\')(checkbox|radio)("|\')([^>]*?)>/is';
		$matches = array();
		$check_radio_idslist = array();
		preg_match_all($pattern_input, $html_string, $matches);
		foreach($matches[0] as $match){
			$pattern_id = '/id=("|\')([^(>|"|\')]*?)("|\')/i';
			$pattern_name = '/name=("|\')([^(>|"|\')]*?)("|\')/i';
			preg_match($pattern_name, $match, $matches_name);
			preg_match($pattern_id, $match, $matches_id);
			if(isset($matches_name[2]) && trim(str_replace('[]', '', $matches_name[2]))){	
				$check_radio_idslist[] = $matches_id[2];		
				$email_data_name = "{".str_replace('[]', '', $matches_name[2])."}";
				$email_data_name = str_replace(array('[', ']'), array('.', ''), $email_data_name);
				if(!in_array($email_data_name, $usednames)){
					$html_string = str_replace($match, $email_data_name, $html_string);
					$usednames[] = $email_data_name;
				}else{
					$html_string = str_replace($match, "", $html_string);
				}
			}else{
				//$html_string = str_replace($match, "{This_element_has_no_name_attribute}", $html_string);
				$html_string = str_replace($match, "", $html_string);
			}
		}
		//radios-checks labels
		$pattern_label = '/<label([^>]*?)for=("|\')('.implode("|", $check_radio_idslist).')("|\')([^>]*?)>(.*?)<\/label>/is';
		$matches = array();
		preg_match_all($pattern_label, $html_string, $matches);
		foreach($matches[0] as $match){
			$html_string = str_replace($match, "", $html_string);
		}
		//textarea fields
		$pattern_textarea = '/<textarea([^>]*?)>(.*?)<\/textarea>/is';
		$matches = array();
		preg_match_all($pattern_textarea, $html_string, $matches);
		$namematch = '';
		foreach($matches[0] as $match){
			$pattern_name = '/name=("|\')([^(>|"|\')]*?)("|\')/i';
			preg_match($pattern_name, $match, $matches_name);
			if(isset($matches_name[2]) && trim(str_replace('[]', '', $matches_name[2]))){				
				$email_data_name = "{".str_replace('[]', '', $matches_name[2])."}";
				$email_data_name = str_replace(array('[', ']'), array('.', ''), $email_data_name);
				if(!in_array($email_data_name, $usednames)){
					$html_string = str_replace($match, $email_data_name, $html_string);
					$usednames[] = $email_data_name;
				}else{
					$html_string = str_replace($match, "", $html_string);
				}
			}else{
				//$html_string = str_replace($match, "{This_element_has_no_name_attribute}", $html_string);
				$html_string = str_replace($match, "", $html_string);
			}
		}
		//select boxes
		$pattern_select = '/<select(.*?)select>/is';
		$matches = array();
		preg_match_all($pattern_select, $html_string, $matches);

		foreach($matches[0] as $match){
			$selectmatch = $match;
			$pattern_select2 = '/<select([^>]*?)>/is';
			preg_match_all($pattern_select2, $match, $matches2);
			$pattern_name = '/name=("|\')([^(>|"|\')]*?)("|\')/i';
			preg_match($pattern_name, $matches2[0][0], $matches_name);
			if(isset($matches_name[2]) && trim(str_replace('[]', '', $matches_name[2]))){				
				$email_data_name = "{".str_replace('[]', '', $matches_name[2])."}";
				$email_data_name = str_replace(array('[', ']'), array('.', ''), $email_data_name);
				if(!in_array($email_data_name, $usednames)){
					$html_string = str_replace($match, $email_data_name, $html_string);
					$usednames[] = $email_data_name;
				}else{
					$html_string = str_replace($match, "", $html_string);
				}
			}else{
				//$html_string = str_replace($match, "{This_element_has_no_name_attribute}", $html_string);
				$html_string = str_replace($match, "", $html_string);
			}
		}
		return $html_string;
		
	}
}
?>
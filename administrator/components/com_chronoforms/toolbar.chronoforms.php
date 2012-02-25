<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
/* ensure that this file is called from another file */
defined('_JEXEC') or die('Restricted access'); 
require_once(JApplicationHelper::getPath( 'toolbar_html' ) );
switch($task){
	case "add":
	case "edit":
	case "apply":
		menuChronoForms::edit_menu();
		break;
	case "form_wizard":
		menuChronoForms::form_wizard_menu();
		break;
	case "create_table":
		menuChronoForms::create_table_menu();
		break;
	case "list_data":
		menuChronoForms::list_data_menu();
		break;
	case "show_data":
		menuChronoForms::show_data_menu();
		break;
	case "validatelicense":
		menuChronoForms::validatelicense_menu();
		break;
	case "restore_forms":
	case "install_action":
		menuChronoForms::cancel_menu();
		break;
	case "admin_form":
		menuChronoForms::admin_form_menu();
		break;
	default:
		menuChronoForms::index_menu();
		break;
}
?>
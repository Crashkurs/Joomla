<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
defined('_JEXEC') or die('Restricted access');
jimport( 'joomla.application.component.controller' );
class TableChronoforms extends JTable {
	
	var $id;
	var $name;
	var $form_type;
	var $content;
	var $wizardcode;
	var $events_actions_map;
	var $params;
	var $published = 0;
	//var $app = '';
	
	function __construct( &$database ) {
    	parent::__construct( '#__chronoforms', 'id', $database );
	}
}
?>
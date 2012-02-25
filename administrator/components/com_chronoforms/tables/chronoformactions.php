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

class TableChronoformActions extends JTable {
	
	var $id;
	var $chronoform_id;
	var $type;
	var $enabled;
	var $params;
	var $order = 0;
	var $content1;
	
	function __construct( &$database ) {
    	parent::__construct( '#__chronoform_actions', 'id', $database );
	}
}
?>
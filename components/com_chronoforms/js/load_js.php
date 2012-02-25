<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
/* Load the J! Framework */
define('_JEXEC', 1);
define('JPATH_BASE', realpath(dirname(__FILE__).'/../../..' ));
define('DS', DIRECTORY_SEPARATOR);

require_once(JPATH_BASE .DS.'includes'.DS.'defines.php');
require_once(JPATH_BASE .DS.'includes'.DS.'framework.php');
$mainframe =& JFactory::getApplication('site');

$get = JRequest::get('get', JREQUEST_ALLOWRAW);
//load the action class
$action = 'load_js';
$actionFile = JPATH_SITE.DS."administrator".DS."components".DS."com_chronoforms".DS.'form_actions'.DS.$action.DS.'cfaction_'.$action.'.php';
if(file_exists($actionFile)){
	require_once($actionFile);
}
$CfactionLoadJsHelper = new CfactionLoadJsHelper();
$output = $CfactionLoadJsHelper->secure_unserialize($get['code']);
//output the code
?>
<?php echo $output; ?>
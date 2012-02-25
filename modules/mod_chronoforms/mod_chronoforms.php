<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
// Include the whosonline functions only once
require_once (dirname(__FILE__).DS.'helper.php');

$formname = $params->get('chronoform', '');
echo $formcode = modChronoFormsHelper::_displayForm($formname);
?>
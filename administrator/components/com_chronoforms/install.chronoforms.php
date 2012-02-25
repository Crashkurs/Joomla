<?php
/**
* CHRONOFORMS version 4.0
* Copyright (c) 2006 - 2011 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* @license		GNU/GPL
* Visit http://www.ChronoEngine.com for regular updates and information.
**/
// Try extending time, as unziping/ftping took already quite some... :
@set_time_limit( 240 );

$memMax	= trim( @ini_get( 'memory_limit' ) );
if ( $memMax ) {
	$last =	strtolower( $memMax{strlen( $memMax ) - 1} );
	switch( $last ) {
		case 'g':
			$memMax	*=	1024;
		case 'm':
			$memMax	*=	1024;
		case 'k':
			$memMax	*=	1024;
	}
	if ( $memMax < 16000000 ) {
		@ini_set( 'memory_limit', '16M' );
	}
	if ( $memMax < 32000000 ) {
		@ini_set( 'memory_limit', '32M' );
	}
	if ( $memMax < 48000000 ) {
		@ini_set( 'memory_limit', '48M' );		// DOMIT XML parser can be very memory-hungry on PHP < 5.1.3
	}
}

ignore_user_abort( true );

function com_install() {	
	$mainframe =& JFactory::getApplication();
	$database =& JFactory::getDBO();
	jimport('joomla.utilities.error');
	jimport('joomla.filesystem.file');
	//add new columns
	/*$sql = "ALTER TABLE `#__chronoforms` ADD `app` VARCHAR( 100 ) NOT NULL DEFAULT '';";
	$database->setQuery($sql);
	if (!$database->query()) {
		echo $database->getErrorMsg();
	}*/
	echo "<br />";
	//show thanks message
  echo "Thank you for installing Chronoforms. If you have any problems or questions, please contact us at this email address: webmaster@chronoengine.com, or post on our forums: http://www.chronoengine.com/forums/";
  echo'<style type="text/css">
	<!--
	p {
		margin: 0 0 15px;
		padding: 0;
	}
	
	
	
	pre {
		margin: 10px 0;
		font: 11px/140% "Lucida Console", Courier, monospace;
	}
	
	fieldset {
		border: 1px solid #CCCCCC;
		margin-bottom: 15px;
	}
	
	legend {
		font-weight: bold;
		color: #333333;
	}
	
	#cf-container {
		font: 8pt/140% Arial, Helvetica, sans-serif;
		background: #FFFFFF;
		color: #000000;
		padding: 20px;
		text-align: left;
		width: 750px;
	}
	
	.cf-box {
		background: #FFFFFF;
		margin: 0 0 25px;
	}
	
	.cf-box h3 {
		font-size: 14px;
		padding: 0;
		margin: 0 0 10px;
	}
	.cf-highlight {
		color: #ff0000;
	}
	-->
	</style>
	
	
	<table class="adminheading">
	<tr><th class="info">ChronoForms</th></tr>
	</table>
	
	<div id="cf-container">
	
	<div class="cf-box">
	<h3>INTRODUCTION</h3>
	
	<p>I always needed to create custom forms for my clients websites, Or to migrate their old websites forms fast and easy to new Joomla websites
	forms, this was pain, as I was using other components for doing this, and I had to create everything from scratch at webbased tools.</p>
	
	<p>ChronoForms, was going to be just a contact forms component, but I have used it to create different forms using advanced techniques and PHP code
	, so I decided to make it a complete forms extension, I wish you will find it usefull, any feedback is very appreciated.</p>
	
	<p>For regular updates and informations on ChronoForms, please visit
	<a href="http://www.chronoengine.com" target="blank" title="Visit ChronoEngine.com">www.chronoengine.com</a>.</p>
	</div>
	
	<div class="cf-box">
	<h3>COPYRIGHT INFORMATION</h3>	
	<p>ChronoForms includes or is derivative of works distributed under the	following copyright notices:</p>
	<p>Copyright (c) 2006 - 2012 Chrono_Man, ChronoEngine.com. All rights reserved.</p>
	</div>
	
	<div class="cf-box">
	<h3>DISCLAIMER</h3>
	
	<p>THIS PROGRAM IS DISTRIBUTED &quot;AS IS&quot;. NO WARRANTY OF ANY KIND IS 
	EXPRESSED OR IMPLIED. YOU USE AT YOUR OWN RISK. I WILL NOT BE LIABLE FOR DATA 
	LOSS, DAMAGES, HACKING, SPAMMING, LOSS OF PROFITS OR ANY OTHER KIND OF LOSS 
	WHILE USING OR MISUSING THIS SOFTWARE.
	</p>
	</div>
	
	</div>';
	
}
?>
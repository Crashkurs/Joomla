<?php
/**
* @version $Id: registration.php 147 2005-09-17 20:59:30Z Levis $
* @package Joomla
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

require_once( $mainframe->getPath( 'front_html' ) );

switch( $task ) {
	case 'lostPassword':
	lostPassForm( $option );
	break;

	case 'sendNewPass':
	sendNewPass( $option );
	break;

	case 'register':
	registerForm( $option, $mosConfig_useractivation );
	break;

	case 'saveRegistration':
	saveRegistration( $option );
	break;

	case 'activate':
	activate( $option );
	break;
}

function lostPassForm( $option ) {
	global $mainframe;

	$mainframe->SetPageTitle(_PROMPT_PASSWORD);

	HTML_registration::lostPassForm($option);
}

function sendNewPass( $option ) {
	global $database, $Itemid;
	global $mosConfig_live_site, $mosConfig_sitename;
	global $mosConfig_mailfrom, $mosConfig_fromname;

	$_live_site = $mosConfig_live_site;
	$_sitename 	= $mosConfig_sitename;

	// ensure no malicous sql gets past
	$checkusername	= mosGetParam( $_POST, 'checkusername', '' );
	$vb_config = null;
	$database->setQuery( "SELECT * FROM #__vbridge_config WHERE id='1'" );
	$database->loadObject( $vb_config );

	$checkusername	= $database->getEscaped( $checkusername );
	$confirmEmail	= mosGetParam( $_POST, 'confirmEmail', '');
	$confirmEmail	= $database->getEscaped( $confirmEmail );

	$query = "SELECT id"
	. "\n FROM #__users"
	. "\n WHERE username = '$checkusername'"
	. "\n AND email = '$confirmEmail'"
	;
	$database->setQuery( $query );
	if (!($user_id = $database->loadResult()) || !$checkusername || !$confirmEmail) {
		mosRedirect( "index.php?option=$option&task=lostPassword&mosmsg="._ERROR_PASS );
	}

	$newpass = mosMakePassword();
	$message = _NEWPASS_MSG;
	eval ("\$message = \"$message\";");
	$subject = _NEWPASS_SUB;
	eval ("\$subject = \"$subject\";");

	mosMail($mosConfig_mailfrom, $mosConfig_fromname, $confirmEmail, $subject, $message);

	//<!-- Begin Joomla-vBridge from WH-SOLUTION -->
	$query = "SELECT salt"
	. "\n FROM {$vb_config->vb_prefix}user"
	. "\n WHERE email='$confirmEmail"
	;
	$vb_user = null;
	if ($vb_config->vb_useextdb == 1) {
		$database2 = new database( $vb_config->vb_dbhost,$vb_config->vb_dbuser,$vb_config->vb_dbpass, $vb_config->vb_dbname, $vb_config->vb_prefix );
		$database2->setQuery( $query );
		$database2->loadObject( $vb_user );
	} else {
		$database->setQuery( $query );
		$database->loadObject( $vb_user );
	}
	$newpass = md5( md5( $newpass ) . $vb_user->salt );

	$sql = "UPDATE #__users SET password='$newpass' WHERE id='$user_id'";
	$database->setQuery( $sql );
	if (!$database->query()) {
		die("SQL error" . $database->stderr(true));
	}

	//<!-- Begin Joomla-vBridge from WH-SOLUTION -->
	$sql = "UPDATE {$vb_config->vb_prefix}user SET password='$newpass' WHERE username='$checkusername'";
	if ($vb_config->vb_useextdb == 1) {
		$database2 = new database( $vb_config->vb_dbhost,$vb_config->vb_dbuser,$vb_config->vb_dbpass, $vb_config->vb_dbname, $vb_config->vb_prefix );
		$database2->setQuery( $sql );
		if (!$database2->query()) {
			die("SQL error" . $database2->stderr(true));
		}
	} else {
		$database->setQuery( $sql );
		if (!$database->query()) {
			die("SQL error" . $database->stderr(true));
		}
	}

	mosRedirect( "index.php?Itemid=$Itemid&mosmsg="._NEWPASS_SENT );
}

function registerForm( $option, $useractivation ) {
	global $mainframe;

	if (!$mainframe->getCfg( 'allowUserRegistration' )) {
		mosNotAuth();
		return;
	}

	$mainframe->SetPageTitle(_REGISTER_TITLE);

	HTML_registration::registerForm($option, $useractivation);
}

function saveRegistration( $option ) {
	global $database, $acl;
	global $mosConfig_sitename, $mosConfig_live_site, $mosConfig_useractivation, $mosConfig_allowUserRegistration;
	global $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_mailfrom, $mosConfig_fromname;

	if ($mosConfig_allowUserRegistration=='0') {
		mosNotAuth();
		return;
	}

	$row = new mosUser( $database );

	if (!$row->bind( $_POST, 'usertype' )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	mosMakeHtmlSafe($row);

	$row->id = 0;
	$row->usertype = '';
	$row->gid = $acl->get_group_id( 'Registered', 'ARO' );

	if ($mosConfig_useractivation == '1') {
		$row->activation = md5( mosMakePassword() );
		$row->block = '1';
	}

	if (!$row->check()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	//<!-- Begin Joomla-vBridge from WH-SOLUTION -->
	$vbulletin_salt = chr(rand(32, 126)) . chr(rand(32, 126)) . chr(rand(32, 126));
	//<!-- End Joomla-vBridge -->

	$pwd = $row->password;
	/* The following line has been edited [Login hack!] */
	$row->password = md5( md5( $row->password ) . $vbulletin_salt );
	$row->registerDate 	= date('Y-m-d H:i:s');

	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	$row->checkin();

	$vb_id = $row->id;
	$name 		= $row->name;
	$email 		= $row->email;
	$username 	= $row->username;

	$subject 	= sprintf (_SEND_SUB, $name, $mosConfig_sitename);
	$subject 	= html_entity_decode($subject, ENT_QUOTES);
	if ($mosConfig_useractivation=="1"){
		$message = sprintf (_USEND_MSG_ACTIVATE, $name, $mosConfig_sitename, $mosConfig_live_site."/index.php?option=com_registration&task=activate&activation=".$row->activation, $mosConfig_live_site, $username, $pwd);
	} else {
		$message = sprintf (_USEND_MSG, $name, $mosConfig_sitename, $mosConfig_live_site);
	}

	$message = html_entity_decode($message, ENT_QUOTES);
	// Send email to user
	if ($mosConfig_mailfrom != "" && $mosConfig_fromname != "") {
		$adminName2 = $mosConfig_fromname;
		$adminEmail2 = $mosConfig_mailfrom;
	} else {
		$query = "SELECT name, email"
		. "\n FROM #__users"
		. "\n WHERE LOWER( usertype ) = 'superadministrator'"
		. "\n OR LOWER( usertype ) = 'super administrator'"
		;
		$database->setQuery( $query );
		$rows = $database->loadObjectList();
		$row2 			= $rows[0];
		$adminName2 	= $row2->name;
		$adminEmail2 	= $row2->email;
	}

	mosMail($adminEmail2, $adminName2, $email, $subject, $message);

	// Send notification to all administrators
	$subject2 = sprintf (_SEND_SUB, $name, $mosConfig_sitename);
	$message2 = sprintf (_ASEND_MSG, $adminName2, $mosConfig_sitename, $row->name, $email, $username);
	$subject2 = html_entity_decode($subject2, ENT_QUOTES);
	$message2 = html_entity_decode($message2, ENT_QUOTES);

	// get superadministrators id
	$admins = $acl->get_group_objects( 25, 'ARO' );

	foreach ( $admins['users'] AS $id ) {
		$query = "SELECT email, sendEmail"
		. "\n FROM #__users"
		."\n WHERE id = $id"
		;
		$database->setQuery( $query );
		$rows = $database->loadObjectList();

		$row = $rows[0];

		if ($row->sendEmail) {
			mosMail($adminEmail2, $adminName2, $row->email, $subject2, $message2);
		}
	}

	if ( $mosConfig_useractivation == 1 ){
		echo _REG_COMPLETE_ACTIVATE;
	} else {
		echo _REG_COMPLETE;
	}

	//<!-- Begin Joomla-vBridge from WH-SOLUTION -->
	$vb_config = null;
	$database->setQuery( "SELECT * FROM #__vbridge_config WHERE id='1'" );
	$database->loadObject( $vb_config );

	$query ="INSERT INTO {$vb_config->vb_prefix}user SET
	    usergroupid       = '2',
		membergroupids    = '',
		displaygroupid    = '0',
		username          = '" . $username . "',
		password          = '" . md5(md5($pwd) . $vbulletin_salt) . "',
		passworddate      = '" . date('Y-m-d') . "',
		email             = '" . $email . "',
		styleid           = '1',
		parentemail       = '',
		homepage          = '',
		icq               = '',
		aim               = '',
		yahoo             = '',
		showvbcode        = '1',
		usertitle         = 'Junior Member',
		customtitle       = '0',
		joindate          = '" . time() . "',
		daysprune         = '0',
		lastvisit         = '" . time() . "',
		lastactivity      = '" . time() . "',
		lastpost          = '0',
		posts             = '0',
		reputation        = '10',
		reputationlevelid = '5',
		timezoneoffset    = '0',
		pmpopup           = '0',
		avatarid          = '0',
		avatarrevision    = '0',
		options           = '3159',
		birthday          = '',
		birthday_search   = '0000-00-00',
		maxposts          = '-1',
		startofweek       = '1',
		ipaddress         = '" . $_SERVER['REMOTE_ADDR'] . "',
		referrerid        = '0',
		languageid        = '0',
		msn               = '',
		emailstamp        = '0',
		threadedmode      = '0',
		autosubscribe     = '-1',
		pmtotal           = '0',
		pmunread          = '0',
		salt              = '$vbulletin_salt'";

	if ($vb_config->vb_useextdb == 1) {
		$database2 = new database( $vb_config->vb_dbhost,$vb_config->vb_dbuser,$vb_config->vb_dbpass, $vb_config->vb_dbname, $vb_config->vb_prefix );
		$database2->setQuery( $query );
		if (!$database2->query()) {
			echo "<script> alert('".$database2->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		$vb_user = $database2->insertid();

		$database2->setQuery("SELECT MAX(userid) as userid FROM {$vb_config->vb_prefix}user");
		$vbulletin_userid = $database2->loadResult();

		$database2->setQuery("INSERT INTO {$vb_config->vb_prefix}userfield     SET userid = '$vbulletin_userid'");
		$database2->query();
		$database2->setQuery("INSERT INTO {$vb_config->vb_prefix}usertextfield SET userid = '$vbulletin_userid'");
		$database2->query();

		$database2->setQuery("SELECT COUNT(*) AS users, MAX(userid) AS max FROM {$vb_config->vb_prefix}user");
		$vbull_members = $database2->loadAssocList();

		$database2->setQuery("SELECT userid, username FROM {$vb_config->vb_prefix}user WHERE userid = $vbull_members[max]");
		$vbull_newuser = $database2->loadAssocList();

		$vbull_values = array(
		'numbermembers' => $vbull_members['users'],
		'activemembers' => $vbull_members['active'],
		'newusername'   => $vbull_newuser['username'],
		'newuserid'     => $vbull_newuser['userid']);

		$query = "REPLACE INTO {$vb_config->vb_prefix}datastore (title, data) VALUES ('userstats', '" . addslashes(trim(serialize($vbull_values))) . "')";
		$database2->setQuery( $query );
		$database2->query();


	} else {


		$database->setQuery( $query );
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}

		$vb_user = $database->insertid();

		$database->setQuery("SELECT MAX(userid) as userid FROM {$vb_config->vb_prefix}user");
		$vbulletin_userid = $database->loadResult();

		$database->setQuery("INSERT INTO {$vb_config->vb_prefix}userfield     SET userid = '$vbulletin_userid'");
		$database->query();
		$database->setQuery("INSERT INTO {$vb_config->vb_prefix}usertextfield SET userid = '$vbulletin_userid'");
		$database->query();

		$database->setQuery("SELECT COUNT(*) AS users, MAX(userid) AS max FROM {$vb_config->vb_prefix}user");
		$vbull_members = $database->loadAssocList();

		$database->setQuery("SELECT userid, username FROM {$vb_config->vb_prefix}user WHERE userid = $vbull_members[max]");
		$vbull_newuser = $database->loadAssocList();

		$vbull_values = array(
		'numbermembers' => $vbull_members['users'],
		'activemembers' => $vbull_members['active'],
		'newusername'   => $vbull_newuser['username'],
		'newuserid'     => $vbull_newuser['userid']);

		$query = "REPLACE INTO {$vb_config->vb_prefix}datastore (title, data) VALUES ('userstats', '" . addslashes(trim(serialize($vbull_values))) . "')";
		$database->setQuery( $query );
		$database->query();
	}


	$query = "UPDATE #__users"
	. "\n SET vb_userid = '$vb_user'"
	. "\n WHERE id = '$row->id'"
	;
	$database->setQuery( $query );
	$database->query() or die( $database->stderr() );

}

function activate( $option ) {
	global $database;
	global $mosConfig_useractivation, $mosConfig_allowUserRegistration;

	if ($mosConfig_allowUserRegistration == '0' || $mosConfig_useractivation == '0') {
		mosNotAuth();
		return;
	}

	$activation = mosGetParam( $_REQUEST, 'activation', '' );
	$activation = $database->getEscaped( $activation );

	if (empty( $activation )) {
		echo _REG_ACTIVATE_NOT_FOUND;
		return;
	}

	$query = "SELECT id"
	. "\n FROM #__users"
	. "\n WHERE activation = '$activation'"
	. "\n AND block = 1"
	;
	$database->setQuery( $query );
	$result = $database->loadResult();

	if ($result) {
		$query = "UPDATE #__users"
		. "\n SET block = 0, activation = ''"
		. "\n WHERE activation = '$activation'"
		. "\n AND block = 1"
		;
		$database->setQuery( $query );
		if (!$database->query()) {
			echo "SQL error" . $database->stderr(true);
		}
		echo _REG_ACTIVATE_COMPLETE;
	} else {
		echo _REG_ACTIVATE_NOT_FOUND;
	}
}

function is_email($email){
	$rBool=false;

	if(preg_match("/[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}/", $email)){
		$rBool=true;
	}
	return $rBool;
}
?>
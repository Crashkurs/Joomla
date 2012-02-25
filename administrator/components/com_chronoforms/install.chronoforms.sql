DELETE FROM `#__menu` WHERE `client_id` = '1' AND `title` LIKE '%COM_CHRONOFORMS%';
DELETE FROM `#__extensions` WHERE `type` = 'component' AND `element` = 'com_chronoforms';
CREATE TABLE IF NOT EXISTS `#__chronoforms` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`form_type` tinyint(1) NOT NULL,
	`content` longtext NOT NULL,
	`wizardcode` longtext,
	`events_actions_map` longtext,
	`params` longtext NOT NULL,
	`published` tinyint(1) NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
) CHARACTER SET `utf8`;
ALTER TABLE `#__chronoforms` ADD `app` VARCHAR( 100 ) NOT NULL DEFAULT '';
CREATE TABLE IF NOT EXISTS `#__chronoform_actions` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`chronoform_id` int(11) NOT NULL,
	`type` varchar(255) NOT NULL,
	`enabled` tinyint(1) NOT NULL,
	`params` longtext NOT NULL,
	`order` int(11) NOT NULL,
	`content1` longtext NOT NULL,
	PRIMARY KEY (`id`)
) CHARACTER SET `utf8`;
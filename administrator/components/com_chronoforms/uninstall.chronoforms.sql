DROP TABLE IF EXISTS `#__chronoforms`;
DROP TABLE IF EXISTS `#__chronoform_actions`;
DELETE FROM `#__menu` WHERE `client_id` = '1' AND `title` LIKE '%COM_CHRONOFORMS%';
DELETE FROM `#__extensions` WHERE `type` = 'component' AND `element` = 'com_chronoforms';
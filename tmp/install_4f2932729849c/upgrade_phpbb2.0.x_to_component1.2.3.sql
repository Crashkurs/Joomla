# --------------------------------------------------------
#
# Table structure for table 'mos_users'
#
ALTER TABLE `mos_users` RENAME `mos_users_backup`;

CREATE TABLE `mos_users` (
  `id` mediumint(8) NOT NULL default '0',
  `user_active` tinyint(1) default '1',
  `username` varchar(25) NOT NULL default '',
  `password` varchar(32) NOT NULL default '',
  `name` varchar(50) NOT NULL default '',
  `usertype` varchar(25) NOT NULL default '',
  `block` tinyint(4) NOT NULL default '0',
  `sendEmail` tinyint(4) default '0',
  `gid` tinyint(3) unsigned NOT NULL default '1',
  `registerDate` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastvisitDate` datetime NOT NULL default '0000-00-00 00:00:00',
  `user_session_time` int(11) NOT NULL default '0',
  `user_session_page` smallint(5) NOT NULL default '0',
  `user_lastvisit` int(11) NOT NULL default '0',
  `user_regdate` int(11) NOT NULL default '0',
  `user_level` tinyint(4) default '0',
  `user_posts` mediumint(8) unsigned NOT NULL default '0',
  `user_timezone` decimal(5,2) NOT NULL default '0.00',
  `user_style` tinyint(4) default NULL,
  `user_lang` varchar(255) default NULL,
  `user_dateformat` varchar(14) NOT NULL default 'd M Y H:i',
  `user_new_privmsg` smallint(5) unsigned NOT NULL default '0',
  `user_unread_privmsg` smallint(5) unsigned NOT NULL default '0',
  `user_last_privmsg` int(11) NOT NULL default '0',
  `user_emailtime` int(11) default NULL,
  `user_viewemail` tinyint(1) default NULL,
  `user_attachsig` tinyint(1) default NULL,
  `user_allowhtml` tinyint(1) default '1',
  `user_allowbbcode` tinyint(1) default '1',
  `user_allowsmile` tinyint(1) default '1',
  `user_allowavatar` tinyint(1) NOT NULL default '1',
  `user_allow_pm` tinyint(1) NOT NULL default '1',
  `user_allow_viewonline` tinyint(1) NOT NULL default '1',
  `user_notify` tinyint(1) NOT NULL default '1',
  `user_notify_pm` tinyint(1) NOT NULL default '0',
  `user_popup_pm` tinyint(1) NOT NULL default '0',
  `user_rank` int(11) default '0',
  `user_avatar` varchar(100) default NULL,
  `user_avatar_type` tinyint(4) NOT NULL default '0',
  `email` varchar(255) default NULL,
  `user_icq` varchar(15) default NULL,
  `user_website` varchar(100) default NULL,
  `user_from` varchar(100) default NULL,
  `user_sig` text,
  `user_sig_bbcode_uid` varchar(10) default NULL,
  `user_aim` varchar(255) default NULL,
  `user_yim` varchar(255) default NULL,
  `user_msnm` varchar(255) default NULL,
  `user_occ` varchar(100) default NULL,
  `user_interests` varchar(255) default NULL,
  `user_actkey` varchar(32) default NULL,
  `user_newpasswd` varchar(32) default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_session_time` (`user_session_time`),
  KEY `usertype` (`usertype`)
) TYPE=MyISAM;

#
# Table structure for table 'phpbb_attachments_config'
#
CREATE TABLE phpbb_attachments_config (
  config_name varchar(255) NOT NULL,
  config_value varchar(255) NOT NULL,
  PRIMARY KEY (config_name)
);

#
# Table structure for table 'phpbb_forbidden_extensions'
#
CREATE TABLE phpbb_forbidden_extensions (
  ext_id mediumint(8) UNSIGNED NOT NULL auto_increment, 
  extension varchar(100) NOT NULL, 
  PRIMARY KEY (ext_id)
);

#
# Table structure for table 'phpbb_extension_groups'
#
CREATE TABLE phpbb_extension_groups (
  group_id mediumint(8) NOT NULL auto_increment,
  group_name char(20) NOT NULL,
  cat_id tinyint(2) DEFAULT '0' NOT NULL, 
  allow_group tinyint(1) DEFAULT '0' NOT NULL,
  download_mode tinyint(1) UNSIGNED DEFAULT '1' NOT NULL,
  upload_icon varchar(100) DEFAULT '',
  max_filesize int(20) DEFAULT '0' NOT NULL,
  forum_permissions varchar(255) default '' NOT NULL,
  PRIMARY KEY group_id (group_id)
);

#
# Table structure for table 'phpbb_extensions'
#
CREATE TABLE phpbb_extensions (
  ext_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  group_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  extension varchar(100) NOT NULL,
  comment varchar(100),
  PRIMARY KEY ext_id (ext_id)
);

#
# Table structure for table 'phpbb_attachments_desc'
#
CREATE TABLE phpbb_attachments_desc (
  attach_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  physical_filename varchar(255) NOT NULL,
  real_filename varchar(255) NOT NULL,
  download_count mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  comment varchar(255),
  extension varchar(100),
  mimetype varchar(100),
  filesize int(20) NOT NULL,
  filetime int(11) DEFAULT '0' NOT NULL,
  thumbnail tinyint(1) DEFAULT '0' NOT NULL,
  PRIMARY KEY (attach_id),
  KEY filetime (filetime),
  KEY physical_filename (physical_filename(10)),
  KEY filesize (filesize)
);

#
# Table structure for table 'phpbb_attachments'
#
CREATE TABLE phpbb_attachments (
  attach_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL, 
  post_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL, 
  privmsgs_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  user_id_1 mediumint(8) NOT NULL,
  user_id_2 mediumint(8) NOT NULL,
  KEY attach_id_post_id (attach_id, post_id),
  KEY attach_id_privmsgs_id (attach_id, privmsgs_id)
); 

#
# Table structure for table 'phpbb_quota_limits'
#
CREATE TABLE phpbb_quota_limits (
  quota_limit_id mediumint(8) unsigned NOT NULL auto_increment,
  quota_desc varchar(20) NOT NULL default '',
  quota_limit bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY  (quota_limit_id)
);

#
# Table structure for table 'phpbb_attach_quota'
#
CREATE TABLE phpbb_attach_quota (
  user_id mediumint(8) unsigned NOT NULL default '0',
  group_id mediumint(8) unsigned NOT NULL default '0',
  quota_type smallint(2) NOT NULL default '0',
  quota_limit_id mediumint(8) unsigned NOT NULL default '0',
  KEY quota_type (quota_type)
);

ALTER TABLE phpbb_forums ADD auth_download TINYINT(2) DEFAULT '0' NOT NULL;  
ALTER TABLE phpbb_auth_access ADD auth_download TINYINT(1) DEFAULT '0' NOT NULL;  
ALTER TABLE phpbb_posts ADD post_attachment TINYINT(1) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_topics ADD topic_attachment TINYINT(1) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_privmsgs ADD privmsgs_attachment TINYINT(1) DEFAULT '0' NOT NULL;


#
# Table structure for annoucement mod
#

ALTER TABLE phpbb_topics ADD topic_announce_duration MEDIUMINT(5) NOT NULL;
ALTER TABLE phpbb_auth_access ADD auth_global_announce TINYINT(1) NOT NULL AFTER auth_announce;
ALTER TABLE phpbb_forums ADD auth_global_announce TINYINT(2) NOT NULL AFTER auth_announce;
UPDATE phpbb_forums SET auth_global_announce=5;




# -- attachments_config
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('upload_dir','files');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('upload_img','images/icon_clip.gif');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('topic_icon','images/icon_clip.gif');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('display_order','0');

INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('max_filesize','262144');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('attachment_quota','52428800');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('max_filesize_pm','262144');

INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('max_attachments','3');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('max_attachments_pm','1');

INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('disable_mod','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('allow_pm_attach','1');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('attachment_topic_review','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('allow_ftp_upload','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('show_apcp','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('attach_version','2.3.9');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('default_upload_quota', '0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('default_pm_quota', '0');

INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_server','');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_path','');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('download_path','');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_user','');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_pass','');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_pasv_mode','1');

INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_display_inlined','1');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_max_width','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_max_height','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_link_width','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_link_height','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_create_thumbnail','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_min_thumb_filesize','12000');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_imagick', '');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('use_gd2','0');

INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('wma_autoplay','0');

INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('flash_autoplay','0');

# -- forbidden_extensions
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (1,'php');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (2,'php3');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (3,'php4');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (4,'phtml');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (5,'pl');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (6,'asp');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (7,'cgi');

# -- extension_groups
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (1,'Images',1,1,1,'',0,'');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (2,'Archives',0,1,1,'',0,'');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (3,'Plain Text',0,0,1,'',0,'');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (4,'Documents',0,0,1,'',0,'');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (5,'Real Media',0,0,2,'',0,'');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (6,'Streams',2,0,1,'',0,'');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (7,'Flash Files',3,0,1,'',0,'');

# -- extensions
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (1, 1,'gif', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (2, 1,'png', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (3, 1,'jpeg', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (4, 1,'jpg', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (5, 1,'tif', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (6, 1,'tga', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (7, 2,'gtar', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (8, 2,'gz', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (9, 2,'tar', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (10, 2,'zip', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (11, 2,'rar', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (12, 2,'ace', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (13, 3,'txt', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (14, 3,'c', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (15, 3,'h', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (16, 3,'cpp', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (17, 3,'hpp', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (18, 3,'diz', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (19, 4,'xls', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (20, 4,'doc', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (21, 4,'dot', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (22, 4,'pdf', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (23, 4,'ai', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (24, 4,'ps', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (25, 4,'ppt', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (26, 5,'rm', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (27, 6,'wma', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (28, 7,'swf', '');

# -- default quota limits
INSERT INTO phpbb_quota_limits (quota_limit_id, quota_desc, quota_limit) VALUES (1, 'Low', 262144);
INSERT INTO phpbb_quota_limits (quota_limit_id, quota_desc, quota_limit) VALUES (2, 'Medium', 2097152);
INSERT INTO phpbb_quota_limits (quota_limit_id, quota_desc, quota_limit) VALUES (3, 'High', 5242880);

# --------------------------------------------------------
#
# Update version for phpbb
#
UPDATE `phpbb_config` SET `config_value` = '.0.10' WHERE `config_name` = 'version' LIMIT 1;

UPDATE `phpbb_config` SET `config_value` = '0' WHERE `config_name` = 'gzip_compress';
UPDATE `phpbb_config` SET `config_value` = '1' WHERE `config_name` = 'default_style';

#
# Table structure for table 'phpbb_flags'
#


ALTER TABLE mos_users ADD user_from_flag varchar(25) NULL AFTER user_from;

CREATE TABLE phpbb_flags (
   flag_id int(10) NOT NULL auto_increment,
   flag_name varchar(25),
   flag_image varchar(25),
   PRIMARY KEY (flag_id)
);

INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','usa','usa.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','afghanistan','afghanistan.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','albania','albania.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','algeria','algeria.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','andorra','andorra.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','angola','angola.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','antigua and barbuda','antiguabarbuda.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','argentina','argentina.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','armenia','armenia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','australia','australia.gif');

INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','austria','austria.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','azerbaijan','azerbaijan.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','bahamas','bahamas.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','bahrain','bahrain.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','bangladesh','bangladesh.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','barbados','barbados.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','belarus','belarus.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','belgium','belgium.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','belize','belize.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','benin','benin.gif');

INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','bhutan','bhutan.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','bolivia','bolivia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','bosnia herzegovina','bosnia_herzegovina.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','botswana','botswana.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','brazil','brazil.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','brunei','brunei.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','bulgaria','bulgaria.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','burkinafaso','burkinafaso.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','burma','burma.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','burundi','burundi.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','cambodia','cambodia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','cameroon','cameroon.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','canada','canada.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','central african rep','centralafricanrep.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','chad','chad.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','chile','chile.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','china','china.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','columbia','columbia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','comoros','comoros.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','congo','congo.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','costarica','costarica.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','croatia','croatia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','cuba','cuba.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','cyprus','cyprus.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','czech republic','czechrepublic.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','demrepcongo','demrepcongo.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','denmark','denmark.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','djibouti','djibouti.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','dominica','dominica.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','dominican rep','dominicanrep.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','ecuador','ecuador.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','egypt','egypt.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','elsalvador','elsalvador.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','eq guinea','eq_guinea.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','eritrea','eritrea.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','estonia','estonia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','ethiopia','ethiopia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','fiji','fiji.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','finland','finland.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','france','france.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','gabon','gabon.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','gambia','gambia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','georgia','georgia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','germany','germany.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','ghana','ghana.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','greece','greece.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','grenada','grenada.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','grenadines','grenadines.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','guatemala','guatemala.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','guinea','guinea.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','guineabissau','guineabissau.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','guyana','guyana.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','haiti','haiti.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','honduras','honduras.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','hong kong','hong_kong.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','hungary','hungary.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','iceland','iceland.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','india','india.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','indonesia','indonesia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','iran','iran.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','iraq','iraq.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','ireland','ireland.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','israel','israel.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','italy','italy.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','ivory coast','ivorycoast.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','jamaica','jamaica.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','japan','japan.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','jordan','jordan.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','kazakhstan','kazakhstan.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','kenya','kenya.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','kiribati','kiribati.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','kuwait','kuwait.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','kyrgyzstan','kyrgyzstan.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','laos','laos.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','latvia','latvia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','lebanon','lebanon.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','liberia','liberia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','libya','libya.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','liechtenstein','liechtenstein.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','lithuania','lithuania.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','luxembourg','luxembourg.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','macadonia','macadonia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','macau','macau.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','madagascar','madagascar.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','malawi','malawi.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','malaysia','malaysia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','maldives','maldives.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','mali','mali.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','malta','malta.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','mauritania','mauritania.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','mauritius','mauritius.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','mexico','mexico.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','micronesia','micronesia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','moldova','moldova.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','monaco','monaco.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','mongolia','mongolia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','morocco','morocco.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','mozambique','mozambique.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','namibia','namibia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','nauru','nauru.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','nepal','nepal.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','neth antilles','neth_antilles.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','netherlands','netherlands.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','new zealand','newzealand.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','nicaragua','nicaragua.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','niger','niger.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','nigeria','nigeria.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','north korea','north_korea.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','norway','norway.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','oman','oman.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','pakistan','pakistan.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','panama','panama.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','papua newguinea','papuanewguinea.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','paraguay','paraguay.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','peru','peru.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','philippines','philippines.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','poland','poland.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','portugal','portugal.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','puertorico','puertorico.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','qatar','qatar.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','rawanda','rawanda.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','romania','romania.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','russia','russia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','sao tome','sao_tome.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','saudiarabia','saudiarabia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','senegal','senegal.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','serbia','serbia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','seychelles','seychelles.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','sierraleone','sierraleone.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','singapore','singapore.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','slovakia','slovakia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','slovenia','slovenia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','solomon islands','solomon_islands.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','somalia','somalia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','south_korea','south_korea.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','south africa','southafrica.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','spain','spain.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','srilanka','srilanka.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','stkitts nevis','stkitts_nevis.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','stlucia','stlucia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','sudan','sudan.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','suriname','suriname.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','sweden','sweden.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','switzerland','switzerland.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','syria','syria.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','taiwan','taiwan.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','tajikistan','tajikistan.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','tanzania','tanzania.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','thailand','thailand.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','togo','togo.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','tonga','tonga.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','trinidad and tobago','trinidadandtobago.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','tunisia','tunisia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','turkey','turkey.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','turkmenistan','turkmenistan.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','tuvala','tuvala.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','uae','uae.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','uganda','uganda.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','uk','uk.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','ukraine','ukraine.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','uruguay','uruguay.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','ussr','ussr.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','uzbekistan','uzbekistan.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','vanuatu','vanuatu.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','venezuela','venezuela.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','vietnam','vietnam.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','western samoa','western_samoa.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','yemen','yemen.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','yugoslavia','yugoslavia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','zaire','zaire.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','zambia','zambia.gif');
INSERT INTO phpbb_flags (flag_id, flag_name, flag_image) VALUES ('','zimbabwe','zimbabwe.gif');
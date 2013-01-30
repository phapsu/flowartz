
CREATE TABLE IF NOT EXISTS `fa_workshops` (
  `wid` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `teacher_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(10) NOT NULL,
  `fee` varchar(255) NOT NULL,
  `fee_currency` varchar(4) NOT NULL DEFAULT 'CAD',
  `cat_id` tinyint(1) NOT NULL COMMENT 'category_id',
  `tag` varchar(255) NOT NULL,
  `skill_level` varchar(255) NOT NULL,
  `spot_available` varchar(255) NOT NULL,
  `tools_required` varchar(255) NOT NULL,
  `length` varchar(5) NOT NULL,
  `frequency` varchar(5) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '=0: new; =1: finish',
  PRIMARY KEY (`wid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;




CREATE TABLE IF NOT EXISTS `fa_workshops_files` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `wid` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ordered` tinyint(2) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `uid_idx` (`wid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `fa_workshops` ADD `enrolled_counter` TINYINT( 3 ) NOT NULL DEFAULT '0' AFTER `status` ;

ALTER TABLE `fa_workshops` ADD `to_date` DATE NOT NULL AFTER `date` ;

ALTER TABLE `fa_workshops` ADD `image` VARCHAR( 255 ) NOT NULL AFTER `enrolled_counter` ;
ALTER TABLE `fa_workshops` CHANGE `frequency` `frequency` VARCHAR( 10 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
ALTER TABLE `fa_workshops` CHANGE `length` `length` VARCHAR( 10 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
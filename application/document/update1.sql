ALTER TABLE  `fa_users` ADD  `type_id` TINYINT( 1 ) NOT NULL DEFAULT  '2' AFTER  `city`;

CREATE TABLE IF NOT EXISTS `fa_users_classes` (
  `cid` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `paypal_code` text NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `fee` varchar(255) NOT NULL,
  `fee_currency` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '=0: new; =1: finish; =2:finshed',
  PRIMARY KEY (`cid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

ALTER TABLE  `ipn_orders` ADD  `class_id` INT NOT NULL AFTER  `custom`
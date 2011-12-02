-- 
-- Table structure for table `commuter`
-- 

CREATE TABLE `commuter` (
  `COMMUTER_ID` bigint(38) unsigned NOT NULL auto_increment,
  `fname` varchar(50) default NULL,
  `lname` varchar(50) default NULL,
  `title` varchar(100) default NULL,
  `company` varchar(100) default NULL,
  `address` varchar(100) default NULL,
  `city` varchar(50) default NULL,
  `state` varchar(50) default NULL,
  `pincode` varchar(50) default NULL,
  `email` varchar(50) default NULL,
  `phone` varchar(50) default NULL,
  `t_created` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `f_active` char(1) NOT NULL default '1',
  `Pass` varchar(50) NOT NULL,
  `srclandmark` varchar(255) default NULL,
  `dstlandmark` varchar(255) default NULL,
  `source` varchar(255) default NULL,
  `destination` varchar(255) default NULL,
  PRIMARY KEY  (`COMMUTER_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=1489 DEFAULT CHARSET=latin1 AUTO_INCREMENT=1489 ;



CREATE TABLE `commuter_route` (
  `commuter_id` bigint(38) NOT NULL,
  `route_id` bigint(38) NOT NULL,
  `f_roundtrip` char(1) NOT NULL,
  `t_created` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `vender_id` bigint(38) NOT NULL,
  `package_id` bigint(12) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `package_type` (
  `PKG_ID` bigint(38) unsigned NOT NULL,
  `Monthly` float NOT NULL,
  `Quarterly` float NOT NULL,
  `Half_Yearly` float NOT NULL,
  PRIMARY KEY  (`PKG_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



CREATE TABLE `route` (
  `ROUTE_ID` bigint(38) unsigned NOT NULL,
  `SRC_NAME` varchar(100) NOT NULL,
  `DEST_NAME` varchar(100) NOT NULL,
  `SRC_LONGITUDE` varchar(100) NOT NULL,
  `SRC_LATITUDE` varchar(100) NOT NULL,
  `DEST_LONGITUDE` varchar(100) NOT NULL,
  `DEST_LATITUDE` varchar(100) NOT NULL,
  `CITY` varchar(100) NOT NULL,
  `STATE` varchar(100) NOT NULL,
  PRIMARY KEY  (`ROUTE_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `vender` (
  `VENDER_ID` bigint(38) unsigned NOT NULL auto_increment,
  `company` varchar(100) default NULL,
  `address` varchar(100) default NULL,
  `city` varchar(100) default NULL,
  `state` varchar(100) default NULL,
  `pincode` varchar(100) default NULL,
  `email` varchar(50) default NULL,
  `phone` varchar(50) default NULL,
  `CST_NUMBER` varchar(50) default NULL,
  `t_created` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `f_active` char(1) default '1',
  `Pass` varchar(50) default NULL,
  `fullname` varchar(255) default NULL,
  PRIMARY KEY  (`VENDER_ID`),
  UNIQUE KEY `NAME` (`company`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;


CREATE TABLE `vender_routes` (
  `id` bigint(38) NOT NULL auto_increment,
  `vender_id` bigint(38) NOT NULL,
  `route_id` bigint(38) NOT NULL,
  `package_id` bigint(38) NOT NULL,
  `f_round` char(1) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `vender_id` (`vender_id`,`route_id`,`package_id`,`f_round`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;


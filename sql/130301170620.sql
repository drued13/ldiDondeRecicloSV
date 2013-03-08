/*
MySQL Backup
Source Server Version: 5.5.27
Source Database: dondereciclo
Date: 01/03/2013 17:06:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
--  Table structure for `material_point`
-- ----------------------------
DROP TABLE IF EXISTS `material_point`;
CREATE TABLE `material_point` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `material_type_id` int(10) NOT NULL,
  `point_id` int(10) unsigned NOT NULL,
  `price_per_pound` float DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_waste_id` (`material_type_id`) USING BTREE,
  KEY `idx_point` (`point_id`) USING BTREE,
  CONSTRAINT `fk_point` FOREIGN KEY (`point_id`) REFERENCES `point` (`id`),
  CONSTRAINT `fk_waste` FOREIGN KEY (`material_type_id`) REFERENCES `material_type` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `material_type`
-- ----------------------------
DROP TABLE IF EXISTS `material_type`;
CREATE TABLE `material_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `point`
-- ----------------------------
DROP TABLE IF EXISTS `point`;
CREATE TABLE `point` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `place_name` varchar(50) NOT NULL,
  `contact_email` varchar(50) DEFAULT NULL,
  `contact_phone` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `web_site` varchar(50) DEFAULT NULL,
  `country_geoname_id` varchar(25) NOT NULL,
  `state_geoname_id` varchar(25) NOT NULL,
  `city_geoname_id` varchar(25) DEFAULT NULL,
  `lat` decimal(9,6) NOT NULL,
  `lng` decimal(9,6) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user` (`user_id`),
  CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
--  Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records 
-- ----------------------------
INSERT INTO `material_point` VALUES ('3','1','1',NULL,'2013-03-01 10:06:52','2013-03-01 10:06:52'), ('4','2','1',NULL,'2013-03-01 10:06:52','2013-03-01 10:06:52');
INSERT INTO `material_type` VALUES ('1','latas'), ('2','pastico');
INSERT INTO `point` VALUES ('1','uno','drued.13@gmail.com',NULL,NULL,'wowfi.com','00002','00003','00001','13.861214','-81.214000','5','2013-03-01 10:06:52','2013-03-01 00:00:00');
INSERT INTO `user` VALUES ('5','Douglas','Montano','dmontano@wowfi.com','dmontano','d5c273c72530c1f103627877b78f31af8fc44075','2013-03-01 10:06:52','2013-03-01 10:06:52');

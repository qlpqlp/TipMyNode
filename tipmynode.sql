DROP TABLE IF EXISTS `nodes`;
DROP TABLE IF EXISTS `tipmynode`;

CREATE TABLE `nodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL,
  `version` varchar(255) NOT NULL,
  `subver` varchar(255) NOT NULL,
  `lat` varchar(255) NULL,
  `lon` varchar(255) NULL,
  `country` varchar(255) NULL,
  `city` varchar(255) NULL,
  `date` datetime NULL,
  `ipinfo` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tipmynode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `node_hash` varchar(255) DEFAULT NULL,
  `dogeaddress` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;
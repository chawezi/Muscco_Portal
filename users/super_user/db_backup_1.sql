-- database backup - 2023-08-26 11:53:51
SET NAMES utf8;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';
SET foreign_key_checks = 0;
SET AUTOCOMMIT = 0;
START TRANSACTION;
DROP TABLE IF EXISTS `advance_payments`;

CREATE TABLE `advance_payments` (
  `payment_id` int NOT NULL AUTO_INCREMENT,
  `advance_id` int NOT NULL,
  `amount_paid` double NOT NULL,
  `date_paid` date NOT NULL,
  `recorded_by` varchar(60) NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
INSERT INTO `advance_payments` VALUES('1','4','529151.5','2023-07-12','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD');
INSERT INTO `advance_payments` VALUES('2','2','125000','2023-07-12','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD');
INSERT INTO `advance_payments` VALUES('3','2','25000','2023-07-12','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD');
INSERT INTO `advance_payments` VALUES('4','2','100000','2023-07-12','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD');
INSERT INTO `advance_payments` VALUES('5','1','50000','2023-07-13','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD');
INSERT INTO `advance_payments` VALUES('6','6','50000','2023-07-13','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD');
INSERT INTO `advance_payments` VALUES('7','5','784251.8','2023-07-26','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD');
INSERT INTO `advance_payments` VALUES('8','5','784251.8','2023-07-26','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD');
INSERT INTO `advance_payments` VALUES('9','9','10000','2023-08-24','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD');
DROP TABLE IF EXISTS `advance_requests`;

CREATE TABLE `advance_requests` (
  `advance_id` int NOT NULL AUTO_INCREMENT,
  `requested_by` varchar(60) NOT NULL,
  `amount` double NOT NULL,
  `total_paid` double NOT NULL DEFAULT '0',
  `balance` double NOT NULL DEFAULT '0',
  `start` varchar(32) NOT NULL,
  `end` varchar(32) NOT NULL,
  `purpose` text,
  `verified_by` varchar(60) DEFAULT NULL,
  `verified_date` date DEFAULT NULL,
  `verified_comment` text,
  `months` int DEFAULT NULL,
  `monthly_installment` double DEFAULT NULL,
  `supervised_by` varchar(60) DEFAULT NULL,
  `date_supervised` date DEFAULT NULL,
  `supervisor_comment` text,
  `approved_by` varchar(60) DEFAULT NULL,
  `date_approved` date DEFAULT NULL,
  `approval_remark` text,
  `advance_status` int NOT NULL DEFAULT '0',
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`advance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
INSERT INTO `advance_requests` VALUES('1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','100000','50000','50000','2023-08','2023-09','','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-07-09','Stores Sacco and Muscco Departments','2','50000','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-07-13','Paid','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-07-13','Stores Sacco and Muscco Departments','4','2023-07-08 23:45:42');
INSERT INTO `advance_requests` VALUES('2','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','250000','250000','0','2023-08','2023-09','I would like to buy mpunga for sale','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-07-09','There is no outstanding  advance.','2','125000','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-07-09','Go ahead, all is well','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-07-12','There is no outstanding  advance.','5','2023-07-08 23:46:46');
INSERT INTO `advance_requests` VALUES('3','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','250000','0','0','2023-08','2023-09','I would like to buy mpunga for sale','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-07-09','The officer still has an outstanding advance that is to be finished next month..','2','125000','','','','','','','2','2023-07-08 23:49:25');
INSERT INTO `advance_requests` VALUES('4','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','529151.5','529151.5','0','2023-07','2023-07','kjkjk','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-07-09','There is no outstanding  advance.','1','529151.5','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-07-09','Everything is alright, go ahead and process his request.','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-07-09','Approved, give him','5','2023-07-09 00:02:18');
INSERT INTO `advance_requests` VALUES('5','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1568503.6','1568503.6','0','2023-08','2023-09','I want to pay my kids&apos;s school fees','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-07-26','rerer','2','784251.8','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-07-26','go ahead','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-07-26','dsds','5','2023-07-09 21:01:18');
INSERT INTO `advance_requests` VALUES('6','1','50000','50000','0','2023-08','2023-08','I want to top up on my rent..','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-07-13','Hello, go ahead','1','50000','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-07-13','dssd','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-07-13','Okay','5','2023-07-13 03:27:19');
INSERT INTO `advance_requests` VALUES('7','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','25000','0','25000','01-01-2021','01-01-2021','ghgh kjkj','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-07-26','hhgh','1','25000','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-07-26','jhhj','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-07-26','kjkj','4','2023-07-26 15:48:40');
INSERT INTO `advance_requests` VALUES('9','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','30000','10000','20000','2023-08','2023-10','School fees for my daughter','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-24','There are no outstanding loans.','3','10000','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-24','There are no outstanding loans. Everything is in order','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-24','If there are no outstanding loan, go ahead and give him.','4','2023-08-24 10:12:11');
INSERT INTO `advance_requests` VALUES('10','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','12333','0','12333','2023-08','2023-09','To buy fertilizer','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-24','There are no outstanding loans.','2','6166.5','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-24','There are no outstanding loans.','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-24','There are no outstanding loans.','4','2023-08-24 10:34:36');
INSERT INTO `advance_requests` VALUES('12','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','90000','0','90000','2023-08','2023-09','To buy land','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-24','There are no outstanding loans.','2','45000','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-24','There are no outstanding loans. Everything is in order','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-24','If there are no outstanding loan, go ahead and give him.','4','2023-08-24 16:31:53');
INSERT INTO `advance_requests` VALUES('14','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1000','0','1000','2023-09','2023-09','hello therer','','','','1','1000','','','','','','','0','2023-08-26 02:33:36');
DROP TABLE IF EXISTS `band_rates`;

CREATE TABLE `band_rates` (
  `band_id` int NOT NULL AUTO_INCREMENT,
  `band_title` varchar(32) NOT NULL,
  `accomodation_ceiling` double NOT NULL,
  `lumpsum` double NOT NULL,
  `with_accomodation` double NOT NULL,
  `withoutaccomodation_nomeals` double NOT NULL,
  `withoutaccomodation_withmeals` double NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`band_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
INSERT INTO `band_rates` VALUES('1','Band 1','100000','50000','20000','15000','10000','2023-08-15 12:19:51');
INSERT INTO `band_rates` VALUES('2','Band 2','70000','35000','15000','10000','7000','2023-08-15 12:21:22');
INSERT INTO `band_rates` VALUES('3','Band 3','40000','30000','12500','8000','5000','2023-08-15 12:22:39');
INSERT INTO `band_rates` VALUES('4','Band 4','30000','25000','10000','5000','5000','2023-08-15 12:23:55');
DROP TABLE IF EXISTS `daily_itinerary`;

CREATE TABLE `daily_itinerary` (
  `daily_id` int NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(60) NOT NULL,
  `travel_advance_id` varchar(128) NOT NULL,
  `date` date NOT NULL,
  `place_from` varchar(128) NOT NULL,
  `place_to` varchar(128) NOT NULL,
  PRIMARY KEY (`daily_id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;
INSERT INTO `daily_itinerary` VALUES('1','1','1692262953HRyC7YmS0Q7HLxzGBDkWLugjK4kexmXrysuhRLQaMTAEca5mF5','2023-08-18','Lilongwe','Zomba');
INSERT INTO `daily_itinerary` VALUES('9','1','1692262953HRyC7YmS0Q7HLxzGBDkWLugjK4kexmXrysuhRLQaMTAEca5mF5','2023-08-19','Zomba','Blantyre');
INSERT INTO `daily_itinerary` VALUES('10','1','1692262953HRyC7YmS0Q7HLxzGBDkWLugjK4kexmXrysuhRLQaMTAEca5mF5','2023-08-20','Blantyre','Lilongwe');
INSERT INTO `daily_itinerary` VALUES('12','1','1692290831X8CJgtoPGZ14c1uDnCMiC48Bpa84','2023-08-18','Lilongwe','Blantyre');
INSERT INTO `daily_itinerary` VALUES('13','1','1692290831X8CJgtoPGZ14c1uDnCMiC48Bpa84','2023-08-19','Blantyre','Zomba');
INSERT INTO `daily_itinerary` VALUES('14','1','1692290831X8CJgtoPGZ14c1uDnCMiC48Bpa84','2023-08-20','Zomba','Lilongwe');
INSERT INTO `daily_itinerary` VALUES('15','1','1692306681rqL4P','2023-08-18','Lilongwe','Zomba');
INSERT INTO `daily_itinerary` VALUES('16','1','1692307434BusOcy4yROiisObaWHwc','2023-08-18','Lilongwe','Zomba');
INSERT INTO `daily_itinerary` VALUES('17','1','1692307434BusOcy4yROiisObaWHwc','2023-08-18','Zomba','Lilongwe');
INSERT INTO `daily_itinerary` VALUES('18','1','1692307734LLMQP','2023-08-18','Lilongwe','Blantyre');
INSERT INTO `daily_itinerary` VALUES('19','1','1692342012qyGLOqNZj3qBh814OACrpFlq9KnXGisivIfmoXDTMcDK34dg','2023-08-19','Lilongwe','Zomba');
INSERT INTO `daily_itinerary` VALUES('20','1','1692342088d0NEHvoxLeTE1IbJZKAD1AJfwMvr3f7LqvKx','2023-08-19','Lilongwe','Blantyre');
INSERT INTO `daily_itinerary` VALUES('21','1','1692516679rlYuPa6enM','2023-08-21','Lilongwe','Zomba');
INSERT INTO `daily_itinerary` VALUES('22','1','1692518592aLX7H2nxzxum','2023-08-21','Lilongwe','Blantyre');
INSERT INTO `daily_itinerary` VALUES('23','1','1692518754HdBKXvF87mSjtnGqP2JCGW2tpozHleCZCSx29t','2023-08-22','Lilongwe','Zomba');
INSERT INTO `daily_itinerary` VALUES('24','1','1692518849qFh8pVoePkcmwqGWXjXvhaj4','2023-08-21','Lilongwe','Zomba');
INSERT INTO `daily_itinerary` VALUES('25','1','1692518849qFh8pVoePkcmwqGWXjXvhaj4','2023-08-21','Zomba','Lilongwe');
INSERT INTO `daily_itinerary` VALUES('26','1','1692519165RRhZaj3TZ1pbF1HGSyBs1','2023-08-21','Lilongwe','Blantyre');
INSERT INTO `daily_itinerary` VALUES('27','1','169251948218a6ApwCWtVn','2023-08-21','Lilongwe','Zomba');
INSERT INTO `daily_itinerary` VALUES('28','1','1689845872vDGIFNvOKYuQlisZk85JI2TtGni0N','2023-07-21','Lilongwe','Blantyre');
INSERT INTO `daily_itinerary` VALUES('29','1','1689845872vDGIFNvOKYuQlisZk85JI2TtGni0N','2023-07-22','Blantyre','Lilongwe');
INSERT INTO `daily_itinerary` VALUES('30','1','1689845949PhhyKfG3JdN2kzi3rLPMi3b70aaImyZTLL4FSj6BUVNRmFf','2023-07-21','Blantyre','Zomba');
INSERT INTO `daily_itinerary` VALUES('31','1','1689845949PhhyKfG3JdN2kzi3rLPMi3b70aaImyZTLL4FSj6BUVNRmFf','2023-07-22','Zomba','Lilongwe');
INSERT INTO `daily_itinerary` VALUES('32','1','1689846013ZOPRUYxL','2023-07-22','Lilongwe','Zomba');
INSERT INTO `daily_itinerary` VALUES('33','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1692547940y6LVy535RcfhE16VzdEQRxZzVmcUcv7B','2023-08-21','Lilongwe','Blantyre');
INSERT INTO `daily_itinerary` VALUES('34','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1692547940y6LVy535RcfhE16VzdEQRxZzVmcUcv7B','2023-08-22','Blantyre','Lilongwe');
INSERT INTO `daily_itinerary` VALUES('35','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','16925485008yYi5ozUi2xDA1uTrfqY9Goe9','2023-08-21','Lilongwe','Zomba');
INSERT INTO `daily_itinerary` VALUES('36','cQNxbUoASET5XxUBlicaZsxoaQs3ByVDxrR7sNrcKLlekz0J','1692563160XiT3Sy','2023-08-21','Lilongwe','Blantyre');
INSERT INTO `daily_itinerary` VALUES('37','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1692563924Er5hR38iyaSdNb5N6RE0w0','2023-08-22','Lilongwe','Blantyre');
INSERT INTO `daily_itinerary` VALUES('38','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1692563924Er5hR38iyaSdNb5N6RE0w0','2023-08-23','Blantyre','Zomba');
INSERT INTO `daily_itinerary` VALUES('39','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1692563924Er5hR38iyaSdNb5N6RE0w0','2023-08-24','Zomba','Lilongwe');
INSERT INTO `daily_itinerary` VALUES('41','1','1692801960pBpKnG','2023-08-24','Lilongwe','Blantyre');
INSERT INTO `daily_itinerary` VALUES('43','1','1692811995nyZJQ0R4IJ1DPQYaothvxCldeWqv3YmUh','2023-08-24','Lilongwe','Blantyre');
INSERT INTO `daily_itinerary` VALUES('44','1','1692812171uwZgGx5ZCS2PfItqQRfp','2023-08-24','Lilongwe','Blantyre');
INSERT INTO `daily_itinerary` VALUES('45','1','1692812171uwZgGx5ZCS2PfItqQRfp','2023-08-17','Lilongwe','Blantyre');
INSERT INTO `daily_itinerary` VALUES('46','1','1692812854pwm3k90','2023-08-24','Lilongwe','Blantyre');
INSERT INTO `daily_itinerary` VALUES('47','1','1692812854pwm3k90','2023-08-25','Lilongwe','Blantyre');
INSERT INTO `daily_itinerary` VALUES('48','1','16928136783OaqbY4vMIROvh4sS3YmAnURSdd8ikZc','2023-08-24','Lilongwe','Blantyre');
INSERT INTO `daily_itinerary` VALUES('49','1','16928136783OaqbY4vMIROvh4sS3YmAnURSdd8ikZc','2023-08-24','Lilongwe','Blantyre');
INSERT INTO `daily_itinerary` VALUES('50','1','16928136783OaqbY4vMIROvh4sS3YmAnURSdd8ikZc','2023-08-25','Lilongwe','Blantyre');
INSERT INTO `daily_itinerary` VALUES('51','1','16928136783OaqbY4vMIROvh4sS3YmAnURSdd8ikZc','2023-08-25','Lilongwe','Blantyre');
INSERT INTO `daily_itinerary` VALUES('52','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1692814062i4Y5sgjhxL9KfS0dpu14OPNiTea045dMl5LCf9','2023-08-24','Lilongwe','Blantyre');
INSERT INTO `daily_itinerary` VALUES('53','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1692814168K1mNNVxqinVkFMdxxtxan','2023-08-24','Lilongwe','Blantyre');
INSERT INTO `daily_itinerary` VALUES('54','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1692814191RBMfQubScrAkb3N8QVEHS','2023-08-25','Lilongwe','Blantyre');
INSERT INTO `daily_itinerary` VALUES('55','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1692814191RBMfQubScrAkb3N8QVEHS','2023-08-25','Lilongwe','Blantyre');
INSERT INTO `daily_itinerary` VALUES('56','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1692814191RBMfQubScrAkb3N8QVEHS','2023-08-24','Lilongwe','Blantyre');
INSERT INTO `daily_itinerary` VALUES('57','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1692814191RBMfQubScrAkb3N8QVEHS','2023-08-25','Lilongwe','Blantyre');
INSERT INTO `daily_itinerary` VALUES('58','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1692814747qXvCXnl5FqwBCk0qp','2023-08-24','Lilongwe','Blantyre');
DROP TABLE IF EXISTS `departments`;

CREATE TABLE `departments` (
  `department_id` int NOT NULL AUTO_INCREMENT,
  `department` varchar(1028) NOT NULL,
  `member_of` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 COMMENT='Stores Sacco and Muscco Departments';
INSERT INTO `departments` VALUES('1','IT','0');
INSERT INTO `departments` VALUES('3','Administration','0');
INSERT INTO `departments` VALUES('4','Accounts','0');
INSERT INTO `departments` VALUES('10','Pocurement','0');
INSERT INTO `departments` VALUES('11','Business Development and Innovations','0');
INSERT INTO `departments` VALUES('20','Audit','0');
DROP TABLE IF EXISTS `des`;

CREATE TABLE `des` (
  `id` int NOT NULL AUTO_INCREMENT,
  `de_id` varchar(60) NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `email_address` varchar(32) DEFAULT NULL,
  `phone_number` varchar(32) DEFAULT NULL,
  `location` varchar(128) DEFAULT NULL,
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
INSERT INTO `des` VALUES('1','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh','Wezzie','Mhango','wezmhango@hotmail.com','0991603780','Nanthenje','2023-07-13 23:17:22');
INSERT INTO `des` VALUES('2','7Fh2e6tPqTlJvYckPjEHncoG0h4jI8IRnMQHYaM','Wezzie','Mhango','wezmhango@hotmail.com','0991603780','Lilongwe','2023-07-13 23:23:56');
INSERT INTO `des` VALUES('3','wTKcHAp53T8FsMdBDwVL3Gbu','Hanna','Montana','hannamontana@gmail.com','0993189240','Chilobwe','2023-08-26 01:29:31');
DROP TABLE IF EXISTS `discussion_replies`;

CREATE TABLE `discussion_replies` (
  `reply_id` int NOT NULL AUTO_INCREMENT,
  `topic_id` int NOT NULL,
  `reply` text NOT NULL,
  `replied_by` varchar(60) NOT NULL,
  `date_replied` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `member_of` int NOT NULL,
  PRIMARY KEY (`reply_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;
INSERT INTO `discussion_replies` VALUES('1','4','Stores Sacco and Muscco Departments','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-06-27 19:14:07','0');
INSERT INTO `discussion_replies` VALUES('2','4','Hehehe bwana owen mukuti bwanji pamenepo, sindinakufireni','q0Z6H389aRlHT4hcqpKGI6y','2023-06-27 19:15:48','0');
INSERT INTO `discussion_replies` VALUES('3','4','Stores Sacco and Muscco Departments fdfdffdfdf fdfd fdfd dfdf dfdfd fdf fdfd fdfdf dfdfd fdfdf fdfdf fdfd fdfdf dfdf dfd','q0Z6H389aRlHT4hcqpKGI6y','2023-06-27 19:16:39','0');
INSERT INTO `discussion_replies` VALUES('4','4','what are you saying man?','q0Z6H389aRlHT4hcqpKGI6y','2023-06-27 19:20:24','0');
INSERT INTO `discussion_replies` VALUES('5','4','what are you saying man?','q0Z6H389aRlHT4hcqpKGI6y','2023-06-27 19:20:31','0');
INSERT INTO `discussion_replies` VALUES('6','4','what are you saying man?','q0Z6H389aRlHT4hcqpKGI6y','2023-06-27 19:20:35','0');
INSERT INTO `discussion_replies` VALUES('7','4','Loan Application','q0Z6H389aRlHT4hcqpKGI6y','2023-06-27 19:21:18','0');
INSERT INTO `discussion_replies` VALUES('8','4','I see','1','2023-06-27 19:26:32','0');
INSERT INTO `discussion_replies` VALUES('9','4','okay okay','1','2023-06-27 19:27:28','0');
INSERT INTO `discussion_replies` VALUES('15','4','Mwagona guys?','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-06-28 10:17:59','0');
INSERT INTO `discussion_replies` VALUES('16','4','okay buy','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-06-28 10:21:29','0');
INSERT INTO `discussion_replies` VALUES('17','4','Okay sharp boss','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-06-28 10:25:57','0');
INSERT INTO `discussion_replies` VALUES('18','4','so are we saying that we cant come to that side','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-06-28 10:26:15','0');
INSERT INTO `discussion_replies` VALUES('19','4','???','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-06-28 10:26:18','0');
INSERT INTO `discussion_replies` VALUES('20','4','?/','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-06-28 10:26:21','0');
INSERT INTO `discussion_replies` VALUES('32','4','k','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-06-28 23:39:45','0');
INSERT INTO `discussion_replies` VALUES('33','4','ok','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-06-28 23:42:25','0');
INSERT INTO `discussion_replies` VALUES('34','4','ttyty','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-06-28 23:44:52','0');
INSERT INTO `discussion_replies` VALUES('38','4','n','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-06-29 00:01:16','0');
INSERT INTO `discussion_replies` VALUES('39','4','j','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-06-29 00:05:57','0');
INSERT INTO `discussion_replies` VALUES('43','4','today','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-07-02 14:53:11','0');
INSERT INTO `discussion_replies` VALUES('44','10','hgh','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-07-02 19:24:56','0');
INSERT INTO `discussion_replies` VALUES('45','12','Stores Sacco and Muscco Departments fdfdffdfdf fdfd fdfd dfdf dfdfd fdf fdfd fdfdf dfdfd fdfdf fdfdf fdfd fdfdf dfdf dfd','tByYPo1Aja8Zdmwn5','2023-07-02 22:40:18','11');
INSERT INTO `discussion_replies` VALUES('46','12','Stores Sacco and Muscco Departments','tByYPo1Aja8Zdmwn5','2023-07-02 22:40:32','11');
INSERT INTO `discussion_replies` VALUES('47','12','yes steve','1','2023-07-02 22:41:09','0');
INSERT INTO `discussion_replies` VALUES('48','12','iuuuiu','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-07-02 22:41:41','0');
INSERT INTO `discussion_replies` VALUES('49','12','$(&quot;#add-topic&quot;).validate({       rules: {         title:{required:true},         description:{required:true},         access_rights:{required:true}       },       messages: {         title:{required:&quot;Please enter the topic&quot;},         description:{required:&quot;Please enter description of the topic&quot;},         access_rights:{required:&quot;Please choose who can see and comment on your topic&quot;}       },       submitHandler: addTopic       });         /* Handling form functionality */     function addTopic() {           var data = $(&quot;#add-topic&quot;).serialize();               $.ajax({                 type : &apos;POST&apos;,         url  : &apos;../../settings/sql-master.php&apos;,         data : data,         beforeSend: function(){            $(&quot;#topic_response&quot;).fadeOut();           $(&quot;#add_topic&quot;).html(&apos; Adding Topic...&apos;);           $(&quot;#add_comment&quot;).html(&apos; Commenting...&apos;);         },         success : function(response){ //alert(response);           if(response == 1) {                              $(&quot;#topic_response&quot;).fadeIn(1000, function(){                           $(&quot;#topic_response&quot;).html(&apos;&lt;div class=&quot;alert alert-success&quot;&gt; A new topic has been posted.&lt;/div&gt;&apos;);               $(&quot;#add_topic&quot;).html(&apos;Add Topic&apos;);               $(&quot;#add-topic&quot;)[0].reset();             });             $(&quot;#topic_response&quot;).delay(6000).fadeOut(function(){});             getTopics();                        }else if(response == 2) {                              $(&quot;#topic_response&quot;).fadeIn(1000, function(){                           $(&quot;#topic_response&quot;).html(&apos;&lt;div class=&quot;alert alert-danger&quot;&gt; Sorry, there was an error posting the new topic , please try to refresh and submit again.&lt;/div&gt;&apos;);               $(&quot;#add_topic&quot;).html(&apos;Add Topic&apos;);             });             $(&quot;#topic_response&quot;).delay(6000).fadeOut(function(){});           }           else if(response == 3){             $(&quot;#add-topic&quot;)[0].reset();             $(&quot;#add_comment&quot;).html(&apos;Comment&apos;);             getComments();           }           else if(response == 4) {                              $(&quot;#topic_response&quot;).fadeIn(1000, function(){                           $(&quot;#topic_response&quot;).html(&apos;&lt;div class=&quot;alert alert-danger&quot;&gt; Sorry, there was an error posting your comment, please try to refresh and submit again.&lt;/div&gt;&apos;);               $(&quot;#add_comment&quot;).html(&apos;Comment&apos;);             });             $(&quot;#topic_response&quot;).delay(6000).fadeOut(function(){});           }         }       });       return false;     }','tByYPo1Aja8Zdmwn5','2023-07-02 22:43:11','11');
INSERT INTO `discussion_replies` VALUES('50','12','i see','7DKHe8o4B6ET2KaySKCwGgbuc0nXJzhkUz9e5ywHmq9VZcCuMEcsopr','2023-07-02 22:45:58','11');
INSERT INTO `discussion_replies` VALUES('51','11','hehehe','1','2023-07-13 22:46:34','0');
INSERT INTO `discussion_replies` VALUES('52','12','okay','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh','2023-07-14 00:07:28','999');
INSERT INTO `discussion_replies` VALUES('53','12','hello','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh','2023-07-15 16:06:50','999');
INSERT INTO `discussion_replies` VALUES('54','12','jjjh','tByYPo1Aja8Zdmwn5','2023-07-16 21:53:21','11');
INSERT INTO `discussion_replies` VALUES('55','12','kjjjk','tByYPo1Aja8Zdmwn5','2023-07-16 21:53:29','11');
INSERT INTO `discussion_replies` VALUES('56','12','hello ther','tByYPo1Aja8Zdmwn5','2023-07-16 21:53:35','11');
INSERT INTO `discussion_replies` VALUES('57','12','fdfdfdf','7DKHe8o4B6ET2KaySKCwGgbuc0nXJzhkUz9e5ywHmq9VZcCuMEcsopr','2023-07-17 15:01:29','11');
INSERT INTO `discussion_replies` VALUES('58','12','If there are no outstanding loan, go ahead and give him.','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-26 00:08:20','0');
INSERT INTO `discussion_replies` VALUES('59','12','There are no outstanding loans. Everything is in order','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-26 01:26:31','0');
INSERT INTO `discussion_replies` VALUES('60','12','Hello there my man, are you doing fine?','wTKcHAp53T8FsMdBDwVL3Gbu','2023-08-26 01:31:42','999');
INSERT INTO `discussion_replies` VALUES('61','12','how?','wTKcHAp53T8FsMdBDwVL3Gbu','2023-08-26 01:33:59','999');
INSERT INTO `discussion_replies` VALUES('62','11','If there are no outstanding loan, go ahead and give him.','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-26 01:45:24','0');
INSERT INTO `discussion_replies` VALUES('63','10','Hello there my man, are you doing fine?','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-26 01:54:22','0');
DROP TABLE IF EXISTS `discussions`;

CREATE TABLE `discussions` (
  `topic_id` int NOT NULL AUTO_INCREMENT,
  `topic` text NOT NULL,
  `description` text NOT NULL,
  `access_rights` int NOT NULL DEFAULT '0',
  `posted_by` varchar(60) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`topic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
INSERT INTO `discussions` VALUES('4','End of year party','So as we all know, we are at the end of this year, so we as administration we are organizing a party for our office, so what do you guys think we should do? I mean what should be the theme? or the venue? any suggestions?','0','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-06-27 18:44:52');
INSERT INTO `discussions` VALUES('9','2024 General Meeting','This year the general meeting will be happening in Blantyre at Amarys Hotel.','0','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-07-02 19:05:48');
INSERT INTO `discussions` VALUES('10','Happy new year','People happy new year','0','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-07-02 19:23:52');
INSERT INTO `discussions` VALUES('11','ddwwwe','ewwewew','2','1','2023-07-02 22:20:17');
INSERT INTO `discussions` VALUES('12','Individual Loan Application Form','ewwewe','2','1','2023-07-02 22:20:30');
DROP TABLE IF EXISTS `document_categories`;

CREATE TABLE `document_categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(1028) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
INSERT INTO `document_categories` VALUES('1','Loan Application Forms');
INSERT INTO `document_categories` VALUES('2','Leave Application Forms');
INSERT INTO `document_categories` VALUES('8','New Form');
DROP TABLE IF EXISTS `documents`;

CREATE TABLE `documents` (
  `document_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(1028) NOT NULL,
  `description` text,
  `document_file` varchar(128) NOT NULL,
  `category_id` int NOT NULL,
  `access_rights` int NOT NULL DEFAULT '0',
  `document_status` int NOT NULL DEFAULT '0',
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `posted_by` varchar(60) NOT NULL,
  PRIMARY KEY (`document_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
INSERT INTO `documents` VALUES('10','Sick Leave Application Form','','1155857064_1687180321.pdf','2','0','0','2023-06-19 15:12:01','q0Z6H389aRlHT4hcqpKGI6y');
INSERT INTO `documents` VALUES('11','Loan Application form','','1816688784_1687294686.pdf','1','0','0','2023-06-20 22:58:06','1');
INSERT INTO `documents` VALUES('14','vvcvcv','','2119884886_1687858459.pdf','2','0','0','2023-06-27 11:34:19','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD');
INSERT INTO `documents` VALUES('16','Company Profile','','406808540_1688329251.pdf','2','2','0','2023-07-02 22:20:51','1');
INSERT INTO `documents` VALUES('17','Company Profile','','1931016856_1688529377.pdf','2','0','0','2023-07-05 05:56:17','1');
INSERT INTO `documents` VALUES('18','Member Account Opening','','1843073812_1693008041.pdf','2','2','0','2023-08-26 02:00:41','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD');
DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
  `event_id` int NOT NULL AUTO_INCREMENT,
  `event_title` varchar(1028) NOT NULL,
  `event_description` text NOT NULL,
  `venue` varchar(1028) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `event_attachment` varchar(32) DEFAULT NULL,
  `posted_by` varchar(60) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event_status` int NOT NULL DEFAULT '0',
  `event_permision` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
INSERT INTO `events` VALUES('3','General Meeting','Genera meeting','Boardroom','2023-06-18','2023-06-21','08:30:00','10:00:00','58930895_muscco_event.pdf','1','2023-06-17 20:23:02','2','0');
INSERT INTO `events` VALUES('4','vvcvcv','Hello there','cxcxcx','2023-06-01','2023-06-08','23:13:00','11:16:00','483847127_muscco_event.pdf','1','2023-06-17 23:13:59','1','0');
INSERT INTO `events` VALUES('5','IT Troubleshooting Training','We will have all the required skills that we need to troubleshoot for any computer problem..','Boardroom','2024-06-18','2023-06-21','10:00:00','09:00:00','89520425_muscco_event.pdf','q0Z6H389aRlHT4hcqpKGI6y','2023-06-18 19:26:32','2','0');
INSERT INTO `events` VALUES('9','sds','dsds','ds','2023-06-19','2023-06-21','00:00:00','00:00:00','','q0Z6H389aRlHT4hcqpKGI6y','2023-06-18 19:52:41','0','0');
INSERT INTO `events` VALUES('10','Annual General Assembly Meeting','We will be discussing and reviewing our year end performance.','Sunbird Capital','2023-06-24','2023-06-26','07:48:00','12:48:00','855197029_muscco_event.pdf','1','2023-06-20 22:49:49','2','0');
INSERT INTO `events` VALUES('11','Annual General Assembly Meeting','We will be discussing and reviewing our year end performance.','Sunbird Capital','2023-06-24','2023-06-26','07:48:00','12:48:00','1954583566_muscco_event.pdf','1','2023-06-20 22:49:49','2','0');
INSERT INTO `events` VALUES('12','Hello event','hello theree','Online','2023-06-24','2023-06-27','00:00:00','00:00:00','','1','2023-06-23 00:59:30','2','1');
INSERT INTO `events` VALUES('13','hjhjh','jkjk','Online','2023-06-26','2023-06-27','00:00:00','00:00:00','','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-06-24 04:48:57','1','0');
INSERT INTO `events` VALUES('14','Company Profile','hehehe','Online','2023-07-06','2023-07-07','20:30:00','12:30:00','126716647_muscco_event.pdf','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-07-02 20:20:16','1','0');
INSERT INTO `events` VALUES('15','Company Profile','hehe','Online','2023-07-04','2023-07-05','00:00:00','00:00:00','1535909610_muscco_event.png','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-07-02 20:23:35','0','0');
INSERT INTO `events` VALUES('16','Company Profile','jjjj','Hall M','2023-07-12','2023-07-15','00:00:00','00:00:00','','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-07-02 22:13:35','0','2');
INSERT INTO `events` VALUES('17','Individual Loan Application Form','hello there','Online','2023-07-15','2023-07-21','00:00:00','00:00:00','','1','2023-07-13 23:57:03','0','2');
INSERT INTO `events` VALUES('18','Member Account Opening','Description comes here','Hall','2023-08-27','2023-08-28','08:30:00','21:10:00','','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-26 02:03:04','1','0');
DROP TABLE IF EXISTS `faqs`;

CREATE TABLE `faqs` (
  `faq_id` int NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `posted_by` int NOT NULL,
  PRIMARY KEY (`faq_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
INSERT INTO `faqs` VALUES('1','How to configure Aspire 360?','Go to my computer and format your hard drive, if it asks for  a password just say yes.','2023-06-18 00:26:25','1');
INSERT INTO `faqs` VALUES('2','how to solve this problem?','Go to m computer and format your harddrive','2023-06-18 00:26:26','1');
INSERT INTO `faqs` VALUES('3','What is an admin panel?','Admin Dashboard is the backend interface of a website or an application that helps to manage the website&apos;s overall content and settings. It is widely used by the site owners to keep track of their website, make changes to their content, and more.','2023-06-18 00:35:53','1');
INSERT INTO `faqs` VALUES('4','What should an admin panel contain?','Admin dashboard template should include user &amp; SEO friendly design with a variety of components and application designs to help create your own web application with ease. This could include customization options, technical support and about 6 months of future updates.','2023-06-18 00:36:31','1');
DROP TABLE IF EXISTS `fuel_prices`;

CREATE TABLE `fuel_prices` (
  `fuel_id` int NOT NULL AUTO_INCREMENT,
  `fuel` varchar(32) NOT NULL,
  `current_price` double NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fuel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
INSERT INTO `fuel_prices` VALUES('1','Diesel','1920','2023-08-17 16:40:03');
INSERT INTO `fuel_prices` VALUES('2','Petrol','1746','2023-08-17 16:40:03');
DROP TABLE IF EXISTS `invoice_status`;

CREATE TABLE `invoice_status` (
  `change_id` int NOT NULL AUTO_INCREMENT,
  `invoice_id` int NOT NULL,
  `comment` text NOT NULL,
  `paid_amount` double NOT NULL DEFAULT '0',
  `attachment` varchar(128) DEFAULT NULL,
  `updated_by` varchar(60) NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`change_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
INSERT INTO `invoice_status` VALUES('1','1','Paid','2000000','','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-26 12:11:14');
INSERT INTO `invoice_status` VALUES('2','2','Paid','1900000','attachment_0002.pdf','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-26 12:14:04');
INSERT INTO `invoice_status` VALUES('3','3','Paid','150000','attachment_0003.pdf','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-26 12:31:01');
INSERT INTO `invoice_status` VALUES('4','4','Paid','2000000','','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-26 12:45:21');
INSERT INTO `invoice_status` VALUES('5','5','Paid','90000','','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-26 13:18:46');
DROP TABLE IF EXISTS `invoices`;

CREATE TABLE `invoices` (
  `invoice_id` int NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(32) NOT NULL,
  `sacco_id` int NOT NULL,
  `description` varchar(1028) NOT NULL,
  `amount` double NOT NULL,
  `amount_paid` double NOT NULL DEFAULT '0',
  `balance` double NOT NULL DEFAULT '0',
  `invoice_file` varchar(128) NOT NULL,
  `invoice_status` int NOT NULL DEFAULT '0',
  `posted_by` varchar(60) NOT NULL,
  `date_posted` date NOT NULL,
  `due_date` date DEFAULT NULL,
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
INSERT INTO `invoices` VALUES('1','0001','6','Training fees','2000000','0','0','muscco_invoice_0001.pdf','1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-26','2023-08-26');
INSERT INTO `invoices` VALUES('2','0002','5','System installation and training fees','1900000','0','0','muscco_invoice_0002.pdf','1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-26','2023-08-26');
INSERT INTO `invoices` VALUES('3','0003','12','Training fees','150000','0','0','muscco_invoice_0003.pdf','1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-26','2023-08-26');
INSERT INTO `invoices` VALUES('4','0004','13','System installation and training fees','2300000','0','0','muscco_invoice_0004.pdf','1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-26','2023-08-27');
INSERT INTO `invoices` VALUES('5','0005','11','Training fees','90000','0','0','muscco_invoice_0005.pdf','1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-26','2023-08-26');
DROP TABLE IF EXISTS `leave_applications`;

CREATE TABLE `leave_applications` (
  `application_id` int NOT NULL AUTO_INCREMENT,
  `member_id` varchar(60) NOT NULL,
  `leave_type` int NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `leave_days` double NOT NULL DEFAULT '0',
  `reason` text,
  `leave_roaster` text NOT NULL,
  `leave_grant` text NOT NULL,
  `checked_by` varchar(60) DEFAULT NULL,
  `verified_by` varchar(60) DEFAULT NULL,
  `approved_by` varchar(60) DEFAULT NULL,
  `declined_by` varchar(60) DEFAULT NULL,
  `fy_id` int NOT NULL,
  `leave_status` int NOT NULL DEFAULT '0',
  `date_requested` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_checked` date DEFAULT NULL,
  `date_verified` date DEFAULT NULL,
  `date_approved` date DEFAULT NULL,
  `date_declined` date DEFAULT NULL,
  `approval_note` text,
  `check_reasons` text,
  `verify_reasons` text,
  `approve_reasons` text,
  `decline_reason` text,
  PRIMARY KEY (`application_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
INSERT INTO `leave_applications` VALUES('1','1','1','2023-07-03','2023-07-07','5','','No','No','','1','1','1','3','4','2023-06-25 21:10:44','','2023-06-26','2023-06-26','2023-06-26','','','All is alright','Good','You cant be serious james, you were already on holidy last week.');
INSERT INTO `leave_applications` VALUES('2','1','1','2023-07-03','2023-07-07','0','Just want to get rest','No','No','','','1','1','3','4','2023-06-25 21:12:15','','','2023-06-26','2023-06-26','','','','Go well, don&apos;t forget to be there','You cant be serious james, you were already on holidy last week.');
INSERT INTO `leave_applications` VALUES('3','1','2','2023-06-26','2023-06-28','0','There is no need to wait any longer','Yes','No','1','','','1','3','4','2023-06-26 13:17:26','2023-06-26','','','2023-06-26','','All is alright','','','You cant be serious james, you were already on holidy last week.');
INSERT INTO `leave_applications` VALUES('4','1','1','2023-07-10','2023-07-14','5','Going to rest','Yes','Yes','1','1','1','','3','3','2023-06-26 18:39:02','2023-06-26','2023-06-26','2023-06-26','','','','All is alright','Very fine','');
INSERT INTO `leave_applications` VALUES('5','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','2023-06-28','2023-06-30','3','I want to visit my aunt in chilobwe','Yes','Yes','q0Z6H389aRlHT4hcqpKGI6y','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','','3','3','2023-06-27 08:44:48','2023-06-27','2023-06-27','2023-06-27','','','Checked','Verified','You are free to go','');
INSERT INTO `leave_applications` VALUES('6','1','1','2023-06-28','2023-06-30','3','Resting','Yes','Yes','q0Z6H389aRlHT4hcqpKGI6y','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','','3','3','2023-06-27 08:55:21','2023-06-27','2023-06-27','2023-06-27','','','good to go boss','All is alright','Go well, don&apos;t forget to be there','');
INSERT INTO `leave_applications` VALUES('7','q0Z6H389aRlHT4hcqpKGI6y','1','2023-07-03','2023-07-07','3','I want to go to Dubai','Yes','No','q0Z6H389aRlHT4hcqpKGI6y','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','','3','3','2023-06-27 21:17:04','2023-06-27','2023-06-27','2023-06-27','','','All is alright','fdfd fdfdf dfdf','','');
INSERT INTO `leave_applications` VALUES('8','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','2023-06-28','2023-06-30','0','Any','Yes','No','','','','q0Z6H389aRlHT4hcqpKGI6y','3','4','2023-06-27 21:28:30','','','','2023-06-27','','','','','Asapite');
INSERT INTO `leave_applications` VALUES('9','1','1','2023-06-28','2023-06-29','2','ijiij','Yes','No','q0Z6H389aRlHT4hcqpKGI6y','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','','3','3','2023-06-27 22:35:53','2023-06-27','2023-06-27','2023-07-02','','','','','All is alright','');
INSERT INTO `leave_applications` VALUES('10','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','2023-07-08','2023-07-14','7','dsds','Yes','Yes','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','','3','3','2023-07-01 01:18:04','2023-06-30','2023-07-02','2023-07-02','','','','All is alright','','');
INSERT INTO `leave_applications` VALUES('11','1','1','2023-07-07','2023-07-27','20','fdfd','Yes','Yes','1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','3','4','2023-07-02 21:52:38','2023-07-02','2023-08-25','','2023-08-25','','','Go on holiday again Owen','','No need to go on holiday again Owen');
INSERT INTO `leave_applications` VALUES('12','1','1','2023-07-07','2023-07-27','0','fdfd','Yes','Yes','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','','','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','3','4','2023-07-02 21:52:38','2023-07-02','','','2023-08-25','','','','','No need to go on holiday again Owen');
INSERT INTO `leave_applications` VALUES('16','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2','2023-08-26','2023-08-27','2','sss','Yes','Yes','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','3','4','2023-08-25 02:37:36','2023-08-25','2023-08-25','','2023-08-25','','','Go on holiday again Owen','','No need to go on holiday again Owen');
INSERT INTO `leave_applications` VALUES('17','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','2023-08-26','2023-08-30','5','Going for a vacation','Yes','No','','','','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','3','4','2023-08-25 11:29:14','','','','2023-08-25','','','','','No need to go on holiday again Owen');
INSERT INTO `leave_applications` VALUES('18','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','2023-08-26','2023-08-27','2','Hello there','Yes','Yes','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','','3','3','2023-08-25 12:08:45','2023-08-25','2023-08-25','2023-08-25','','','Go on holiday again Owen','Go on holiday again Owen','Go on holiday again Owen and enjoy','');
INSERT INTO `leave_applications` VALUES('19','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','2023-08-26','2023-08-26','1','23','Yes','Yes','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','1','','3','3','2023-08-25 12:16:48','2023-08-25','2023-08-25','2023-08-25','','','Go on holiday again Owen','Go on holiday again Owen','Go on holiday again Owen','');
DROP TABLE IF EXISTS `leave_entitlement`;

CREATE TABLE `leave_entitlement` (
  `entitled_id` int NOT NULL AUTO_INCREMENT,
  `member_id` varchar(60) NOT NULL,
  `type_id` int NOT NULL,
  `entitlement` double NOT NULL DEFAULT '0',
  `days_taken` double NOT NULL,
  `days_remaining` double NOT NULL,
  PRIMARY KEY (`entitled_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
INSERT INTO `leave_entitlement` VALUES('1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','30','0','0');
INSERT INTO `leave_entitlement` VALUES('2','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2','10','0','0');
INSERT INTO `leave_entitlement` VALUES('3','q0Z6H389aRlHT4hcqpKGI6y','1','30','0','0');
INSERT INTO `leave_entitlement` VALUES('4','q0Z6H389aRlHT4hcqpKGI6y','2','10','0','0');
INSERT INTO `leave_entitlement` VALUES('5','q0Z6H389aRlHT4hcqpKGI6y','3','10','0','0');
INSERT INTO `leave_entitlement` VALUES('6','1','1','30','0','0');
INSERT INTO `leave_entitlement` VALUES('7','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','3','20','0','0');
INSERT INTO `leave_entitlement` VALUES('8','wSJ3FdkBZj5aW30VtuwVRMf6BgoxpUmWcHMFly8WM7LUYZHY1bdZzY','1','9','0','0');
INSERT INTO `leave_entitlement` VALUES('9','1','2','15','0','0');
INSERT INTO `leave_entitlement` VALUES('10','1','3','20','0','0');
DROP TABLE IF EXISTS `leave_fy`;

CREATE TABLE `leave_fy` (
  `fy_id` int NOT NULL AUTO_INCREMENT,
  `fy_start` date NOT NULL,
  `fy_end` date NOT NULL,
  PRIMARY KEY (`fy_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
INSERT INTO `leave_fy` VALUES('1','2022-07-01','2023-06-30');
INSERT INTO `leave_fy` VALUES('3','2023-01-01','2023-12-31');
DROP TABLE IF EXISTS `leave_types`;

CREATE TABLE `leave_types` (
  `type_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(1028) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
INSERT INTO `leave_types` VALUES('1','Annual Leave','Paid leave');
INSERT INTO `leave_types` VALUES('2','Sick Leave','A leave based on medical grounds');
INSERT INTO `leave_types` VALUES('3','Study Leave','A leave for those studying');
DROP TABLE IF EXISTS `loans`;

CREATE TABLE `loans` (
  `loan_id` int NOT NULL AUTO_INCREMENT,
  `sacco_id` varchar(60) NOT NULL,
  `amount` double NOT NULL,
  `purpose` varchar(1028) NOT NULL,
  `application_form` varchar(60) NOT NULL,
  `posted_by` varchar(60) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `loan_status` int NOT NULL DEFAULT '0',
  `loan_interest` double DEFAULT NULL,
  `total_loan` double DEFAULT NULL,
  `amount_paid` double NOT NULL DEFAULT '0',
  `loan_balance` double NOT NULL DEFAULT '0',
  `muscco_form` varchar(60) DEFAULT NULL,
  `loan_remarks` text,
  `date_updated` date DEFAULT NULL,
  `updated_by` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`loan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
INSERT INTO `loans` VALUES('1','11','10000000','Training fees','11_1689704349.pdf','tByYPo1Aja8Zdmwn5','2023-07-18 19:23:44','1','','','0','0','MUSCCO_1689706787.pdf','Stores Sacco and Muscco Departments','2023-07-18','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD');
INSERT INTO `loans` VALUES('2','11','988811.3','Loan Repayment','11_1689701675.pdf','tByYPo1Aja8Zdmwn5','2023-07-18 19:34:35','1','20000','1000000','0','0','MUSCCO_1689714564.pdf','Approved','2023-07-18','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD');
INSERT INTO `loans` VALUES('3','11','120000','asasas','11_1689716927.pdf','tByYPo1Aja8Zdmwn5','2023-07-18 23:48:47','1','20000','140000','0','140000','MUSCCO_1689717006.pdf','There is no outstanding  advance.','2023-07-18','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD');
INSERT INTO `loans` VALUES('4','11','1222212','hjfjhjdh','11_1690381099.pdf','tByYPo1Aja8Zdmwn5','2023-07-26 16:18:19','1','9000','19000909','0','19000909','MUSCCO_1690381327.pdf','hjhjhhjh','2023-07-26','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD');
INSERT INTO `loans` VALUES('5','11','529151.5','Training fees','11_1690608880.docx','tByYPo1Aja8Zdmwn5','2023-07-29 07:34:40','0','','','0','0','','','','');
INSERT INTO `loans` VALUES('6','11','1568503.6','Loan Repayment','11_1690610860.pdf','tByYPo1Aja8Zdmwn5','2023-07-29 08:07:40','0','','','0','0','','','','');
INSERT INTO `loans` VALUES('7','11','529151.5','Training fees','11_1690610893.pdf','tByYPo1Aja8Zdmwn5','2023-07-29 08:08:13','0','','','0','0','','','','');
INSERT INTO `loans` VALUES('8','11','9000','ddsd','11_1690610948.pdf','tByYPo1Aja8Zdmwn5','2023-07-29 08:09:08','0','','','0','0','','','','');
INSERT INTO `loans` VALUES('9','11','11','hello','11_1690613762.pdf','tByYPo1Aja8Zdmwn5','2023-07-29 08:56:02','0','','','0','0','','','','');
INSERT INTO `loans` VALUES('10','11','12231','fgddh','11_1690613899.pdf','tByYPo1Aja8Zdmwn5','2023-07-29 08:58:19','0','','','0','0','','','','');
INSERT INTO `loans` VALUES('11','11','878787','jfjfjdh','11_1690613920.pdf','tByYPo1Aja8Zdmwn5','2023-07-29 08:58:40','0','','','0','0','','','','');
INSERT INTO `loans` VALUES('12','11','3223','dsd','11_1690613967.pdf','tByYPo1Aja8Zdmwn5','2023-07-29 08:59:27','0','','','0','0','','','','');
DROP TABLE IF EXISTS `members`;

CREATE TABLE `members` (
  `id` int NOT NULL AUTO_INCREMENT,
  `member_id` varchar(60) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `email_address` varchar(32) NOT NULL,
  `password` varchar(60) NOT NULL,
  `phone_number` varchar(32) NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `user_role` int NOT NULL DEFAULT '0',
  `login_trials` int NOT NULL DEFAULT '0',
  `member_of` int NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
INSERT INTO `members` VALUES('1','1','Super','Admin','chawe@gmail.com','b480c074d6b75947c02681f31c90c668c46bf6b8','0993189240','1','0','0','0','2023-06-14 01:00:25');
DROP TABLE IF EXISTS `muscco_members`;

CREATE TABLE `muscco_members` (
  `muscco_id` int NOT NULL AUTO_INCREMENT,
  `muscco_member_id` varchar(60) NOT NULL,
  `employee_id` varchar(32) DEFAULT NULL,
  `band_id` int NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `email_address` varchar(128) NOT NULL,
  `phone_number` varchar(32) NOT NULL,
  `position_id` int NOT NULL,
  `department_id` int NOT NULL,
  `dob` date NOT NULL,
  `join_date` date DEFAULT NULL,
  PRIMARY KEY (`muscco_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
INSERT INTO `muscco_members` VALUES('1','1','MUSCCO/01/104','2','James','Mhango','wezmhango@hotmail.com','0993189240','1','1','1988-01-01','2011-01-01');
INSERT INTO `muscco_members` VALUES('12','wSJ3FdkBZj5aW30VtuwVRMf6BgoxpUmWcHMFly8WM7LUYZHY1bdZzY','MUSCCO/01/100','0','Kondwa','Chikanda','chikandakondwani@gmail.com','0991603780','2','4','1998-02-03','2022-01-01');
INSERT INTO `muscco_members` VALUES('13','q0Z6H389aRlHT4hcqpKGI6y','0001','0','Wezzie','Mhango','wez@hotmail.com','0991603780','1','1','1999-01-01','2015-01-01');
INSERT INTO `muscco_members` VALUES('15','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','0020','1','Owen','Banda','ob@muscco.mw','09931892490','4','3','2002-06-06','2021-04-01');
INSERT INTO `muscco_members` VALUES('16','2','1','0','hhhhah','heheheheh','heheh@gmail.com','099799391','4','3','2023-08-16','2023-08-01');
INSERT INTO `muscco_members` VALUES('17','cQNxbUoASET5XxUBlicaZsxoaQs3ByVDxrR7sNrcKLlekz0J','MUSCCO/01/100','2','Wendi','MHANGO','wendie@gmail.com','0991603780','15','20','1988-01-01','2023-08-01');
DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications` (
  `notification_id` int NOT NULL AUTO_INCREMENT,
  `posted_by` varchar(60) NOT NULL,
  `received_by` varchar(60) NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=236 DEFAULT CHARSET=latin1;
INSERT INTO `notifications` VALUES('1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','s7bGYKKZkOZo31xr9c6bpN8WiRSOJjFu5uQHiPWApdvBwmc4Ihl21','New invoice (#10090) has been posted','Greetings Andrew, a new invoice (#10090) with description &apos;2024 Conference Attendance Fee&apos; from Muscco has been posted. Please check.','0','2023-06-24 12:06:56');
INSERT INTO `notifications` VALUES('2','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','tByYPo1Aja8Zdmwn5','New invoice (#10090) has been posted','Greetings Steven, a new invoice (#10090) with description &apos;2024 Conference Attendance Fee&apos; from Muscco has been posted. Please check.','0','2023-06-24 12:06:56');
INSERT INTO `notifications` VALUES('3','1','1','Your leave application(#1) has been denied','Hey James, your leave application has been denied, the reason(s) given are &apos;You cant be serious james, you were already on holidy last week.&apos;.','0','2023-06-26 20:09:48');
INSERT INTO `notifications` VALUES('4','1','1','Your leave application(#2) has been denied','Hey James, your leave application has been denied, the reason(s) given are &apos;You cant be serious james, you were already on holidy last week.&apos;.','0','2023-06-26 20:13:32');
INSERT INTO `notifications` VALUES('5','1','1','Your leave application(#4) has been approved','Hey James, your leave application has been approved, the note(s) given are &apos;Very fine&apos;.','0','2023-06-26 20:16:41');
INSERT INTO `notifications` VALUES('6','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','q0Z6H389aRlHT4hcqpKGI6y','You have received a new leave application(#5) to check','Hey Wezzie, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-06-27 08:44:48');
INSERT INTO `notifications` VALUES('7','1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','Your leave application(#5) has been approved','Hey Owen Kamtumba, your leave application has been approved, the note(s) given are &apos;You are free to go&apos;.','0','2023-06-27 08:50:02');
INSERT INTO `notifications` VALUES('8','1','q0Z6H389aRlHT4hcqpKGI6y','You have received a new leave application(#6) to check','Hey Wezzie, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-06-27 08:55:21');
INSERT INTO `notifications` VALUES('9','q0Z6H389aRlHT4hcqpKGI6y','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new leave application(#) to verify','Hey Owen Kamtumba, Please go to &apos;Verify Leave&apos; section to verify the newly posted leave application','0','2023-06-27 08:56:14');
INSERT INTO `notifications` VALUES('10','q0Z6H389aRlHT4hcqpKGI6y','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new leave application(#6) to verify','Hey Owen Kamtumba, Please go to &apos;Verify Leave&apos; section to verify the newly posted leave application','0','2023-06-27 08:58:19');
INSERT INTO `notifications` VALUES('11','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','You have received a new leave application(#6) to approve','Hey James, Please go to &apos;Approve Leave&apos; section to approve the newly posted leave application','0','2023-06-27 08:59:14');
INSERT INTO `notifications` VALUES('12','1','1','Your leave application(#6) has been approved','Hey James, your leave application has been approved, the note(s) given are &apos;Go well, don&apos;t forget to be there&apos;.','0','2023-06-27 09:00:19');
INSERT INTO `notifications` VALUES('13','q0Z6H389aRlHT4hcqpKGI6y','q0Z6H389aRlHT4hcqpKGI6y','You have received a new leave application(#7) to check','Hey Wezzie, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-06-27 21:17:04');
INSERT INTO `notifications` VALUES('14','q0Z6H389aRlHT4hcqpKGI6y','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new leave application(#7) to verify','Hey Owen Kamtumba, Please go to &apos;Verify Leave&apos; section to verify the newly posted leave application','0','2023-06-27 21:18:38');
INSERT INTO `notifications` VALUES('15','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','q0Z6H389aRlHT4hcqpKGI6y','You have received a new leave application(#8) to check','Hey Wezzie, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-06-27 21:28:30');
INSERT INTO `notifications` VALUES('16','q0Z6H389aRlHT4hcqpKGI6y','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','Your leave application(#8) has been denied','Hey Owen Kamtumba, your leave application has been denied, the reason(s) given are &apos;Asapite&apos;.','0','2023-06-27 21:30:44');
INSERT INTO `notifications` VALUES('17','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','You have received a new leave application(#7) to approve','Hey James, Please go to &apos;Approve Leave&apos; section to approve the newly posted leave application','0','2023-06-27 21:35:54');
INSERT INTO `notifications` VALUES('18','1','q0Z6H389aRlHT4hcqpKGI6y','Your leave application(#7) has been approved','Hey Wezzie, your leave application has been approved, the note(s) given are &apos;&apos;.','0','2023-06-27 21:41:38');
INSERT INTO `notifications` VALUES('19','1','q0Z6H389aRlHT4hcqpKGI6y','You have received a new leave application(#9) to check','Hey Wezzie, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-06-27 22:35:53');
INSERT INTO `notifications` VALUES('20','q0Z6H389aRlHT4hcqpKGI6y','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new leave application(#9) to verify','Hey Owen Kamtumba, Please go to &apos;Verify Leave&apos; section to verify the newly posted leave application','0','2023-06-27 22:38:21');
INSERT INTO `notifications` VALUES('21','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','You have received a new leave application(#9) to approve','Hey James, Please go to &apos;Approve Leave&apos; section to approve the newly posted leave application','0','2023-06-27 22:47:43');
INSERT INTO `notifications` VALUES('22','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','You have received a new leave application(#10) to check','Hey James, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-07-01 01:18:04');
INSERT INTO `notifications` VALUES('23','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','q0Z6H389aRlHT4hcqpKGI6y','You have received a new leave application(#10) to check','Hey Wezzie, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-07-01 01:18:04');
INSERT INTO `notifications` VALUES('24','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new leave application(#10) to check','Hey Owen Kamtumba, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-07-01 01:18:05');
INSERT INTO `notifications` VALUES('25','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','You have received a new leave application(#10) to verify','Hey James, Please go to &apos;Verify Leave&apos; section to verify the newly posted leave application','0','2023-07-01 01:18:12');
INSERT INTO `notifications` VALUES('26','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new leave application(#10) to verify','Hey Owen Kamtumba, Please go to &apos;Verify Leave&apos; section to verify the newly posted leave application','0','2023-07-01 01:18:12');
INSERT INTO `notifications` VALUES('27','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','s7bGYKKZkOZo31xr9c6bpN8WiRSOJjFu5uQHiPWApdvBwmc4Ihl21','New invoice (#100100) has been posted','Hey Andrew, a new invoice (#100100) with description &apos;Subscription&apos; from Muscco has been posted. Please check.','0','2023-07-02 19:30:52');
INSERT INTO `notifications` VALUES('28','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','tByYPo1Aja8Zdmwn5','New invoice (#100100) has been posted','Hey Steven, a new invoice (#100100) with description &apos;Subscription&apos; from Muscco has been posted. Please check.','0','2023-07-02 19:30:52');
INSERT INTO `notifications` VALUES('29','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','s7bGYKKZkOZo31xr9c6bpN8WiRSOJjFu5uQHiPWApdvBwmc4Ihl21','New invoice (#10010) has been posted','Hey Andrew, a new invoice (#10010) with description &apos;Loan Repayment&apos; from Muscco has been posted. Please check.','0','2023-07-02 19:37:59');
INSERT INTO `notifications` VALUES('30','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','tByYPo1Aja8Zdmwn5','New invoice (#10010) has been posted','Hey Steven, a new invoice (#10010) with description &apos;Loan Repayment&apos; from Muscco has been posted. Please check.','0','2023-07-02 19:37:59');
INSERT INTO `notifications` VALUES('31','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','s7bGYKKZkOZo31xr9c6bpN8WiRSOJjFu5uQHiPWApdvBwmc4Ihl21','New invoice (#0010) has been posted','Hey Andrew, a new invoice (#0010) with description &apos;Training fees 2024&apos; from Muscco has been posted. Please check.','0','2023-07-02 19:39:20');
INSERT INTO `notifications` VALUES('32','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','tByYPo1Aja8Zdmwn5','New invoice (#0010) has been posted','Hey Steven, a new invoice (#0010) with description &apos;Training fees 2024&apos; from Muscco has been posted. Please check.','0','2023-07-02 19:39:20');
INSERT INTO `notifications` VALUES('33','1','s7bGYKKZkOZo31xr9c6bpN8WiRSOJjFu5uQHiPWApdvBwmc4Ihl21','New invoice (#10010) has been posted','Hey Andrew, a new invoice (#10010) with description &apos;Training fees 2024&apos; from Muscco has been posted. Please check.','0','2023-07-02 21:50:50');
INSERT INTO `notifications` VALUES('34','1','tByYPo1Aja8Zdmwn5','New invoice (#10010) has been posted','Hey Steven, a new invoice (#10010) with description &apos;Training fees 2024&apos; from Muscco has been posted. Please check.','0','2023-07-02 21:50:50');
INSERT INTO `notifications` VALUES('35','1','1','You have received a new leave application(#11) to check','Hey James, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-07-02 21:52:38');
INSERT INTO `notifications` VALUES('36','1','q0Z6H389aRlHT4hcqpKGI6y','You have received a new leave application(#11) to check','Hey Wezzie, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-07-02 21:52:38');
INSERT INTO `notifications` VALUES('37','1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new leave application(#11) to check','Hey Owen, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-07-02 21:52:38');
INSERT INTO `notifications` VALUES('38','1','1','You have received a new leave application(#12) to check','Hey James, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-07-02 21:52:38');
INSERT INTO `notifications` VALUES('39','1','q0Z6H389aRlHT4hcqpKGI6y','You have received a new leave application(#12) to check','Hey Wezzie, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-07-02 21:52:38');
INSERT INTO `notifications` VALUES('40','1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new leave application(#12) to check','Hey Owen, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-07-02 21:52:38');
INSERT INTO `notifications` VALUES('41','1','1','You have received a new leave application(#11) to verify','Hey James, Please go to &apos;Verify Leave&apos; section to verify the newly posted leave application','0','2023-07-02 21:52:51');
INSERT INTO `notifications` VALUES('42','1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new leave application(#11) to verify','Hey Owen, Please go to &apos;Verify Leave&apos; section to verify the newly posted leave application','0','2023-07-02 21:52:51');
INSERT INTO `notifications` VALUES('43','1','1','You have received a new leave application(#10) to approve','Hey James, Please go to &apos;Approve Leave&apos; section to approve the newly posted leave application','0','2023-07-02 21:54:33');
INSERT INTO `notifications` VALUES('44','1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new leave application(#10) to approve','Hey Owen, Please go to &apos;Approve Leave&apos; section to approve the newly posted leave application','0','2023-07-02 21:54:33');
INSERT INTO `notifications` VALUES('45','1','1','Your leave application(#9) has been approved','Hey James, your leave application has been approved, the note(s) given are &apos;All is alright&apos;.','0','2023-07-02 21:54:51');
INSERT INTO `notifications` VALUES('46','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','You have received a new leave application(#12) to verify','Hey James, Please go to &apos;Verify Leave&apos; section to verify the newly posted leave application','0','2023-07-02 22:12:18');
INSERT INTO `notifications` VALUES('47','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new leave application(#12) to verify','Hey Owen, Please go to &apos;Verify Leave&apos; section to verify the newly posted leave application','0','2023-07-02 22:12:18');
INSERT INTO `notifications` VALUES('48','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','Your leave application(#10) has been approved','Hey Owen, your leave application has been approved, the note(s) given are &apos;&apos;.','0','2023-07-02 22:12:35');
INSERT INTO `notifications` VALUES('49','1','1','You have received a new petty cash requisition(#0001)','Hey James, you have received a new petty cash requisition(#0001) that needs your attention','0','2023-07-05 05:51:06');
INSERT INTO `notifications` VALUES('50','1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new petty cash requisition(#0001)','Hey Owen, you have received a new petty cash requisition(#0001) that needs your attention','0','2023-07-05 05:51:06');
INSERT INTO `notifications` VALUES('51','1','1','You have received a new petty cash requisition(#0002)','Hey James, you have received a new petty cash requisition(#0002) that needs your attention','0','2023-07-05 05:52:49');
INSERT INTO `notifications` VALUES('52','1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new petty cash requisition(#0002)','Hey Owen, you have received a new petty cash requisition(#0002) that needs your attention','0','2023-07-05 05:52:49');
INSERT INTO `notifications` VALUES('53','1','1','You have received a new petty cash requisition(#0003)','Hey James, you have received a new petty cash requisition(#0003) that needs your attention','0','2023-07-05 05:53:59');
INSERT INTO `notifications` VALUES('54','1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new petty cash requisition(#0003)','Hey Owen, you have received a new petty cash requisition(#0003) that needs your attention','0','2023-07-05 05:53:59');
INSERT INTO `notifications` VALUES('55','1','1','You have received a new petty cash requisition(#0004)','Hey James, you have received a new petty cash requisition(#0004) that needs your attention','0','2023-07-05 05:55:32');
INSERT INTO `notifications` VALUES('56','1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new petty cash requisition(#0004)','Hey Owen, you have received a new petty cash requisition(#0004) that needs your attention','0','2023-07-05 05:55:32');
INSERT INTO `notifications` VALUES('57','1','1','You have received a new petty cash requisition(#0005)','Hey James, you have received a new petty cash requisition(#0005) that needs your attention','0','2023-07-06 21:45:18');
INSERT INTO `notifications` VALUES('58','1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new petty cash requisition(#0005)','Hey Owen, you have received a new petty cash requisition(#0005) that needs your attention','0','2023-07-06 21:45:19');
INSERT INTO `notifications` VALUES('59','1','1','You have received a new petty cash requisition(#0006)','Hey James, you have received a new petty cash requisition(#0006) that needs your attention','0','2023-07-07 17:13:29');
INSERT INTO `notifications` VALUES('60','1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new petty cash requisition(#0006)','Hey Owen, you have received a new petty cash requisition(#0006) that needs your attention','0','2023-07-07 17:13:29');
INSERT INTO `notifications` VALUES('61','1','1','Your petty cash requisition(#0003) has been Approved','Hey, your petty cash requisition(#0003) that you posted has been Approved, go to details to check the update','0','2023-07-08 07:36:32');
INSERT INTO `notifications` VALUES('62','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','You have received a new petty cash requisition(#0007)','Hey James, you have received a new petty cash requisition(#0007) that needs your attention','0','2023-07-08 13:33:50');
INSERT INTO `notifications` VALUES('63','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new petty cash requisition(#0007)','Hey Owen, you have received a new petty cash requisition(#0007) that needs your attention','0','2023-07-08 13:33:50');
INSERT INTO `notifications` VALUES('64','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','You have received a new petty cash requisition(#0008)','Hey James, you have received a new petty cash requisition(#0008) that needs your attention','0','2023-07-08 13:35:23');
INSERT INTO `notifications` VALUES('65','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new petty cash requisition(#0008)','Hey Owen, you have received a new petty cash requisition(#0008) that needs your attention','0','2023-07-08 13:35:23');
INSERT INTO `notifications` VALUES('66','1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','Your petty cash requisition(#0008) has been Approved','Hey, your petty cash requisition(#0008) that you posted has been Approved, go to details to check the update','0','2023-07-08 13:37:03');
INSERT INTO `notifications` VALUES('67','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','Your advance request(#0004) has been Approved','Hey, your advance request(#0004) that you posted has been Approved, go to details to check the update','0','2023-07-09 19:40:44');
INSERT INTO `notifications` VALUES('68','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','Your advance request(#0003) has been Declined','Hey, your advance request(#0003) that you posted has been Declined, go to details to check the update','0','2023-07-09 19:48:53');
INSERT INTO `notifications` VALUES('69','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','Your advance request(#0002) has been Approved','Hey, your advance request(#0002) that you posted has been Approved, go to details to check the update','0','2023-07-09 20:35:37');
INSERT INTO `notifications` VALUES('70','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new advance request(#0001) to check','Hey Owen, you have received a new staff advance request(#0001) that needs your attention to check staff advance','0','2023-07-09 21:00:05');
INSERT INTO `notifications` VALUES('71','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new advance request(#0005)','Hey Owen, you have received a new staff advance request(#0005) that needs your attention to verify staff&apos;s previous advances','0','2023-07-09 21:01:18');
INSERT INTO `notifications` VALUES('72','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','Your advance request(#0004) has been Declined','Hey, your advance request(#0004) that you posted has been Declined, go to details to check the update','0','2023-07-09 21:10:42');
INSERT INTO `notifications` VALUES('73','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','Your advance request(#0002) has been Declined','Hey, your advance request(#0002) that you posted has been Declined, go to details to check the update','0','2023-07-09 21:18:32');
INSERT INTO `notifications` VALUES('74','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','Your staff advance request(#0004) has been Approved','Hey, your petty cash requisition(#0004) that you posted has been Approved, go to details to check the update','0','2023-07-09 22:01:39');
INSERT INTO `notifications` VALUES('75','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','Your staff advance request(#0002) has been Approved','Hey, your petty cash requisition(#0002) that you posted has been Approved, go to details to check the update','0','2023-07-12 19:20:03');
INSERT INTO `notifications` VALUES('76','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new advance request(#0001) to approve','Hey Owen, you have received a new staff advance request(#0001) that needs your approval','0','2023-07-13 02:11:35');
INSERT INTO `notifications` VALUES('77','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','Your staff advance request(#0001) has been Approved','Hey, your petty cash requisition(#0001) that you posted has been Approved, go to details to check the update','0','2023-07-13 02:12:06');
INSERT INTO `notifications` VALUES('78','1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new advance request(#0006)','Hey Owen, you have received a new staff advance request(#0006) that needs your attention to verify staff&apos;s previous advances','0','2023-07-13 03:27:20');
INSERT INTO `notifications` VALUES('79','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new advance request(#0006) to check','Hey Owen, you have received a new staff advance request(#0006) that needs your attention','0','2023-07-13 03:29:46');
INSERT INTO `notifications` VALUES('80','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new advance request(#0006) to approve','Hey Owen, you have received a new staff advance request(#0006) that needs your approval','0','2023-07-13 03:32:09');
INSERT INTO `notifications` VALUES('81','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','Your staff advance request(#0006) has been Approved','Hey, your petty cash requisition(#0006) that you posted has been Approved, go to details to check the update','0','2023-07-13 03:33:19');
INSERT INTO `notifications` VALUES('82','1','s7bGYKKZkOZo31xr9c6bpN8WiRSOJjFu5uQHiPWApdvBwmc4Ihl21','New invoice (#10010) has been posted','Hey Andrew, a new invoice (#10010) with description &apos;Training fees&apos; from Muscco has been posted. Please check.','0','2023-07-13 19:00:26');
INSERT INTO `notifications` VALUES('83','1','tByYPo1Aja8Zdmwn5','New invoice (#10010) has been posted','Hey Steven, a new invoice (#10010) with description &apos;Training fees&apos; from Muscco has been posted. Please check.','0','2023-07-13 19:00:26');
INSERT INTO `notifications` VALUES('84','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','s7bGYKKZkOZo31xr9c6bpN8WiRSOJjFu5uQHiPWApdvBwmc4Ihl21','New invoice (#1222) has been posted','Hey Andrew, a new invoice (#1222) with description &apos;Training fees 2022&apos; from Muscco has been posted. Please check.','0','2023-07-13 19:12:58');
INSERT INTO `notifications` VALUES('85','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','tByYPo1Aja8Zdmwn5','New invoice (#1222) has been posted','Hey Steven, a new invoice (#1222) with description &apos;Training fees 2022&apos; from Muscco has been posted. Please check.','0','2023-07-13 19:12:58');
INSERT INTO `notifications` VALUES('86','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','tByYPo1Aja8Zdmwn5','Your loan application(#1) has been Approved','Greetings, your loan application(#1) that you submitted to MUSCCO has been Approved, for more details check the status of the loan application.','0','2023-07-18 20:59:47');
INSERT INTO `notifications` VALUES('87','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','tByYPo1Aja8Zdmwn5','Your loan application(#2) has been Approved','Greetings, your loan application(#2) that you submitted to MUSCCO has been Approved, for more details check the status of the loan application.','0','2023-07-18 23:09:25');
INSERT INTO `notifications` VALUES('88','tByYPo1Aja8Zdmwn5','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','New loan application (#3) has been posted','Hey Owen, a new loan application (#3) with description &apos;asasas&apos; from OB Sacco has been posted. Please check.','0','2023-07-18 23:48:47');
INSERT INTO `notifications` VALUES('89','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','tByYPo1Aja8Zdmwn5','Your loan application(#3) has been Approved','Greetings, your loan application(#3) that you submitted to MUSCCO has been Approved, for more details check the status of the loan application.','0','2023-07-18 23:50:06');
INSERT INTO `notifications` VALUES('90','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','You have received a new petty cash requisition(#0009)','Hey James, you have received a new petty cash requisition(#0009) that needs your attention','0','2023-07-26 15:39:29');
INSERT INTO `notifications` VALUES('91','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new petty cash requisition(#0009)','Hey Owen, you have received a new petty cash requisition(#0009) that needs your attention','0','2023-07-26 15:39:29');
INSERT INTO `notifications` VALUES('92','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','Your petty cash requisition(#0009) has been Approved','Hey, your petty cash requisition(#0009) that you posted has been Approved, go to details to check the update','0','2023-07-26 15:40:32');
INSERT INTO `notifications` VALUES('93','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new advance request(#0007)','Hey Owen, you have received a new staff advance request(#0007) that needs your attention to verify staff&apos;s previous advances','0','2023-07-26 15:48:40');
INSERT INTO `notifications` VALUES('94','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new advance request(#0007) to check','Hey Owen, you have received a new staff advance request(#0007) that needs your attention','0','2023-07-26 15:50:58');
INSERT INTO `notifications` VALUES('95','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new advance request(#0007) to approve','Hey Owen, you have received a new staff advance request(#0007) that needs your approval','0','2023-07-26 15:51:54');
INSERT INTO `notifications` VALUES('96','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','Your staff advance request(#0007) has been Approved','Hey, your petty cash requisition(#0007) that you posted has been Approved, go to details to check the update','0','2023-07-26 15:52:16');
INSERT INTO `notifications` VALUES('97','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new advance request(#0005) to check','Hey Owen, you have received a new staff advance request(#0005) that needs your attention','0','2023-07-26 15:56:54');
INSERT INTO `notifications` VALUES('98','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new advance request(#0005) to approve','Hey Owen, you have received a new staff advance request(#0005) that needs your approval','0','2023-07-26 15:57:09');
INSERT INTO `notifications` VALUES('99','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','Your staff advance request(#0005) has been Approved','Hey, your petty cash requisition(#0005) that you posted has been Approved, go to details to check the update','0','2023-07-26 15:57:19');
INSERT INTO `notifications` VALUES('100','tByYPo1Aja8Zdmwn5','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','New loan application (#4) has been posted','Hey Owen, a new loan application (#4) with description &apos;fgddh&apos; from OB Sacco has been posted. Please check.','0','2023-07-26 16:18:19');
INSERT INTO `notifications` VALUES('101','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','tByYPo1Aja8Zdmwn5','Your loan application(#4) has been Approved','Greetings, your loan application(#4) that you submitted to MUSCCO has been Approved, for more details check the status of the loan application.','0','2023-07-26 16:22:07');
INSERT INTO `notifications` VALUES('102','tByYPo1Aja8Zdmwn5','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','New loan application (#5) has been posted','Hey Owen, a new loan application (#5) with description &apos;Training fees&apos; from OB Sacco has been posted. Please check.','0','2023-07-29 07:34:40');
INSERT INTO `notifications` VALUES('103','tByYPo1Aja8Zdmwn5','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','New loan application (#6) has been posted','Hey Owen, a new loan application (#6) with description &apos;Loan Repayment&apos; from OB Sacco has been posted. Please check.','0','2023-07-29 08:07:41');
INSERT INTO `notifications` VALUES('104','tByYPo1Aja8Zdmwn5','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','New loan application (#7) has been posted','Hey Owen, a new loan application (#7) with description &apos;Training fees&apos; from OB Sacco has been posted. Please check.','0','2023-07-29 08:08:13');
INSERT INTO `notifications` VALUES('105','tByYPo1Aja8Zdmwn5','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','New loan application (#8) has been posted','Hey Owen, a new loan application (#8) with description &apos;ddsd&apos; from OB Sacco has been posted. Please check.','0','2023-07-29 08:09:08');
INSERT INTO `notifications` VALUES('106','tByYPo1Aja8Zdmwn5','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','New loan application (#9) has been posted','Hey Owen, a new loan application (#9) with description &apos;hello&apos; from OB Sacco has been posted. Please check.','0','2023-07-29 08:56:02');
INSERT INTO `notifications` VALUES('107','tByYPo1Aja8Zdmwn5','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','New loan application (#10) has been posted','Hey Owen, a new loan application (#10) with description &apos;fgddh&apos; from OB Sacco has been posted. Please check.','0','2023-07-29 08:58:19');
INSERT INTO `notifications` VALUES('108','tByYPo1Aja8Zdmwn5','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','New loan application (#11) has been posted','Hey Owen, a new loan application (#11) with description &apos;jfjfjdh&apos; from OB Sacco has been posted. Please check.','0','2023-07-29 08:58:40');
INSERT INTO `notifications` VALUES('109','tByYPo1Aja8Zdmwn5','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','New loan application (#12) has been posted','Hey Owen, a new loan application (#12) with description &apos;dsd&apos; from OB Sacco has been posted. Please check.','0','2023-07-29 08:59:27');
INSERT INTO `notifications` VALUES('110','1','1','You have received a new travel advance request to approve','Hey James, you have received a new travel advance request that needs your approval','0','2023-08-18 15:10:22');
INSERT INTO `notifications` VALUES('111','1','1','You have received a new travel advance request to approve','Hey James, you have received a new travel advance request that needs your approval','0','2023-08-18 15:11:50');
INSERT INTO `notifications` VALUES('112','1','MUSCCO/01/104','Your travel advance request has been Approved','Hey, your travel advance request that you posted has been Approved, go to details to check the update','0','2023-08-18 15:37:01');
INSERT INTO `notifications` VALUES('113','1','MUSCCO/01/104','Your travel advance request has been Approved','Hey, your travel advance request that you posted has been Approved, go to details to check the update','0','2023-08-19 17:46:16');
INSERT INTO `notifications` VALUES('114','1','1','You have received a new travel advance request to approve','Hey James, you have received a new travel advance request that needs your approval','0','2023-08-19 17:47:05');
INSERT INTO `notifications` VALUES('115','1','MUSCCO/01/104','Your travel advance request has been Approved','Hey, your travel advance request that you posted has been Approved, go to details to check the update','0','2023-08-19 17:47:20');
INSERT INTO `notifications` VALUES('116','1','1','You have received a new travel advance request to approve','Hey James, you have received a new travel advance request that needs your approval','0','2023-08-19 17:50:09');
INSERT INTO `notifications` VALUES('117','1','MUSCCO/01/104','Your travel advance request has been Approved','Hey, your travel advance request that you posted has been Approved, go to details to check the update','0','2023-08-19 17:50:17');
INSERT INTO `notifications` VALUES('118','1','1','You have received a new travel advance request to approve','Hey James, you have received a new travel advance request that needs your approval','0','2023-08-20 09:28:47');
INSERT INTO `notifications` VALUES('119','1','MUSCCO/01/104','Your travel advance request has been Approved','Hey, your travel advance request that you posted has been Approved, go to details to check the update','0','2023-08-20 09:29:03');
INSERT INTO `notifications` VALUES('120','1','1','You have received a new travel advance request to approve','Hey James, you have received a new travel advance request that needs your approval','0','2023-08-20 10:14:01');
INSERT INTO `notifications` VALUES('121','1','MUSCCO/01/104','Your travel advance request has been Approved','Hey, your travel advance request that you posted has been Approved, go to details to check the update','0','2023-08-20 10:14:18');
INSERT INTO `notifications` VALUES('122','1','1','You have received a new travel advance request to approve','Hey James, you have received a new travel advance request that needs your approval','0','2023-08-20 10:19:12');
INSERT INTO `notifications` VALUES('123','1','MUSCCO/01/104','Your travel advance request has been Approved','Hey, your travel advance request that you posted has been Approved, go to details to check the update','0','2023-08-20 10:19:49');
INSERT INTO `notifications` VALUES('124','1','1','You have received a new travel advance request to approve','Hey James, you have received a new travel advance request that needs your approval','0','2023-07-20 11:40:51');
INSERT INTO `notifications` VALUES('125','1','1','You have received a new travel advance request to approve','Hey James, you have received a new travel advance request that needs your approval','0','2023-07-20 11:41:04');
INSERT INTO `notifications` VALUES('126','1','1','You have received a new travel advance request to approve','Hey James, you have received a new travel advance request that needs your approval','0','2023-07-20 11:41:16');
INSERT INTO `notifications` VALUES('127','1','MUSCCO/01/104','Your travel advance request has been Approved','Hey, your travel advance request that you posted has been Approved, go to details to check the update','0','2023-07-20 11:41:25');
INSERT INTO `notifications` VALUES('128','1','MUSCCO/01/104','Your travel advance request has been Approved','Hey, your travel advance request that you posted has been Approved, go to details to check the update','0','2023-07-20 11:41:39');
INSERT INTO `notifications` VALUES('129','1','MUSCCO/01/104','Your travel advance request has been Approved','Hey, your travel advance request that you posted has been Approved, go to details to check the update','0','2023-07-20 11:41:53');
INSERT INTO `notifications` VALUES('130','1','1','You have received a new travel advance request to approve','Hey James, you have received a new travel advance request that needs your approval','0','2023-08-20 12:56:44');
INSERT INTO `notifications` VALUES('131','1','MUSCCO/01/104','Your travel advance request has been Approved','Hey, your travel advance request that you posted has been Approved, go to details to check the update','0','2023-08-20 12:56:56');
INSERT INTO `notifications` VALUES('132','1','1','You have received a new travel advance request to approve','Hey James, you have received a new travel advance request that needs your approval','0','2023-08-20 18:23:04');
INSERT INTO `notifications` VALUES('133','1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new travel advance request to approve','Hey Owen, you have received a new travel advance request that needs your approval','0','2023-08-20 18:23:04');
INSERT INTO `notifications` VALUES('134','1','MUSCCO/01/104','Your travel advance request has been Declined','Hey, your travel advance request that you posted has been Declined, go to details to check the update','0','2023-08-20 18:23:18');
INSERT INTO `notifications` VALUES('135','1','0020','Your travel advance request has been Approved','Hey, your travel advance request that you posted has been Approved, go to details to check the update','0','2023-08-20 18:24:44');
INSERT INTO `notifications` VALUES('136','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','MUSCCO/01/104','Your travel advance request has been Declined','Hey, your travel advance request that you posted has been Declined, go to details to check the update','0','2023-08-20 21:45:50');
INSERT INTO `notifications` VALUES('137','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','You have received a new travel advance request to approve','Hey James, you have received a new travel advance request that needs your approval','0','2023-08-20 21:46:03');
INSERT INTO `notifications` VALUES('138','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new travel advance request to approve','Hey Owen, you have received a new travel advance request that needs your approval','0','2023-08-20 21:46:03');
INSERT INTO `notifications` VALUES('139','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','You have received a new travel advance request to approve','Hey James, you have received a new travel advance request that needs your approval','0','2023-08-20 21:46:18');
INSERT INTO `notifications` VALUES('140','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new travel advance request to approve','Hey Owen, you have received a new travel advance request that needs your approval','0','2023-08-20 21:46:19');
INSERT INTO `notifications` VALUES('141','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','You have received a new travel advance request to approve','Hey James, you have received a new travel advance request that needs your approval','0','2023-08-20 21:48:17');
INSERT INTO `notifications` VALUES('142','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new travel advance request to approve','Hey Owen, you have received a new travel advance request that needs your approval','0','2023-08-20 21:48:17');
INSERT INTO `notifications` VALUES('143','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','You have received a new travel advance request to approve','Hey James, you have received a new travel advance request that needs your approval','0','2023-08-20 22:48:52');
INSERT INTO `notifications` VALUES('144','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new travel advance request to approve','Hey Owen, you have received a new travel advance request that needs your approval','0','2023-08-20 22:48:52');
INSERT INTO `notifications` VALUES('145','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','0020','Your travel advance request has been Approved','Hey, your travel advance request that you posted has been Approved, go to details to check the update','0','2023-08-20 22:49:46');
INSERT INTO `notifications` VALUES('146','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','Your petty cash requisition(#0007) has been Approved','Hey, your petty cash requisition(#0007) that you posted has been Approved, go to details to check the update','0','2023-08-21 07:34:39');
INSERT INTO `notifications` VALUES('147','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','Your petty cash requisition(#0002) has been Approved','Hey, your petty cash requisition(#0002) that you posted has been Approved, go to details to check the update','0','2023-08-21 10:44:05');
INSERT INTO `notifications` VALUES('148','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','Your petty cash requisition(#0001) has been Approved','Hey, your petty cash requisition(#0001) that you posted has been Approved, go to details to check the update','0','2023-08-21 10:48:46');
INSERT INTO `notifications` VALUES('149','1','1','You have received a new travel advance request to approve','Hey James, you have received a new travel advance request that needs your approval','0','2023-08-23 16:47:28');
INSERT INTO `notifications` VALUES('150','1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new travel advance request to approve','Hey Owen, you have received a new travel advance request that needs your approval','0','2023-08-23 16:47:28');
INSERT INTO `notifications` VALUES('151','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','MUSCCO/01/104','Your travel advance request has been Approved','Hey, your travel advance request that you posted has been Approved, go to details to check the update','0','2023-08-23 20:15:54');
INSERT INTO `notifications` VALUES('152','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','You have received a new travel advance request to approve','Hey James, you have received a new travel advance request that needs your approval','0','2023-08-23 20:16:49');
INSERT INTO `notifications` VALUES('153','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new travel advance request to approve','Hey Owen, you have received a new travel advance request that needs your approval','0','2023-08-23 20:16:49');
INSERT INTO `notifications` VALUES('154','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','0020','Your travel advance request has been Approved','Hey, your travel advance request that you posted has been Approved, go to details to check the update','0','2023-08-23 20:20:34');
INSERT INTO `notifications` VALUES('155','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','MUSCCO/01/104','Your travel advance request has been Approved','Hey, your travel advance request that you posted has been Approved, go to details to check the update','0','2023-08-23 20:21:09');
INSERT INTO `notifications` VALUES('156','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','You have received a new petty cash requisition(#0010)','Hey James, you have received a new petty cash requisition(#0010) that needs your attention','0','2023-08-23 20:47:52');
INSERT INTO `notifications` VALUES('157','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new petty cash requisition(#0010)','Hey Owen, you have received a new petty cash requisition(#0010) that needs your attention','0','2023-08-23 20:47:52');
INSERT INTO `notifications` VALUES('158','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','You have received a new petty cash requisition(#0011)','Hey James, you have received a new petty cash requisition(#0011) that needs your attention','0','2023-08-23 23:38:34');
INSERT INTO `notifications` VALUES('159','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new petty cash requisition(#0011)','Hey Owen, you have received a new petty cash requisition(#0011) that needs your attention','0','2023-08-23 23:38:34');
INSERT INTO `notifications` VALUES('160','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','Your petty cash requisition(#0011) has been Approved','Hey, your petty cash requisition(#0011) that you posted has been Approved, go to details to check the update','0','2023-08-23 23:38:55');
INSERT INTO `notifications` VALUES('161','1','1','You have received a new petty cash requisition(#0012)','Hey James, you have received a new petty cash requisition(#0012) that needs your attention','0','2023-08-24 00:03:13');
INSERT INTO `notifications` VALUES('162','1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new petty cash requisition(#0012)','Hey Owen, you have received a new petty cash requisition(#0012) that needs your attention','0','2023-08-24 00:03:13');
INSERT INTO `notifications` VALUES('163','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new advance request(#0008)','Hey Owen, you have received a new staff advance request(#0008) that needs your attention to verify staff&apos;s previous advances','0','2023-08-24 08:20:52');
INSERT INTO `notifications` VALUES('164','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new advance request(#0009)','Hey Owen, you have received a new staff advance request(#0009) that needs your attention to verify staff&apos;s previous advances','0','2023-08-24 10:12:11');
INSERT INTO `notifications` VALUES('165','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new advance request(#0009) to check','Hey Owen, you have received a new staff advance request(#0009) that needs your attention','0','2023-08-24 10:17:48');
INSERT INTO `notifications` VALUES('166','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new advance request(#0010)','Hey Owen, you have received a new staff advance request(#0010) that needs your attention to verify staff&apos;s previous advances','0','2023-08-24 10:34:36');
INSERT INTO `notifications` VALUES('167','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new advance request(#0011)','Hey Owen, you have received a new staff advance request(#0011) that needs your attention to verify staff&apos;s previous advances','0','2023-08-24 10:34:36');
INSERT INTO `notifications` VALUES('168','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new advance request(#0009) to approve','Hey Owen, you have received a new staff advance request(#0009) that needs your approval','0','2023-08-24 10:41:12');
INSERT INTO `notifications` VALUES('169','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','Your staff advance request(#0009) has been Approved','Hey, your petty cash requisition(#0009) that you posted has been Approved, go to details to check the update','0','2023-08-24 10:43:56');
INSERT INTO `notifications` VALUES('170','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new advance request(#0010) to check','Hey Owen, you have received a new staff advance request(#0010) that needs your attention','0','2023-08-24 13:27:23');
INSERT INTO `notifications` VALUES('171','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new advance request(#0010) to approve','Hey Owen, you have received a new staff advance request(#0010) that needs your approval','0','2023-08-24 13:27:40');
INSERT INTO `notifications` VALUES('172','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','Your staff advance request(#0010) has been Approved','Hey, your petty cash requisition(#0010) that you posted has been Approved, go to details to check the update','0','2023-08-24 13:28:18');
INSERT INTO `notifications` VALUES('173','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new advance request(#0012)','Hey Owen, you have received a new staff advance request(#0012) that needs your attention to verify staff&apos;s previous advances','0','2023-08-24 16:31:53');
INSERT INTO `notifications` VALUES('174','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new advance request(#0012) to check','Hey Owen, you have received a new staff advance request(#0012) that needs your attention','0','2023-08-24 16:32:09');
INSERT INTO `notifications` VALUES('175','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new advance request(#0012) to approve','Hey Owen, you have received a new staff advance request(#0012) that needs your approval','0','2023-08-24 16:32:24');
INSERT INTO `notifications` VALUES('176','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','Your staff advance request(#0012) has been Approved','Hey, your petty cash requisition(#0012) that you posted has been Approved, go to details to check the update','0','2023-08-24 16:32:34');
INSERT INTO `notifications` VALUES('177','1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new advance request(#0013)','Hey Owen, you have received a new staff advance request(#0013) that needs your attention to verify staff&apos;s previous advances','0','2023-08-24 23:13:42');
INSERT INTO `notifications` VALUES('178','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','You have received a new leave application(#13) to check','Hey James, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-08-25 01:42:29');
INSERT INTO `notifications` VALUES('179','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','q0Z6H389aRlHT4hcqpKGI6y','You have received a new leave application(#13) to check','Hey Wezzie, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-08-25 01:42:29');
INSERT INTO `notifications` VALUES('180','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new leave application(#13) to check','Hey Owen, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-08-25 01:42:29');
INSERT INTO `notifications` VALUES('181','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','You have received a new leave application(#14) to check','Hey James, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-08-25 02:11:35');
INSERT INTO `notifications` VALUES('182','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','q0Z6H389aRlHT4hcqpKGI6y','You have received a new leave application(#14) to check','Hey Wezzie, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-08-25 02:11:35');
INSERT INTO `notifications` VALUES('183','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new leave application(#14) to check','Hey Owen, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-08-25 02:11:35');
INSERT INTO `notifications` VALUES('184','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','You have received a new leave application(#15) to check','Hey James, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-08-25 02:14:29');
INSERT INTO `notifications` VALUES('185','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','q0Z6H389aRlHT4hcqpKGI6y','You have received a new leave application(#15) to check','Hey Wezzie, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-08-25 02:14:29');
INSERT INTO `notifications` VALUES('186','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new leave application(#15) to check','Hey Owen, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-08-25 02:14:29');
INSERT INTO `notifications` VALUES('187','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','You have received a new leave application(#16) to check','Hey James, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-08-25 02:37:36');
INSERT INTO `notifications` VALUES('188','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','q0Z6H389aRlHT4hcqpKGI6y','You have received a new leave application(#16) to check','Hey Wezzie, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-08-25 02:37:36');
INSERT INTO `notifications` VALUES('189','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new leave application(#16) to check','Hey Owen, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-08-25 02:37:36');
INSERT INTO `notifications` VALUES('190','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','You have received a new leave application(#16) to verify','Hey James, Please go to &apos;Verify Leave&apos; section to verify the newly posted leave application','0','2023-08-25 11:16:32');
INSERT INTO `notifications` VALUES('191','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new leave application(#16) to verify','Hey Owen, Please go to &apos;Verify Leave&apos; section to verify the newly posted leave application','0','2023-08-25 11:16:32');
INSERT INTO `notifications` VALUES('192','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','You have received a new leave application(#17) to check','Hey James, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-08-25 11:29:14');
INSERT INTO `notifications` VALUES('193','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','q0Z6H389aRlHT4hcqpKGI6y','You have received a new leave application(#17) to check','Hey Wezzie, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-08-25 11:29:14');
INSERT INTO `notifications` VALUES('194','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new leave application(#17) to check','Hey Owen, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-08-25 11:29:14');
INSERT INTO `notifications` VALUES('195','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','Your leave application(#17) has been denied','Hey Owen, your leave application has been denied, the reason(s) given are &apos;No need to go on holiday again Owen&apos;.','0','2023-08-25 12:07:31');
INSERT INTO `notifications` VALUES('196','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','You have received a new leave application(#18) to check','Hey James, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-08-25 12:08:45');
INSERT INTO `notifications` VALUES('197','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','q0Z6H389aRlHT4hcqpKGI6y','You have received a new leave application(#18) to check','Hey Wezzie, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-08-25 12:08:45');
INSERT INTO `notifications` VALUES('198','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new leave application(#18) to check','Hey Owen, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-08-25 12:08:45');
INSERT INTO `notifications` VALUES('199','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','You have received a new leave application(#18) to verify','Hey James, Please go to &apos;Verify Leave&apos; section to verify the newly posted leave application','0','2023-08-25 12:09:14');
INSERT INTO `notifications` VALUES('200','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new leave application(#18) to verify','Hey Owen, Please go to &apos;Verify Leave&apos; section to verify the newly posted leave application','0','2023-08-25 12:09:14');
INSERT INTO `notifications` VALUES('201','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','You have received a new leave application(#19) to check','Hey James, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-08-25 12:16:48');
INSERT INTO `notifications` VALUES('202','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','q0Z6H389aRlHT4hcqpKGI6y','You have received a new leave application(#19) to check','Hey Wezzie, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-08-25 12:16:48');
INSERT INTO `notifications` VALUES('203','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new leave application(#19) to check','Hey Owen, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-08-25 12:16:48');
INSERT INTO `notifications` VALUES('204','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','You have received a new leave application(#18) to approve','Hey James, Please go to &apos;Approve Leave&apos; section to approve the newly posted leave application','0','2023-08-25 12:53:56');
INSERT INTO `notifications` VALUES('205','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new leave application(#18) to approve','Hey Owen, Please go to &apos;Approve Leave&apos; section to approve the newly posted leave application','0','2023-08-25 12:53:57');
INSERT INTO `notifications` VALUES('206','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','Your leave application(#12) has been denied','Hey James, your leave application has been denied, the reason(s) given are &apos;No need to go on holiday again Owen&apos;.','0','2023-08-25 12:59:53');
INSERT INTO `notifications` VALUES('207','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','You have received a new leave application(#11) to approve','Hey James, Please go to &apos;Approve Leave&apos; section to approve the newly posted leave application','0','2023-08-25 14:41:10');
INSERT INTO `notifications` VALUES('208','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new leave application(#11) to approve','Hey Owen, Please go to &apos;Approve Leave&apos; section to approve the newly posted leave application','0','2023-08-25 14:41:10');
INSERT INTO `notifications` VALUES('209','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','Your leave application(#18) has been approved','Hey Owen, your leave application has been approved, the note(s) given are &apos;Go on holiday again Owen and enjoy&apos;.','0','2023-08-25 14:41:35');
INSERT INTO `notifications` VALUES('210','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','Your leave application(#11) has been denied','Hey James, your leave application has been denied, the reason(s) given are &apos;No need to go on holiday again Owen&apos;.','0','2023-08-25 14:42:02');
INSERT INTO `notifications` VALUES('211','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','You have received a new leave application(#16) to approve','Hey James, Please go to &apos;Approve Leave&apos; section to approve the newly posted leave application','0','2023-08-25 21:40:19');
INSERT INTO `notifications` VALUES('212','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new leave application(#16) to approve','Hey Owen, Please go to &apos;Approve Leave&apos; section to approve the newly posted leave application','0','2023-08-25 21:40:19');
INSERT INTO `notifications` VALUES('213','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','Your leave application(#16) has been denied','Hey Owen, your leave application has been denied, the reason(s) given are &apos;No need to go on holiday again Owen&apos;.','0','2023-08-25 21:40:49');
INSERT INTO `notifications` VALUES('214','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','You have received a new leave application(#19) to verify','Hey James, Please go to &apos;Verify Leave&apos; section to verify the newly posted leave application','0','2023-08-25 22:07:56');
INSERT INTO `notifications` VALUES('215','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new leave application(#19) to verify','Hey Owen, Please go to &apos;Verify Leave&apos; section to verify the newly posted leave application','0','2023-08-25 22:07:56');
INSERT INTO `notifications` VALUES('216','1','1','You have received a new leave application(#19) to approve','Hey James, Please go to &apos;Approve Leave&apos; section to approve the newly posted leave application','0','2023-08-25 22:40:18');
INSERT INTO `notifications` VALUES('219','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new advance request(#0014)','Hey Owen, you have received a new staff advance request(#0014) that needs your attention to verify staff&apos;s previous advances','0','2023-08-26 02:33:36');
INSERT INTO `notifications` VALUES('220','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','s7bGYKKZkOZo31xr9c6bpN8WiRSOJjFu5uQHiPWApdvBwmc4Ihl21','New invoice (#2002) has been posted','Hey Andrew, a new invoice (#2002) with description &apos;System installation&apos; from Muscco has been posted. Please check.','0','2023-08-26 10:49:56');
INSERT INTO `notifications` VALUES('221','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','tByYPo1Aja8Zdmwn5','New invoice (#2002) has been posted','Hey Steven, a new invoice (#2002) with description &apos;System installation&apos; from Muscco has been posted. Please check.','0','2023-08-26 10:49:56');
INSERT INTO `notifications` VALUES('222','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','s7bGYKKZkOZo31xr9c6bpN8WiRSOJjFu5uQHiPWApdvBwmc4Ihl21','New invoice (#0001) has been posted','Hey Andrew, a new invoice (#0001) with description &apos;Training fees&apos; from Muscco has been posted. Please check.','0','2023-08-26 11:49:24');
INSERT INTO `notifications` VALUES('223','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','tByYPo1Aja8Zdmwn5','New invoice (#0001) has been posted','Hey Steven, a new invoice (#0001) with description &apos;Training fees&apos; from Muscco has been posted. Please check.','0','2023-08-26 11:49:24');
INSERT INTO `notifications` VALUES('224','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','s7bGYKKZkOZo31xr9c6bpN8WiRSOJjFu5uQHiPWApdvBwmc4Ihl21','New invoice (#0002) has been posted','Hey Andrew, a new invoice (#0002) with description &apos;System installation and training fees&apos; from Muscco has been posted. Please check.','0','2023-08-26 11:55:55');
INSERT INTO `notifications` VALUES('225','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','tByYPo1Aja8Zdmwn5','New invoice (#0002) has been posted','Hey Steven, a new invoice (#0002) with description &apos;System installation and training fees&apos; from Muscco has been posted. Please check.','0','2023-08-26 11:55:55');
INSERT INTO `notifications` VALUES('226','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','s7bGYKKZkOZo31xr9c6bpN8WiRSOJjFu5uQHiPWApdvBwmc4Ihl21','New invoice (#0001) has been posted','Hey Andrew, a new invoice (#0001) with description &apos;Training fees&apos; from Muscco has been posted. Please check.','0','2023-08-26 12:10:05');
INSERT INTO `notifications` VALUES('227','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','tByYPo1Aja8Zdmwn5','New invoice (#0001) has been posted','Hey Steven, a new invoice (#0001) with description &apos;Training fees&apos; from Muscco has been posted. Please check.','0','2023-08-26 12:10:05');
INSERT INTO `notifications` VALUES('228','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','s7bGYKKZkOZo31xr9c6bpN8WiRSOJjFu5uQHiPWApdvBwmc4Ihl21','New invoice (#0002) has been posted','Hey Andrew, a new invoice (#0002) with description &apos;System installation and training fees&apos; from Muscco has been posted. Please check.','0','2023-08-26 12:10:43');
INSERT INTO `notifications` VALUES('229','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','tByYPo1Aja8Zdmwn5','New invoice (#0002) has been posted','Hey Steven, a new invoice (#0002) with description &apos;System installation and training fees&apos; from Muscco has been posted. Please check.','0','2023-08-26 12:10:43');
INSERT INTO `notifications` VALUES('230','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','s7bGYKKZkOZo31xr9c6bpN8WiRSOJjFu5uQHiPWApdvBwmc4Ihl21','New invoice (#0003) has been posted','Hey Andrew, a new invoice (#0003) with description &apos;Training fees&apos; from Muscco has been posted. Please check.','0','2023-08-26 12:19:46');
INSERT INTO `notifications` VALUES('231','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','tByYPo1Aja8Zdmwn5','New invoice (#0003) has been posted','Hey Steven, a new invoice (#0003) with description &apos;Training fees&apos; from Muscco has been posted. Please check.','0','2023-08-26 12:19:46');
INSERT INTO `notifications` VALUES('232','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','s7bGYKKZkOZo31xr9c6bpN8WiRSOJjFu5uQHiPWApdvBwmc4Ihl21','New invoice (#0004) has been posted','Hey Andrew, a new invoice (#0004) with description &apos;System installation and training fees&apos; from Muscco has been posted. Please check.','0','2023-08-26 12:33:25');
INSERT INTO `notifications` VALUES('233','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','tByYPo1Aja8Zdmwn5','New invoice (#0004) has been posted','Hey Steven, a new invoice (#0004) with description &apos;System installation and training fees&apos; from Muscco has been posted. Please check.','0','2023-08-26 12:33:25');
INSERT INTO `notifications` VALUES('234','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','s7bGYKKZkOZo31xr9c6bpN8WiRSOJjFu5uQHiPWApdvBwmc4Ihl21','New invoice (#0005) has been posted','Hey Andrew, a new invoice (#0005) with description &apos;Training fees&apos; from Muscco has been posted. Please check.','0','2023-08-26 13:05:08');
INSERT INTO `notifications` VALUES('235','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','tByYPo1Aja8Zdmwn5','New invoice (#0005) has been posted','Hey Steven, a new invoice (#0005) with description &apos;Training fees&apos; from Muscco has been posted. Please check.','0','2023-08-26 13:05:08');
DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `permission_id` int NOT NULL AUTO_INCREMENT,
  `permission` varchar(128) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
INSERT INTO `permissions` VALUES('1','Super User','This permission allows the user to have access to every functionality of the system and it should be given to the IT Admin of this system.');
INSERT INTO `permissions` VALUES('2','Sacco Administrator','This permission is given to the IT Administrator of a Sacco, to manage Sacco Members and everything that 
Sacco is allowed to access.');
INSERT INTO `permissions` VALUES('3','Manage Invoices','This permission allows the member to post and update the status of the invoice. ');
INSERT INTO `permissions` VALUES('4','Manage Events','This permission allows the member to post and update events.');
INSERT INTO `permissions` VALUES('5','Manage Documents','This permission allows the member to post and update document directory.');
INSERT INTO `permissions` VALUES('6','Check Leave','This permission allows the user to check leave application before it goes to admin for verification, probably is the head of section.');
INSERT INTO `permissions` VALUES('7','Approve Leave','This permission allows the user to approve or decline a leave application, this is the CEO.');
INSERT INTO `permissions` VALUES('8','Manage Leave','This permission allows the user to manage employee's leave days at the start of every FY, confirm if leave grant is required and verify if the leave application details are correct before it goes for approval.');
INSERT INTO `permissions` VALUES('9','Manage Loans','This permission allows the user to manage loan applications from Sacco or the Sacco representative who handles loans.');
INSERT INTO `permissions` VALUES('10','Check Vehicle Request','This permission allows the user to check vehicle request and assigns the required vehicle. Also, they check the condition of the vehicle, fuel levels and tools included in the vehicle.');
INSERT INTO `permissions` VALUES('11','Authorize Vehicle Request','This permission allows the user to authorize the vehicle.');
INSERT INTO `permissions` VALUES('12','Approve Petty Cash','This permission allows the user to approve or decline a petty cash requisitions ');
INSERT INTO `permissions` VALUES('13','Verify Advance','This permission allows the user to approve or decline a advance request, this is someone in the accounts department.');
INSERT INTO `permissions` VALUES('14','Check Advance','This permission allows the user to check an advance request, this is the supervisor.');
INSERT INTO `permissions` VALUES('15','Approve Advance','This permission allows the user to approve or decline an advance request, this is the CE.');
INSERT INTO `permissions` VALUES('16','Manage Employees','This permission allows the HR to manage different parameters of the employees.');
INSERT INTO `permissions` VALUES('17','Check Travel Advance Request','This permission allows the user to check  user travel advance request, this is the supervisor.');
INSERT INTO `permissions` VALUES('18','Approve Travel Advance Request','This permission allows the user to approve user travel advance request, this is the snr management.');
INSERT INTO `permissions` VALUES('19','View Reports','Allows the user to view different reports.');
DROP TABLE IF EXISTS `permissions_granted`;

CREATE TABLE `permissions_granted` (
  `granted_id` int NOT NULL AUTO_INCREMENT,
  `member_id` varchar(60) NOT NULL,
  `permission_id` int NOT NULL,
  `date_assigned` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `assigned_by` varchar(60) NOT NULL,
  PRIMARY KEY (`granted_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;
INSERT INTO `permissions_granted` VALUES('6','q0Z6H389aRlHT4hcqpKGI6y','3','2023-06-18 17:00:45','1');
INSERT INTO `permissions_granted` VALUES('8','q0Z6H389aRlHT4hcqpKGI6y','4','2023-06-18 19:38:09','1');
INSERT INTO `permissions_granted` VALUES('9','q0Z6H389aRlHT4hcqpKGI6y','5','2023-06-18 19:54:19','1');
INSERT INTO `permissions_granted` VALUES('10','wSJ3FdkBZj5aW30VtuwVRMf6BgoxpUmWcHMFly8WM7LUYZHY1bdZzY','3','2023-06-18 19:59:47','1');
INSERT INTO `permissions_granted` VALUES('11','wSJ3FdkBZj5aW30VtuwVRMf6BgoxpUmWcHMFly8WM7LUYZHY1bdZzY','4','2023-06-19 16:01:53','1');
INSERT INTO `permissions_granted` VALUES('15','s7bGYKKZkOZo31xr9c6bpN8WiRSOJjFu5uQHiPWApdvBwmc4Ihl21','3','2023-06-22 09:14:23','7DKHe8o4B6ET2KaySKCwGgbuc0nXJzhkUz9e5ywHmq9VZcCuMEcsopr');
INSERT INTO `permissions_granted` VALUES('16','tByYPo1Aja8Zdmwn5','3','2023-06-22 13:57:33','7DKHe8o4B6ET2KaySKCwGgbuc0nXJzhkUz9e5ywHmq9VZcCuMEcsopr');
INSERT INTO `permissions_granted` VALUES('17','tByYPo1Aja8Zdmwn5','9','2023-06-22 13:57:37','7DKHe8o4B6ET2KaySKCwGgbuc0nXJzhkUz9e5ywHmq9VZcCuMEcsopr');
INSERT INTO `permissions_granted` VALUES('18','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','4','2023-06-24 04:40:23','1');
INSERT INTO `permissions_granted` VALUES('19','1','1','2023-06-26 14:03:35','1');
INSERT INTO `permissions_granted` VALUES('24','1','7','2023-06-26 23:29:34','1');
INSERT INTO `permissions_granted` VALUES('27','q0Z6H389aRlHT4hcqpKGI6y','6','2023-06-27 08:31:47','1');
INSERT INTO `permissions_granted` VALUES('28','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','5','2023-06-27 11:32:13','1');
INSERT INTO `permissions_granted` VALUES('29','1','6','2023-07-01 00:35:20','1');
INSERT INTO `permissions_granted` VALUES('30','1','8','2023-07-01 00:35:27','1');
INSERT INTO `permissions_granted` VALUES('31','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','6','2023-07-01 00:38:12','1');
INSERT INTO `permissions_granted` VALUES('32','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','7','2023-07-01 00:43:21','1');
INSERT INTO `permissions_granted` VALUES('33','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','8','2023-07-01 00:44:40','1');
INSERT INTO `permissions_granted` VALUES('34','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','10','2023-07-01 02:50:11','1');
INSERT INTO `permissions_granted` VALUES('38','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','12','2023-07-05 05:49:40','1');
INSERT INTO `permissions_granted` VALUES('39','1','12','2023-07-05 05:49:53','1');
INSERT INTO `permissions_granted` VALUES('40','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','13','2023-07-09 15:48:03','1');
INSERT INTO `permissions_granted` VALUES('41','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','14','2023-07-09 20:31:18','1');
INSERT INTO `permissions_granted` VALUES('42','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','15','2023-07-09 20:31:29','1');
INSERT INTO `permissions_granted` VALUES('43','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','9','2023-07-18 22:37:07','1');
INSERT INTO `permissions_granted` VALUES('44','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','11','2023-07-26 16:11:58','1');
INSERT INTO `permissions_granted` VALUES('45','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','16','2023-08-13 15:24:44','1');
INSERT INTO `permissions_granted` VALUES('46','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','3','2023-08-13 15:44:23','1');
INSERT INTO `permissions_granted` VALUES('47','1','17','2023-08-18 12:19:25','1');
INSERT INTO `permissions_granted` VALUES('48','1','18','2023-08-18 12:19:30','1');
INSERT INTO `permissions_granted` VALUES('49','1','19','2023-08-19 10:00:41','1');
INSERT INTO `permissions_granted` VALUES('50','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','19','2023-08-20 17:12:20','1');
INSERT INTO `permissions_granted` VALUES('51','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','18','2023-08-20 17:12:23','1');
INSERT INTO `permissions_granted` VALUES('52','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','17','2023-08-20 17:12:27','1');
DROP TABLE IF EXISTS `petty_cash_requisitions`;

CREATE TABLE `petty_cash_requisitions` (
  `requisition_id` int NOT NULL AUTO_INCREMENT,
  `requested_by` varchar(60) NOT NULL,
  `department_id` int NOT NULL,
  `subject` varchar(1028) NOT NULL,
  `sponsor` varchar(128) NOT NULL,
  `amount` double NOT NULL,
  `description` varchar(1028) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `requisition_status` int NOT NULL DEFAULT '0',
  `approved_by` varchar(60) DEFAULT NULL,
  `remarks` text,
  `date_approved` date DEFAULT NULL,
  PRIMARY KEY (`requisition_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
INSERT INTO `petty_cash_requisitions` VALUES('1','1','1','Stationery','None','12000','','2023-07-05 05:51:06','1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','','2023-08-21');
INSERT INTO `petty_cash_requisitions` VALUES('2','1','1','Information Inquiry','None','529151.5','','2023-07-05 05:52:48','1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','','2023-08-21');
INSERT INTO `petty_cash_requisitions` VALUES('3','1','10','Transport','None','12000','I would like to go to city centre to print business cards.','2023-07-05 05:53:58','1','1','No problem','2023-07-08');
INSERT INTO `petty_cash_requisitions` VALUES('4','1','1','dsdsdss','None','1568503.6','dsaas','2023-07-05 05:55:32','1','1','','2023-07-08');
INSERT INTO `petty_cash_requisitions` VALUES('5','1','20','Training Fees','Reserve Bank','120000','Am writing exams..','2023-07-06 21:45:18','2','1','There is no cash','2023-07-08');
INSERT INTO `petty_cash_requisitions` VALUES('6','1','10','dsdsdss','None','1568503.6','bhhhhh','2023-07-07 17:13:29','1','1','No problem','2023-07-08');
INSERT INTO `petty_cash_requisitions` VALUES('7','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','4','Lunch Allowances','None','54000','We are working over the lunch, this request is as lunch money for six officers.','2023-07-08 13:33:50','1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','No problem','2023-08-21');
INSERT INTO `petty_cash_requisitions` VALUES('8','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','3','Transport Refund','MUSCCO','100000','We are working over the lunch, this request is as lunch money for six officers. We are working over the lunch, this request is as lunch money for six officers. We are working over the lunch, this request is as lunch money for six officers. We are working over the lunch, this request is as lunch money for six officers. We are working over the lunch, this request is as lunch money for six officers. We are working over the lunch, this request is as lunch money for six officers. We are working over the lunch, this request is as lunch money for six officers. We are working over the lunch, this request is as lunch money for six officers. We are working over the lunch, this request is as lunch money for six officers. We are working over the lunch, this request is as lunch money for six officers.','2023-07-08 13:35:23','1','1','We are working over the lunch, this request is as lunch money for six officers.We are working over the lunch, this request is as lunch money for six officers.We are working over the lunch, this request is as lunch money for six officers.','2023-07-08');
INSERT INTO `petty_cash_requisitions` VALUES('9','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','3','Information Inquiry','OB','20000','jhjh jhjj','2023-07-26 15:39:27','1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','hjhjh','2023-07-26');
INSERT INTO `petty_cash_requisitions` VALUES('11','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','3','Lunch Allowances','MUSCCO','123332','desc','2023-08-23 23:38:34','1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','Checked','2023-08-23');
INSERT INTO `petty_cash_requisitions` VALUES('12','1','1','Lunch Allowances','MUSCCO','1233','hello there','2023-08-24 00:03:13','0','','','');
DROP TABLE IF EXISTS `pillars`;

CREATE TABLE `pillars` (
  `pillar_id` int NOT NULL AUTO_INCREMENT,
  `pillar` varchar(128) NOT NULL,
  PRIMARY KEY (`pillar_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
INSERT INTO `pillars` VALUES('1','Risk Management');
INSERT INTO `pillars` VALUES('2','Marketing and Advocacy');
INSERT INTO `pillars` VALUES('3','Innovation ');
INSERT INTO `pillars` VALUES('4','Inclusive Growth/SACCO development');
DROP TABLE IF EXISTS `positions`;

CREATE TABLE `positions` (
  `position_id` int NOT NULL AUTO_INCREMENT,
  `position` varchar(1028) NOT NULL,
  `member_of` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`position_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COMMENT='Stores Sacco and Muscco Positions';
INSERT INTO `positions` VALUES('1','IT Admin','0');
INSERT INTO `positions` VALUES('2','Secretary','0');
INSERT INTO `positions` VALUES('3','Driver','0');
INSERT INTO `positions` VALUES('4','Business Development Officer','0');
INSERT INTO `positions` VALUES('6','ICT Officer','0');
INSERT INTO `positions` VALUES('11','ICT Officer','6');
INSERT INTO `positions` VALUES('12','ICT Officer','11');
INSERT INTO `positions` VALUES('13','Driver','11');
INSERT INTO `positions` VALUES('14','Auto Electrician(Internship)','11');
INSERT INTO `positions` VALUES('15','Auditor','0');
INSERT INTO `positions` VALUES('17','Executive Director','0');
DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product` varchar(1028) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
INSERT INTO `products` VALUES('2','Aspect 360');
INSERT INTO `products` VALUES('3','Sage 50 Accounts');
INSERT INTO `products` VALUES('4','Fin Financials');
INSERT INTO `products` VALUES('5','eFix Help Desk');
INSERT INTO `products` VALUES('6','ClickIT');
DROP TABLE IF EXISTS `sacco`;

CREATE TABLE `sacco` (
  `sacco_id` int NOT NULL AUTO_INCREMENT,
  `sacco_name` varchar(1028) NOT NULL,
  `registered_date` date NOT NULL,
  `location` varchar(128) NOT NULL,
  `phone_number` varchar(32) NOT NULL,
  `email_address` varchar(32) NOT NULL,
  `physical_address` text NOT NULL,
  `sacco_president` varchar(32) NOT NULL,
  `assets` double NOT NULL,
  `shares` double NOT NULL,
  `deposits` double NOT NULL,
  `profits` double NOT NULL,
  `loans` double NOT NULL,
  `male_membership` int DEFAULT NULL,
  `female_membership` int DEFAULT NULL,
  `youth_membership` int DEFAULT NULL,
  `other_membership` int DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sacco_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
INSERT INTO `sacco` VALUES('5','United Civil Service','2023-06-01','Lilongwe','08898998','info@ucs.org','Civil Stadium Complex, Area 9, Lilongwe','Mayamiko Bandawe','12000000','23000000','90000000','0','1000000','20','32','9','10','2023-06-16 10:24:44');
INSERT INTO `sacco` VALUES('6','Sunbird Sacco','2020-01-01','Lilongwe','088989998','ed@sunbird.com','Capital City','Thandie Chilongo','122212','55454','11124243','0','32234242','10','11','12','2','2023-06-16 16:41:50');
INSERT INTO `sacco` VALUES('11','OB Sacco','2023-06-01','Blantyre','088989898','ob@gmail.com','Namiyango','Owen Banda','1000000','1000000','1000000','100','500000','10','19','8','1','2023-06-20 22:24:58');
INSERT INTO `sacco` VALUES('12','Wendie Sacco','2023-06-01','Lilongwe','07787999','ws@ws.com','Chinsapo 1','Wendie Phiri','10000','90000','2020202','0','220202','900','899','9','89','2023-06-21 13:55:52');
INSERT INTO `sacco` VALUES('13','JJ Sacco','2023-07-14','Lilongwe','0991603780','wezmhango@hotmail.com','Kasungu','James Bandawe','10000','111','111','1211','12221','11','11','11','11','2023-07-13 19:22:50');
DROP TABLE IF EXISTS `sacco_members`;

CREATE TABLE `sacco_members` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sacco_member_id` varchar(60) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `email_address` varchar(128) DEFAULT NULL,
  `phone_number` varchar(32) DEFAULT NULL,
  `department_id` int DEFAULT NULL,
  `position_id` int DEFAULT NULL,
  `sacco_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
INSERT INTO `sacco_members` VALUES('1','iUqiHBYPEsRdETsK4i9Jt8wpEfUTb00wcpfmcgZt6GWjknK','Kondwa','Chikanda','chikandakondwani@gmail.com','0991603780','','','3');
INSERT INTO `sacco_members` VALUES('3','4ADyB2phVNO8LSQ7','Hassan','Abisao','hassan@ucs.org','0777898797','','','5');
INSERT INTO `sacco_members` VALUES('4','zuEtGXUez55DBiuDEqEiEe4q','Wendie','Mhango','wendie@gmail.com','08816789240','','','6');
INSERT INTO `sacco_members` VALUES('9','7DKHe8o4B6ET2KaySKCwGgbuc0nXJzhkUz9e5ywHmq9VZcCuMEcsopr','Erick','Khowoyo','erick@gmail.com','0778789898','17','12','11');
INSERT INTO `sacco_members` VALUES('10','tz4TdxysBac4CGJkxFlr0kQpyY3v2odXdJA5GkKRkwGsYTZWvFoqe','Jane','Bandawe','jane@ws.com','0889989889','','','12');
INSERT INTO `sacco_members` VALUES('12','s7bGYKKZkOZo31xr9c6bpN8WiRSOJjFu5uQHiPWApdvBwmc4Ihl21','Andrew','manjale','wezziemhango1@gmail.com','0991603780','17','12','11');
INSERT INTO `sacco_members` VALUES('13','tByYPo1Aja8Zdmwn5','Steven','Kachale','steve@gmail.com','0993189239','17','12','11');
INSERT INTO `sacco_members` VALUES('14','0X9nrcABNlTT5RwOuwXl4DyD5USXZaDDaRCflIPcc9g2NXgeqtUhO','Wezzie','Mhango','ametakpaul@icloud.com','0996979468','','','13');
INSERT INTO `sacco_members` VALUES('15','6w63XMxKrqxJ5emiViDCC5HrVf9EO7','Pauls','Katema','ametakpaul@icloud.com','0996979468','19','14','11');
DROP TABLE IF EXISTS `system_users`;

CREATE TABLE `system_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `member_id` varchar(60) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(128) NOT NULL,
  `user_role` int NOT NULL DEFAULT '0',
  `member_of` int NOT NULL DEFAULT '0',
  `account_status` int NOT NULL DEFAULT '0',
  `login_trials` int NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;
INSERT INTO `system_users` VALUES('1','1','chawe','3be9c018356ac60fa7bcbc5a6c5ad6136ef295c9','0','0','1','0','2023-06-15 14:24:56');
INSERT INTO `system_users` VALUES('12','wSJ3FdkBZj5aW30VtuwVRMf6BgoxpUmWcHMFly8WM7LUYZHY1bdZzY','kondwani1','836babddc66080e01d52b8272aa9461c69ee0496','2','0','0','0','2023-06-15 19:10:02');
INSERT INTO `system_users` VALUES('13','iUqiHBYPEsRdETsK4i9Jt8wpEfUTb00wcpfmcgZt6GWjknK','kondwani','a642a77abd7d4f51bf9226ceaf891fcbb5b299b8','1','3','0','0','2023-06-15 21:46:42');
INSERT INTO `system_users` VALUES('14','knFVGNw1qNp5pwnxUTzmrEmEn527rGybN78fkcO3grf54zg','mayamiko','68c0a3b30cda0c86140e3ba04f8c59c41250d5ff','1','4','0','0','2023-06-16 10:20:08');
INSERT INTO `system_users` VALUES('15','4ADyB2phVNO8LSQ7','hassan','b8b14e12403e31ea873c4fa8a44f8208ace56463','1','5','0','0','2023-06-16 10:24:44');
INSERT INTO `system_users` VALUES('16','zuEtGXUez55DBiuDEqEiEe4q','wendie','a642a77abd7d4f51bf9226ceaf891fcbb5b299b8','1','6','1','0','2023-06-16 16:41:50');
INSERT INTO `system_users` VALUES('17','9N40jLqge07VHqNAXDiXIXTChLVOTBkD4DK3','dsdsdsd','a642a77abd7d4f51bf9226ceaf891fcbb5b299b8','1','7','0','0','2023-06-16 17:27:57');
INSERT INTO `system_users` VALUES('18','Ye70bkc271KbrbspPBhfQ6Z9MgYevbMucFnlotBJ2m6J2k8','wezziemhango@yahoo.com','a642a77abd7d4f51bf9226ceaf891fcbb5b299b8','1','8','0','0','2023-06-16 17:31:28');
INSERT INTO `system_users` VALUES('19','D5CKDuRL1ppWaOWzMf0AjzTe9Cau','1111','a642a77abd7d4f51bf9226ceaf891fcbb5b299b8','1','9','0','0','2023-06-16 17:39:03');
INSERT INTO `system_users` VALUES('20','q0Z6H389aRlHT4hcqpKGI6y','chawezi','a642a77abd7d4f51bf9226ceaf891fcbb5b299b8','2','0','1','0','2023-06-17 23:18:50');
INSERT INTO `system_users` VALUES('21','9CzmRWNrQUJHjaNSYSdd','francis','a642a77abd7d4f51bf9226ceaf891fcbb5b299b8','1','10','1','0','2023-06-19 16:34:06');
INSERT INTO `system_users` VALUES('23','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','owen','356a192b7913b04c54574d18c28d46e6395428ab','2','0','1','0','2023-06-20 21:53:50');
INSERT INTO `system_users` VALUES('24','7DKHe8o4B6ET2KaySKCwGgbuc0nXJzhkUz9e5ywHmq9VZcCuMEcsopr','erick','f638e2789006da9bb337fd5689e37a265a70f359','1','11','1','0','2023-06-20 22:24:58');
INSERT INTO `system_users` VALUES('25','tz4TdxysBac4CGJkxFlr0kQpyY3v2odXdJA5GkKRkwGsYTZWvFoqe','jane','b83755992eaa20453a0cd68fc01837c2422a6886','1','12','0','0','2023-06-21 13:55:52');
INSERT INTO `system_users` VALUES('26','NaDWA87mvh2sIzRKLE6','love','a642a77abd7d4f51bf9226ceaf891fcbb5b299b8','1','13','0','0','2023-06-21 14:04:12');
INSERT INTO `system_users` VALUES('27','s7bGYKKZkOZo31xr9c6bpN8WiRSOJjFu5uQHiPWApdvBwmc4Ihl21','andrew','a642a77abd7d4f51bf9226ceaf891fcbb5b299b8','3','11','0','0','2023-06-22 00:04:08');
INSERT INTO `system_users` VALUES('28','tByYPo1Aja8Zdmwn5','steve','356a192b7913b04c54574d18c28d46e6395428ab','3','11','1','0','2023-06-22 00:06:20');
INSERT INTO `system_users` VALUES('29','0X9nrcABNlTT5RwOuwXl4DyD5USXZaDDaRCflIPcc9g2NXgeqtUhO','chawe111','a642a77abd7d4f51bf9226ceaf891fcbb5b299b8','1','13','0','0','2023-07-13 19:22:50');
INSERT INTO `system_users` VALUES('30','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh','chawezie','3f196cfb6c4cffe3002c0495a1bc822521b6aa36','4','999','1','0','2023-07-13 23:17:22');
INSERT INTO `system_users` VALUES('31','7Fh2e6tPqTlJvYckPjEHncoG0h4jI8IRnMQHYaM','lovese','a642a77abd7d4f51bf9226ceaf891fcbb5b299b8','4','999','0','0','2023-07-13 23:23:56');
INSERT INTO `system_users` VALUES('32','6w63XMxKrqxJ5emiViDCC5HrVf9EO7','pauls','f638e2789006da9bb337fd5689e37a265a70f359','3','11','1','0','2023-07-17 16:57:58');
INSERT INTO `system_users` VALUES('33','cQNxbUoASET5XxUBlicaZsxoaQs3ByVDxrR7sNrcKLlekz0J','wendi','f638e2789006da9bb337fd5689e37a265a70f359','2','0','1','0','2023-08-20 22:21:49');
INSERT INTO `system_users` VALUES('34','wTKcHAp53T8FsMdBDwVL3Gbu','hanna','06651252b9be3adf9350c2ee5d2b581df4d6030c','4','999','1','0','2023-08-26 01:29:31');
DROP TABLE IF EXISTS `ticket_categories`;

CREATE TABLE `ticket_categories` (
  `ticket_category_id` int NOT NULL AUTO_INCREMENT,
  `ticket_category` varchar(1028) NOT NULL,
  PRIMARY KEY (`ticket_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
INSERT INTO `ticket_categories` VALUES('4','General');
INSERT INTO `ticket_categories` VALUES('5','System');
DROP TABLE IF EXISTS `ticket_response`;

CREATE TABLE `ticket_response` (
  `response_id` int NOT NULL AUTO_INCREMENT,
  `ticket_id` int NOT NULL,
  `member_id` varchar(60) NOT NULL,
  `response` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`response_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;
INSERT INTO `ticket_response` VALUES('32','22','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','ok','2023-06-29 21:53:15');
INSERT INTO `ticket_response` VALUES('33','22','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','dsds sdsdsd dsdsd sdsds sdsd','2023-06-29 21:53:25');
INSERT INTO `ticket_response` VALUES('34','21','1','d','2023-07-02 21:57:23');
INSERT INTO `ticket_response` VALUES('35','32','7DKHe8o4B6ET2KaySKCwGgbuc0nXJzhkUz9e5ywHmq9VZcCuMEcsopr','njj','2023-07-02 22:54:25');
INSERT INTO `ticket_response` VALUES('36','33','7DKHe8o4B6ET2KaySKCwGgbuc0nXJzhkUz9e5ywHmq9VZcCuMEcsopr','bnn','2023-07-02 22:56:23');
INSERT INTO `ticket_response` VALUES('37','34','tByYPo1Aja8Zdmwn5','hello','2023-07-16 21:56:48');
INSERT INTO `ticket_response` VALUES('38','32','tByYPo1Aja8Zdmwn5','Yes','2023-07-16 22:00:28');
INSERT INTO `ticket_response` VALUES('39','34','tByYPo1Aja8Zdmwn5','sure thing','2023-07-16 22:25:59');
INSERT INTO `ticket_response` VALUES('40','35','7DKHe8o4B6ET2KaySKCwGgbuc0nXJzhkUz9e5ywHmq9VZcCuMEcsopr','Dont worry','2023-07-17 14:43:26');
INSERT INTO `ticket_response` VALUES('41','32','7DKHe8o4B6ET2KaySKCwGgbuc0nXJzhkUz9e5ywHmq9VZcCuMEcsopr','So how is it that side?','2023-07-17 14:45:39');
INSERT INTO `ticket_response` VALUES('42','33','1','Okay this is noted','2023-07-17 14:51:44');
INSERT INTO `ticket_response` VALUES('43','33','7DKHe8o4B6ET2KaySKCwGgbuc0nXJzhkUz9e5ywHmq9VZcCuMEcsopr','Okay, i will be waiting..','2023-07-17 14:59:07');
INSERT INTO `ticket_response` VALUES('44','36','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','Hello, any progress?','2023-08-26 01:00:23');
DROP TABLE IF EXISTS `tickets`;

CREATE TABLE `tickets` (
  `ticket_id` int NOT NULL AUTO_INCREMENT,
  `posted_by` varchar(60) NOT NULL,
  `ticket_title` varchar(1028) NOT NULL,
  `ticket_description` text NOT NULL,
  `ticket_category` int NOT NULL,
  `ticket_product` int NOT NULL,
  `ticket_priority` int NOT NULL DEFAULT '0',
  `ticket_attachment` varchar(60) DEFAULT NULL,
  `ticket_referred` int NOT NULL DEFAULT '0',
  `date_referred` datetime DEFAULT NULL,
  `date_closed` datetime DEFAULT NULL,
  `date_opened` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `closing_remarks` text,
  `ticket_status` int NOT NULL DEFAULT '0',
  `member_of` int NOT NULL,
  `ticket_progress` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`ticket_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
INSERT INTO `tickets` VALUES('21','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','Individual Loan Application Form','fdfdfd dfdf','4','5','2','','0','','2023-08-25 23:01:17','2023-06-29 21:45:22','','1','0','20');
INSERT INTO `tickets` VALUES('22','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','Individual Loan Application Form','heeloo','5','6','2','','0','','','2023-06-29 21:47:47','','0','0','0');
INSERT INTO `tickets` VALUES('23','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','ddsdsd','fdfd','5','4','1','','0','','','2023-06-29 21:48:27','','0','0','0');
INSERT INTO `tickets` VALUES('24','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','ddsdsd','fdfd','5','4','1','','0','','','2023-06-29 21:48:31','','0','0','0');
INSERT INTO `tickets` VALUES('25','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','ddsdsd','fdfd','5','4','1','','0','','','2023-06-29 21:48:31','','0','0','0');
INSERT INTO `tickets` VALUES('26','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','ddsdsd','fdfd','5','4','1','','0','','','2023-06-29 21:48:31','','0','0','0');
INSERT INTO `tickets` VALUES('27','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','ddsdsd','fdfd','5','4','1','','0','','','2023-06-29 21:48:31','','0','0','0');
INSERT INTO `tickets` VALUES('28','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','ddsdsd','fdfd','5','4','1','','0','','','2023-06-29 21:48:31','','0','0','0');
INSERT INTO `tickets` VALUES('29','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','ddsdsd','fdfd','5','4','1','','0','','','2023-06-29 21:48:32','','0','0','0');
INSERT INTO `tickets` VALUES('30','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','ddsdsd','fdfd','5','4','1','','0','','','2023-06-29 21:48:32','','0','0','0');
INSERT INTO `tickets` VALUES('31','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','KVRTC Parallel Application Form 2022-23','hello','5','5','4','','0','','','2023-06-29 21:49:34','','0','0','0');
INSERT INTO `tickets` VALUES('32','7DKHe8o4B6ET2KaySKCwGgbuc0nXJzhkUz9e5ywHmq9VZcCuMEcsopr','Company Profile','kjjkjkj','5','2','1','','0','','2023-07-17 12:46:17','2023-07-02 22:07:20','dsd','1','11','0');
INSERT INTO `tickets` VALUES('33','tByYPo1Aja8Zdmwn5','Company Profile','mmm','4','6','2','','0','','2023-07-17 12:59:44','2023-07-02 22:14:35','This is well','1','11','80');
INSERT INTO `tickets` VALUES('34','tByYPo1Aja8Zdmwn5','Company Profile','kjkjkj','4','2','1','1684677046_1689537273.jpg','0','','','2023-07-16 21:54:33','','0','11','0');
INSERT INTO `tickets` VALUES('35','7DKHe8o4B6ET2KaySKCwGgbuc0nXJzhkUz9e5ywHmq9VZcCuMEcsopr','360 Error','How can we resolve this problem?','5','2','1','','0','','','2023-07-17 14:39:50','','0','11','0');
INSERT INTO `tickets` VALUES('36','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','Member Account Opening','Very delicate situation','4','2','1','1910898727_1693004348.jpeg','0','','','2023-08-26 00:59:08','','0','0','0');
DROP TABLE IF EXISTS `travel_advance_request`;

CREATE TABLE `travel_advance_request` (
  `advance_id` int NOT NULL AUTO_INCREMENT,
  `travel_advance_id` varchar(128) NOT NULL,
  `employee_id` varchar(60) NOT NULL,
  `pillar` int NOT NULL,
  `purpose` text NOT NULL,
  `logistics` varchar(128) NOT NULL,
  `nights` int NOT NULL,
  `rate` double NOT NULL,
  `day_meal` double NOT NULL,
  `mileage` double DEFAULT NULL,
  `total_fuel` double DEFAULT NULL,
  `fuel` varchar(11) DEFAULT NULL,
  `fuel_price` double DEFAULT NULL,
  `total_budget` double DEFAULT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `checked_by` varchar(60) DEFAULT NULL,
  `date_checked` date DEFAULT NULL,
  `checker_note` text,
  `approved_by` varchar(60) DEFAULT NULL,
  `date_approved` date DEFAULT NULL,
  `approver_note` text,
  `request_status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`advance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
INSERT INTO `travel_advance_request` VALUES('1','1692290831X8CJgtoPGZ14c1uDnCMiC48Bpa84','1','4','Field Visit','1','1','15000','10000','120','23040','1','1920','48040','2023-08-17 23:08:44','1','2023-08-19','','1','2023-08-19','','2');
INSERT INTO `travel_advance_request` VALUES('2','1692306681rqL4P','1','3','Field Visit','2','2','35000','10000','700','134400','1','1920','214400','2023-08-17 23:11:27','1','2023-08-19','No problem','1','2023-08-19','No problem','2');
INSERT INTO `travel_advance_request` VALUES('3','1692307434BusOcy4yROiisObaWHwc','1','4','Field Visit','3','2','10000','10000','120','23040','1','1920','23040','2023-08-17 23:27:05','1','2023-08-20','No problem','1','2023-08-20','No problem','2');
INSERT INTO `travel_advance_request` VALUES('4','1692307734LLMQP','1','1','Field Visit','1','1','15000','10000','0','0','','','25000','2023-08-17 23:40:33','1','2023-08-20','','1','2023-08-20','','2');
INSERT INTO `travel_advance_request` VALUES('5','1692342012qyGLOqNZj3qBh814OACrpFlq9KnXGisivIfmoXDTMcDK34dg','1','4','Field Visit','1','1','15000','10000','100','19200','Array','1920','44200','2023-08-18 09:00:18','1','2023-08-18','No problem','1','2023-08-19','No problem','2');
INSERT INTO `travel_advance_request` VALUES('6','1692342088d0NEHvoxLeTE1IbJZKAD1AJfwMvr3f7LqvKx','1','4','Field Visit','1','1','15000','10000','0','0','','','25000','2023-08-18 09:01:30','1','2023-08-18','No problem','1','2023-08-18','No problem','2');
INSERT INTO `travel_advance_request` VALUES('7','1692516679rlYuPa6enM','1','3','Field Visit','3','1','10000','10000','0','0','','','0','2023-08-20 09:31:58','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-20','','','','','1');
INSERT INTO `travel_advance_request` VALUES('8','1692518592aLX7H2nxzxum','1','3','Field Visit','3','1','10000','10000','0','0','','','0','2023-08-20 10:03:30','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-20','No problem','','','','1');
INSERT INTO `travel_advance_request` VALUES('10','1692518849qFh8pVoePkcmwqGWXjXvhaj4','1','3','Field Visit','3','1','10000','10000','650','113490','Array','1746','123490','2023-08-20 10:08:19','1','2023-08-20','No problem','','','','99');
INSERT INTO `travel_advance_request` VALUES('11','1692519165RRhZaj3TZ1pbF1HGSyBs1','1','3','Field Visit','3','1','10000','10000','120','20952','2','1746','30952','2023-08-20 10:13:16','1','2023-08-20','No problem','1','2023-08-20','No problem','2');
INSERT INTO `travel_advance_request` VALUES('12','169251948218a6ApwCWtVn','1','3','Field Visit','3','1','10000','0','50','8730','2','1746','18730','2023-08-20 10:18:38','1','2023-08-20','No problem','1','2023-08-20','No problem','2');
INSERT INTO `travel_advance_request` VALUES('13','1689845872vDGIFNvOKYuQlisZk85JI2TtGni0N','1','3','Field Visit','1','2','15000','10000','650','124800','1','1920','164800','2023-07-20 11:38:27','1','2023-07-20','No problem','1','2023-07-20','','2');
INSERT INTO `travel_advance_request` VALUES('14','1689845949PhhyKfG3JdN2kzi3rLPMi3b70aaImyZTLL4FSj6BUVNRmFf','1','1','Field Visit','2','2','35000','10000','650','124800','1','1920','204800','2023-07-20 11:39:27','1','2023-07-20','No problem','1','2023-07-20','No problem','2');
INSERT INTO `travel_advance_request` VALUES('15','1689846013ZOPRUYxL','1','3','Field Visit','3','1','10000','0','125','24000','1','1920','34000','2023-07-20 11:40:22','1','2023-07-20','No problem','1','2023-07-20','','2');
INSERT INTO `travel_advance_request` VALUES('16','16925485008yYi5ozUi2xDA1uTrfqY9Goe9','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','3','Field Visit','1','2','20000','15000','120','23040','1','1920','78040','2023-08-20 18:21:45','1','2023-08-20','No problem','1','2023-08-20','No problem','2');
INSERT INTO `travel_advance_request` VALUES('17','1692563160XiT3Sy','cQNxbUoASET5XxUBlicaZsxoaQs3ByVDxrR7sNrcKLlekz0J','4','Field Visit','2','5','35000','10000','7000','1344000','1','1920','1529000','2023-08-20 22:26:05','','','','','','','0');
INSERT INTO `travel_advance_request` VALUES('18','1692563924Er5hR38iyaSdNb5N6RE0w0','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','3','Field Visit','2','4','50000','15000','700','134400','1','1920','349400','2023-08-20 22:44:59','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-20','No problem','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-20','No problem','2');
INSERT INTO `travel_advance_request` VALUES('20','1692801960pBpKnG','1','4','To attend an annual AGM in Blantyre','2','3','35000','10000','900','157140','2','1746','272140','2023-08-23 16:46:18','1','2023-08-23','Checked','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-23','Checked','2');
INSERT INTO `travel_advance_request` VALUES('22','1692811995nyZJQ0R4IJ1DPQYaothvxCldeWqv3YmUh','1','4','1','1','8','15000','10000','600','115200','1','1920','245200','2023-08-23 19:33:38','','','','','','','0');
INSERT INTO `travel_advance_request` VALUES('23','1692812171uwZgGx5ZCS2PfItqQRfp','1','3','Field trip','2','2','35000','10000','780','0','','','80000','2023-08-23 19:38:12','','','','','','','0');
INSERT INTO `travel_advance_request` VALUES('24','1692812854pwm3k90','1','4','Field trip','1','1','15000','10000','10','1920','1','1920','26920','2023-08-23 19:49:09','','','','','','','0');
INSERT INTO `travel_advance_request` VALUES('25','16928136783OaqbY4vMIROvh4sS3YmAnURSdd8ikZc','1','4','1','1','9','15000','10000','1','174.6','2','1746','145174.6','2023-08-23 20:05:53','','','','','','','0');
INSERT INTO `travel_advance_request` VALUES('26','1692814191RBMfQubScrAkb3N8QVEHS','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','3','1','2','15','50000','15000','900','172800','1','1920','937800','2023-08-23 20:12:39','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-23','Checked','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-23','Checked','2');
INSERT INTO `travel_advance_request` VALUES('27','1692814747qXvCXnl5FqwBCk0qp','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','3','Field trip','3','1','15000','0','123','23616','1','1920','38616','2023-08-23 20:19:31','','','','','','','0');
DROP TABLE IF EXISTS `vehicle_requests`;

CREATE TABLE `vehicle_requests` (
  `request_id` int NOT NULL AUTO_INCREMENT,
  `requested_by` varchar(60) NOT NULL,
  `date_requested` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `driver_name` varchar(128) NOT NULL,
  `activity_name` varchar(1028) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `destination` varchar(128) DEFAULT NULL,
  `departure_from` varchar(128) NOT NULL,
  `days` int DEFAULT NULL,
  `vehicle_assigned` varchar(128) DEFAULT NULL,
  `open_mileage` double DEFAULT NULL,
  `close_mileage` double DEFAULT NULL,
  `fuel_level` varchar(32) DEFAULT NULL,
  `tools` varchar(128) DEFAULT NULL,
  `dents` varchar(32) DEFAULT NULL,
  `spare_tyre` varchar(32) DEFAULT NULL,
  `cleanliness` varchar(32) DEFAULT NULL,
  `checked_by` varchar(60) DEFAULT NULL,
  `authorized_by` varchar(60) DEFAULT NULL,
  `received_by` varchar(60) DEFAULT NULL,
  `date_checked` date DEFAULT NULL,
  `date_authorized` date DEFAULT NULL,
  `date_received` date DEFAULT NULL,
  `request_status` int NOT NULL DEFAULT '0',
  `authorize_remarks` varchar(1028) DEFAULT NULL,
  `return_fuel_level` varchar(32) DEFAULT NULL,
  `fuel_used` double DEFAULT NULL,
  `return_distance_covered` double DEFAULT NULL,
  `return_cleanliness` varchar(32) DEFAULT NULL,
  `return_tools` varchar(128) DEFAULT NULL,
  `return_spare_tyre` varchar(32) DEFAULT NULL,
  `return_dents` varchar(32) DEFAULT NULL,
  `distance_covered` double DEFAULT NULL,
  `return_remarks` text,
  `date_returned` date DEFAULT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
INSERT INTO `vehicle_requests` VALUES('1','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-07-02 21:08:02','Mr P. Katema','Field Visit','2023-07-04','2023-07-07','Ntchisi','','','BV 2022','120','125','Empty',' Jack Triangle Plates','1','Available','Very Clean','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','','2023-07-02','2023-07-02','2023-07-02','4','They can take the car, but after they return they must take it to garage for servicing','Empty','1120','','Very Clean',' Jack Triangle Plates Ropes','Available','1','5','','2023-07-07');
INSERT INTO `vehicle_requests` VALUES('2','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-07-02 21:20:29','Kondwani Chikanda','LVTC Visit','2023-07-04','2023-07-07','Magomero','','','BV 2022','123','','1/4',' Jack Triangle Plates','1','Available','Very Clean','1','1','','2023-07-03','2023-07-03','2023-08-20','3','','','','','','','','','','','');
INSERT INTO `vehicle_requests` VALUES('3','1','2023-07-03 06:53:33','Wezzie he Mhango','Mr P. Katema','2023-07-12','2023-07-20','Ntchisi','','','BV 2022','120','120','Empty',' Jack Triangle Plates Ropes','1','Available','Very Clean','1','1','','2023-07-03','2023-07-03','2023-07-03','4','','1/4','1123','','Very Clean',' Jack Triangle Plates','Available','1','5','','2023-07-04');
INSERT INTO `vehicle_requests` VALUES('4','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-07-26 16:04:02','mfgfgf','hytytyt','2023-07-28','2023-07-31','fgfgfgft','','','bt5656','90000','91000','1/4',' Jack Triangle Plates Ropes Mats','1','Available','Not Clean','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','','2023-07-26','2023-07-26','2023-07-26','4','gfhfhf','Empty','1000000','','Very Clean',' Jack Triangle Plates Ropes Mats','Available','1','1000','','2023-07-26');
INSERT INTO `vehicle_requests` VALUES('5','1','2023-08-15 14:38:31','Wezzie he Mhango','Wezzie he Mhango','2023-08-16','2023-08-16','Blantyre','Lilongwe','','BV 2022','120','123','1/4',' Triangle Plates','1','Available','Very Clean','1','1','','2023-08-15','2023-08-15','2023-08-15','4','They can take the car, but after they return they must take it to garage for servicing','1/4','1123','','Very Clean',' Triangle Plates','Available','1','5','','2023-08-15');
INSERT INTO `vehicle_requests` VALUES('6','1','2023-08-18 12:42:43','Wezzie he Mhango','help','2023-08-19','2023-08-20','Blantyre','Lilongwe','','BV 2022','120','','Empty',' Mats','1','Available','Very Clean','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','','2023-08-20','2023-08-20','','2','No problem','','','','','','','','','','');
INSERT INTO `vehicle_requests` VALUES('7','1','2023-08-20 23:13:14','Wezzie he Mhango','Field Visit','2023-08-21','2023-08-20','Blantyre','Zomba','','','','','','','','','','','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','','','2023-08-20','','2','No problem','','','','','','','','','','');
INSERT INTO `vehicle_requests` VALUES('8','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-21 00:03:28','Wezzie he Mhango','Wezzie he Mhango','2023-08-21','2023-08-22','','','','','','','','','','','','','','','','','','0','','','','','','','','','','','');
INSERT INTO `vehicle_requests` VALUES('9','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','2023-08-21 00:05:22','Wezzie he Mhango','Kondwa Chikanda','2023-08-21','2023-08-23','Blantyre','Lilongwe','','','','','','','','','','','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','','','2023-08-20','','1','No problem','','','','','','','','','','');


COMMIT;
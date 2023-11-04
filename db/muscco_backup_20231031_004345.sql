-- database backup - 2023-10-31 00:43:45
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
INSERT INTO `advance_requests` VALUES('1','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','1000000','0','1000000','2023-10','2023-12','School Fees','','','','3','333333.33333333','','','','','','','0','2023-09-06 15:44:06');
INSERT INTO `advance_requests` VALUES('2','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','600000','0','600000','2023-09','2023-12','njinga','b5ZUhuHHuug2ZWVwA','2023-09-06','ok','4','150000','','','','','','','1','2023-09-06 15:45:14');
INSERT INTO `advance_requests` VALUES('3','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','9000','0','9000','2022-01','2023-12','fees','','','','24','375','','','','','','','0','2023-09-06 18:26:31');
INSERT INTO `advance_requests` VALUES('4','4GgsYbqqOz4iPFf0Xal2QC5ZEjtA05qCJyLj2w15a1U','200000','0','200000','2023-09','2023-09','Leave','b5ZUhuHHuug2ZWVwA','2023-09-21','sure','1','200000','','','','','','','1','2023-09-21 16:20:08');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
INSERT INTO `band_rates` VALUES('1','Band 1','100000','50000','20000','15000','10000','2023-08-15 12:19:51');
INSERT INTO `band_rates` VALUES('2','Band 2','70000','35000','15000','10000','7000','2023-08-15 12:21:22');
INSERT INTO `band_rates` VALUES('3','Band 3','40000','30000','12500','8000','5000','2023-08-15 12:22:39');
INSERT INTO `band_rates` VALUES('4','Band 4','30000','25000','10000','5000','5000','2023-08-15 12:23:55');
DROP TABLE IF EXISTS `branches`;

CREATE TABLE `branches` (
  `branch_id` int NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(32) NOT NULL,
  PRIMARY KEY (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
INSERT INTO `branches` VALUES('2','Blantyre');
INSERT INTO `branches` VALUES('3','Mzuzu');
INSERT INTO `branches` VALUES('4','kasungu');
DROP TABLE IF EXISTS `daily_itinerary`;

CREATE TABLE `daily_itinerary` (
  `daily_id` int NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(60) NOT NULL,
  `travel_advance_id` varchar(128) NOT NULL,
  `date` date NOT NULL,
  `place_from` varchar(128) NOT NULL,
  `place_to` varchar(128) NOT NULL,
  PRIMARY KEY (`daily_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
INSERT INTO `daily_itinerary` VALUES('1','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','1694004626PBrbYT5jZqMksDL466s9pNZguWzm','2023-09-07','BT','LL');
INSERT INTO `daily_itinerary` VALUES('2','1g2Xg8OetUpCAtJhjNb09mdqfwcGPJPkuguaJ','1694004838TItrJsiOQbbNezS9DVZSRzTxhTfxp8PhADIBEM','2023-09-06','LL','BT');
INSERT INTO `daily_itinerary` VALUES('3','1g2Xg8OetUpCAtJhjNb09mdqfwcGPJPkuguaJ','16940052078iwlRNEzJen28aSYWDXBTrwCfXM5INP8','2023-09-07','BT','LL');
INSERT INTO `daily_itinerary` VALUES('4','FQqg7qb1YpQVerDuc','1694259880v28ya65dNJg12SgTrda6BJS','2023-09-15','LL','KU');
DROP TABLE IF EXISTS `db_backups`;

CREATE TABLE `db_backups` (
  `backup_id` int NOT NULL AUTO_INCREMENT,
  `backedup_by` varchar(60) NOT NULL,
  `file_title` varchar(128) NOT NULL,
  `file_name` varchar(64) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`backup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
DROP TABLE IF EXISTS `departments`;

CREATE TABLE `departments` (
  `department_id` int NOT NULL AUTO_INCREMENT,
  `department` varchar(1028) NOT NULL,
  `member_of` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1 COMMENT='Stores Sacco and Muscco Departments';
INSERT INTO `departments` VALUES('1','IT','0');
INSERT INTO `departments` VALUES('3','Administration','0');
INSERT INTO `departments` VALUES('4','Accounts','0');
INSERT INTO `departments` VALUES('10','Pocurement','0');
INSERT INTO `departments` VALUES('11','Business Development and Innovations','0');
INSERT INTO `departments` VALUES('20','Audit','0');
INSERT INTO `departments` VALUES('22','IT','1');
INSERT INTO `departments` VALUES('23','Accounts and Admnistration','2');
INSERT INTO `departments` VALUES('24','Credit','2');
INSERT INTO `departments` VALUES('26','Marketing','2');
INSERT INTO `departments` VALUES('27','IT','2');
DROP TABLE IF EXISTS `des`;

CREATE TABLE `des` (
  `id` int NOT NULL AUTO_INCREMENT,
  `de_id` varchar(60) NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `email_address` varchar(32) DEFAULT NULL,
  `phone_number` varchar(32) DEFAULT NULL,
  `location` varchar(128) DEFAULT NULL,
  `graduation_date` date DEFAULT NULL,
  `sponsored_by` varchar(60) DEFAULT NULL,
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
INSERT INTO `des` VALUES('1','8FlnRBhzjuGPtguEN1DtBSySwGnoWULVYY4KbOEtJp3LqyF','Fumbani','Nyangulu','fnyangulu@muscco.org','000456235','Lilongwe','','','2023-09-09 12:14:23');
INSERT INTO `des` VALUES('2','B240DsqynvXcvCjDngrua6','Kondwa','Chikanda','chikandakondwani@gmail.com','0991603780','Lilongwe, Kamuzu Barracks','2023-10-28','2','2023-10-28 23:10:00');
DROP TABLE IF EXISTS `discussion_replies`;

CREATE TABLE `discussion_replies` (
  `reply_id` int NOT NULL AUTO_INCREMENT,
  `topic_id` int NOT NULL,
  `reply` text NOT NULL,
  `replied_by` varchar(60) NOT NULL,
  `date_replied` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `member_of` int NOT NULL,
  PRIMARY KEY (`reply_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
INSERT INTO `discussion_replies` VALUES('1','1','it is a good CBS','1g2Xg8OetUpCAtJhjNb09mdqfwcGPJPkuguaJ','2023-09-06 15:06:14','0');
INSERT INTO `discussion_replies` VALUES('2','1','do you want to go that route','1g2Xg8OetUpCAtJhjNb09mdqfwcGPJPkuguaJ','2023-09-06 15:06:56','0');
INSERT INTO `discussion_replies` VALUES('3','1','Yes, it has capacity for growth and handle big data','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','2023-09-06 15:08:03','0');
INSERT INTO `discussion_replies` VALUES('4','1','how?','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh','2023-09-09 04:37:03','0');
INSERT INTO `discussion_replies` VALUES('5','2','Sure Ife we are sending 10 participants. please organise an invoice','kecORjJq1Zq2Ci0PPSrxPFtD','2023-09-09 12:10:57','1');
INSERT INTO `discussion_replies` VALUES('6','4','It is a good workshop that will help the sacco movement. Lets go and participate from our Fincoop SACCO','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh','2023-09-21 15:49:57','0');
INSERT INTO `discussion_replies` VALUES('7','4','Am sure It will be Successful','4GgsYbqqOz4iPFf0Xal2QC5ZEjtA05qCJyLj2w15a1U','2023-09-21 15:51:00','0');
INSERT INTO `discussion_replies` VALUES('8','4','Absolutely','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh','2023-09-21 15:51:23','0');
DROP TABLE IF EXISTS `discussions`;

CREATE TABLE `discussions` (
  `topic_id` int NOT NULL AUTO_INCREMENT,
  `topic` text NOT NULL,
  `description` text NOT NULL,
  `access_rights` int NOT NULL DEFAULT '0',
  `posted_by` varchar(60) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`topic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
INSERT INTO `discussions` VALUES('1','T24','Core banking Software','0','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','2023-09-06 15:05:40');
INSERT INTO `discussions` VALUES('2','Lake Shore Conference','Lets all participate as it will be a boom','2','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh','2023-09-09 12:09:56');
INSERT INTO `discussions` VALUES('3','SYPN','Where the you should meet','2','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh','2023-09-21 14:25:26');
INSERT INTO `discussions` VALUES('4','Upcoming SACCO Workshop','How do we want the workshop to be conducted','2','4GgsYbqqOz4iPFf0Xal2QC5ZEjtA05qCJyLj2w15a1U','2023-09-21 15:49:04');
DROP TABLE IF EXISTS `document_categories`;

CREATE TABLE `document_categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(1028) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
INSERT INTO `document_categories` VALUES('1','Loan Application Forms');
INSERT INTO `document_categories` VALUES('2','Leave Application Forms');
INSERT INTO `document_categories` VALUES('8','New Form');
INSERT INTO `document_categories` VALUES('9','Newsletters');
INSERT INTO `document_categories` VALUES('10','Statistics');
INSERT INTO `document_categories` VALUES('11','SACCO Bylaws');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
INSERT INTO `documents` VALUES('1','June 2023 Stats','','2134123555_1694006224.docx','10','0','0','2023-09-06 15:17:04','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ');
INSERT INTO `documents` VALUES('2','dan','','2100481638_1694015536.docx','2','0','0','2023-09-06 17:52:16','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `documents` VALUES('4','Testing form','','2023533538_1694254088.docx','8','2','0','2023-09-09 12:08:08','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
INSERT INTO `events` VALUES('1','SACCO Congress 2023 - Mangochi','Annual Conference for SACCOs','Nkopola Resort','2023-10-13','2023-10-14','15:08:00','00:00:00','','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','2023-09-06 15:11:50','0','1');
INSERT INTO `events` VALUES('2','Training','Stakeholders engagements','Chitakale Lodge','2023-09-18','2023-09-23','00:00:00','00:00:00','138692415_muscco_event.pdf','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','2023-09-06 15:14:41','0','2');
INSERT INTO `events` VALUES('3','Big Walk','Big walk to raise funds for construction of CDI in Salima','From MUSCCO HQ to Mtengowathenga','2023-09-19','2023-09-27','00:00:00','00:00:00','','FQqg7qb1YpQVerDuc','2023-09-09 13:21:59','0','1');
INSERT INTO `events` VALUES('4','Katakwe','Zabwino ziliko bwerani nonse kuti mudzaone','kawale harvest temple','2023-09-11','2023-09-12','00:00:00','00:00:00','1872507333_muscco_event.pdf','FQqg7qb1YpQVerDuc','2023-09-09 13:55:14','0','2');
INSERT INTO `events` VALUES('5','SACCO Workshop','Scheduled workshop for saccos to enngange with internationals saccos','Salima','2023-10-12','2023-10-15','09:00:00','12:00:00','389808653_muscco_event.pdf','4GgsYbqqOz4iPFf0Xal2QC5ZEjtA05qCJyLj2w15a1U','2023-09-21 15:47:21','0','2');
DROP TABLE IF EXISTS `faqs`;

CREATE TABLE `faqs` (
  `faq_id` int NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `posted_by` int NOT NULL,
  PRIMARY KEY (`faq_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
INSERT INTO `invoices` VALUES('1','000231','1','Training Fees','250000','250000','0','muscco_invoice_000231.pdf','0','FQqg7qb1YpQVerDuc','2023-09-09','2023-10-06');
INSERT INTO `invoices` VALUES('2','me234','2','Training Fees','100000','0','0','muscco_invoice_me234.pdf','0','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh','2023-09-21','2023-10-20');
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
DROP TABLE IF EXISTS `leave_days`;

CREATE TABLE `leave_days` (
  `record_id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(60) NOT NULL,
  `leave_id` int NOT NULL,
  `fy_id` int NOT NULL,
  `days_entitled` double NOT NULL,
  `days_taken` double NOT NULL,
  `days_remaining` double NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(60) NOT NULL,
  PRIMARY KEY (`record_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
DROP TABLE IF EXISTS `leave_entitlement`;

CREATE TABLE `leave_entitlement` (
  `entitled_id` int NOT NULL AUTO_INCREMENT,
  `member_id` varchar(60) NOT NULL,
  `type_id` int NOT NULL,
  `entitlement` double NOT NULL DEFAULT '0',
  `days_taken` double NOT NULL DEFAULT '0',
  `days_remaining` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`entitled_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
DROP TABLE IF EXISTS `leave_fy`;

CREATE TABLE `leave_fy` (
  `fy_id` int NOT NULL AUTO_INCREMENT,
  `fy` year NOT NULL,
  `fy_status` int NOT NULL DEFAULT '0',
  `updated_by` varchar(60) NOT NULL,
  PRIMARY KEY (`fy_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
INSERT INTO `leave_fy` VALUES('3','2023','0','');
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
  `thumb` varchar(62) DEFAULT NULL,
  `branch` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`muscco_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
INSERT INTO `muscco_members` VALUES('1','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh','MUSCCO/01/104q','2','James','Mhango','wezmhango@hotmail.com','0993189240','1','1','1988-01-01','2011-01-01','James_1698710003.jpg','2');
INSERT INTO `muscco_members` VALUES('16','2','1','0','hhhhah','heheheheh','heheh@gmail.com','099799391','4','3','2023-08-16','2023-08-01','','2');
INSERT INTO `muscco_members` VALUES('18','b5ZUhuHHuug2ZWVwA','0001','2','Dannie','Imfa','dan.imfa@muscco.org','0882776242','6','1','2000-01-01','2023-01-01','','2');
INSERT INTO `muscco_members` VALUES('20','GEnQ4WkkGG1fCAifdZvdq','MU28','2','Marko','Nkhoma','mnkhoma@muscco.org','+265999587076','15','20','1978-10-28','2017-11-25','','2');
INSERT INTO `muscco_members` VALUES('21','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','MU20','2','Enerst','Kuyeya','ekuyeya@mfihub.co.mw','0884722153','6','1','1980-07-23','2023-01-01','','2');
INSERT INTO `muscco_members` VALUES('22','1g2Xg8OetUpCAtJhjNb09mdqfwcGPJPkuguaJ','MU21','2','Ezikiel','Thindwa','ethindwa@muscco.org','0884722153','4','11','1970-01-24','2006-01-23','','2');
INSERT INTO `muscco_members` VALUES('28','un9BIrM1o9hhIPLE8CV2gWDq6Eqs4HK','MUSCCO/01/104','2','Kondwa','Chikanda','chikandakondwani@gmail.com','0991603780','15','3','2023-10-31','2023-11-01','Kondwa_1698674664.jpg','2');
INSERT INTO `muscco_members` VALUES('29','EO8rX6yLTUgmSS4p1Sby1sPVras6xHola','MUSCCO/01/104','1','Andrew','manjale','wezziemhango1@gmail.com','0991603780','15','4','2023-10-24','2023-10-31','Andrew_1698674896.jpg','2');
INSERT INTO `muscco_members` VALUES('30','IlbpDSH8oHDGLSq1VFxo4Ii6vRIdrP','MUSCCO/01/104','1','Andrew','manjale','wezziemhango1@gmail.com','0991603780','4','4','2023-11-02','2023-11-09','Andrew_1698712400.jpg','3');
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
INSERT INTO `notifications` VALUES('1','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','MU21','Your travel advance request has been Approved','Hey, your travel advance request that you posted has been Approved, go to details to check the update','0','2023-09-06 15:02:10');
INSERT INTO `notifications` VALUES('2','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new petty cash requisition(#0001)','Hey Owen, you have received a new petty cash requisition(#0001) that needs your attention','0','2023-09-06 15:24:46');
INSERT INTO `notifications` VALUES('3','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','b5ZUhuHHuug2ZWVwA','You have received a new petty cash requisition(#0001)','Hey Dannie, you have received a new petty cash requisition(#0001) that needs your attention','0','2023-09-06 15:24:46');
INSERT INTO `notifications` VALUES('4','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new leave application(#1) to check','Hey Owen, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-09-06 15:36:47');
INSERT INTO `notifications` VALUES('5','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','b5ZUhuHHuug2ZWVwA','You have received a new leave application(#1) to check','Hey Dannie, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-09-06 15:36:47');
INSERT INTO `notifications` VALUES('6','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new leave application(#2) to check','Hey Owen, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-09-06 15:38:24');
INSERT INTO `notifications` VALUES('7','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','b5ZUhuHHuug2ZWVwA','You have received a new leave application(#2) to check','Hey Dannie, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-09-06 15:38:24');
INSERT INTO `notifications` VALUES('8','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new leave application(#3) to check','Hey Owen, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-09-06 15:41:20');
INSERT INTO `notifications` VALUES('9','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','b5ZUhuHHuug2ZWVwA','You have received a new leave application(#3) to check','Hey Dannie, Please go to &apos;Check Leave&apos; section to check the newly posted leave application','0','2023-09-06 15:41:20');
INSERT INTO `notifications` VALUES('10','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new advance request(#0001)','Hey Owen, you have received a new staff advance request(#0001) that needs your attention.','0','2023-09-06 15:44:06');
INSERT INTO `notifications` VALUES('11','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','b5ZUhuHHuug2ZWVwA','You have received a new advance request(#0001)','Hey Dannie, you have received a new staff advance request(#0001) that needs your attention.','0','2023-09-06 15:44:06');
INSERT INTO `notifications` VALUES('12','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new advance request(#0002)','Hey Owen, you have received a new staff advance request(#0002) that needs your attention.','0','2023-09-06 15:45:14');
INSERT INTO `notifications` VALUES('13','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','b5ZUhuHHuug2ZWVwA','You have received a new advance request(#0002)','Hey Dannie, you have received a new staff advance request(#0002) that needs your attention.','0','2023-09-06 15:45:14');
INSERT INTO `notifications` VALUES('14','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','MU20','Your travel advance request has been Approved','Hey, your travel advance request that you posted has been Approved, go to details to check the update','0','2023-09-06 15:52:18');
INSERT INTO `notifications` VALUES('15','b5ZUhuHHuug2ZWVwA','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','Your petty cash requisition(#0001) has been Approved','Hey, your petty cash requisition(#0001) that you posted has been Approved, go to details to check the update','0','2023-09-06 15:58:49');
INSERT INTO `notifications` VALUES('16','b5ZUhuHHuug2ZWVwA','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new advance request(#0002) to check','Hey Owen, you have received a new staff advance request(#0002) that needs your attention  to verify staff&apos;s previous advances','0','2023-09-06 16:00:07');
INSERT INTO `notifications` VALUES('17','b5ZUhuHHuug2ZWVwA','b5ZUhuHHuug2ZWVwA','You have received a new advance request(#0002) to check','Hey Dannie, you have received a new staff advance request(#0002) that needs your attention  to verify staff&apos;s previous advances','0','2023-09-06 16:00:07');
INSERT INTO `notifications` VALUES('18','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new leave application(#1) to verify','Hey Owen, Please go to &apos;Verify Leave&apos; section to verify the newly posted leave application','0','2023-09-06 18:17:07');
INSERT INTO `notifications` VALUES('19','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','b5ZUhuHHuug2ZWVwA','You have received a new leave application(#1) to verify','Hey Dannie, Please go to &apos;Verify Leave&apos; section to verify the newly posted leave application','0','2023-09-06 18:17:07');
INSERT INTO `notifications` VALUES('20','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','You have received a new leave application(#1) to verify','Hey Enerst, Please go to &apos;Verify Leave&apos; section to verify the newly posted leave application','0','2023-09-06 18:17:07');
INSERT INTO `notifications` VALUES('21','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new advance request(#0003)','Hey Owen, you have received a new staff advance request(#0003) that needs your attention.','0','2023-09-06 18:26:31');
INSERT INTO `notifications` VALUES('22','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','b5ZUhuHHuug2ZWVwA','You have received a new advance request(#0003)','Hey Dannie, you have received a new staff advance request(#0003) that needs your attention.','0','2023-09-06 18:26:31');
INSERT INTO `notifications` VALUES('23','FQqg7qb1YpQVerDuc','mu29','Your travel advance request has been Approved','Hey, your travel advance request that you posted has been Approved, go to details to check the update','0','2023-09-09 13:46:01');
INSERT INTO `notifications` VALUES('24','4GgsYbqqOz4iPFf0Xal2QC5ZEjtA05qCJyLj2w15a1U','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new petty cash requisition(#0002)','Hey Owen, you have received a new petty cash requisition(#0002) that needs your attention','0','2023-09-21 16:14:05');
INSERT INTO `notifications` VALUES('25','4GgsYbqqOz4iPFf0Xal2QC5ZEjtA05qCJyLj2w15a1U','b5ZUhuHHuug2ZWVwA','You have received a new petty cash requisition(#0002)','Hey Dannie, you have received a new petty cash requisition(#0002) that needs your attention','0','2023-09-21 16:14:05');
INSERT INTO `notifications` VALUES('26','4GgsYbqqOz4iPFf0Xal2QC5ZEjtA05qCJyLj2w15a1U','4GgsYbqqOz4iPFf0Xal2QC5ZEjtA05qCJyLj2w15a1U','You have received a new petty cash requisition(#0002)','Hey Tiyamike, you have received a new petty cash requisition(#0002) that needs your attention','0','2023-09-21 16:14:05');
INSERT INTO `notifications` VALUES('27','b5ZUhuHHuug2ZWVwA','4GgsYbqqOz4iPFf0Xal2QC5ZEjtA05qCJyLj2w15a1U','Your petty cash requisition(#0002) has been Approved','Hey, your petty cash requisition(#0002) that you posted has been Approved, go to details to check the update','0','2023-09-21 16:17:59');
INSERT INTO `notifications` VALUES('28','4GgsYbqqOz4iPFf0Xal2QC5ZEjtA05qCJyLj2w15a1U','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new advance request(#0004)','Hey Owen, you have received a new staff advance request(#0004) that needs your attention.','0','2023-09-21 16:20:08');
INSERT INTO `notifications` VALUES('29','4GgsYbqqOz4iPFf0Xal2QC5ZEjtA05qCJyLj2w15a1U','b5ZUhuHHuug2ZWVwA','You have received a new advance request(#0004)','Hey Dannie, you have received a new staff advance request(#0004) that needs your attention.','0','2023-09-21 16:20:08');
INSERT INTO `notifications` VALUES('30','b5ZUhuHHuug2ZWVwA','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','You have received a new advance request(#0004) to check','Hey Owen, you have received a new staff advance request(#0004) that needs your attention  to verify staff&apos;s previous advances','0','2023-09-21 16:21:00');
INSERT INTO `notifications` VALUES('31','b5ZUhuHHuug2ZWVwA','b5ZUhuHHuug2ZWVwA','You have received a new advance request(#0004) to check','Hey Dannie, you have received a new staff advance request(#0004) that needs your attention  to verify staff&apos;s previous advances','0','2023-09-21 16:21:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=latin1;
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
INSERT INTO `permissions_granted` VALUES('54','b5ZUhuHHuug2ZWVwA','3','2023-08-26 15:46:00','1');
INSERT INTO `permissions_granted` VALUES('55','b5ZUhuHHuug2ZWVwA','4','2023-08-26 15:46:03','1');
INSERT INTO `permissions_granted` VALUES('56','b5ZUhuHHuug2ZWVwA','5','2023-08-26 15:46:07','1');
INSERT INTO `permissions_granted` VALUES('57','b5ZUhuHHuug2ZWVwA','6','2023-08-26 15:46:10','1');
INSERT INTO `permissions_granted` VALUES('58','b5ZUhuHHuug2ZWVwA','7','2023-08-26 15:46:13','1');
INSERT INTO `permissions_granted` VALUES('59','b5ZUhuHHuug2ZWVwA','8','2023-08-26 15:46:19','1');
INSERT INTO `permissions_granted` VALUES('60','b5ZUhuHHuug2ZWVwA','9','2023-08-26 15:46:22','1');
INSERT INTO `permissions_granted` VALUES('61','b5ZUhuHHuug2ZWVwA','10','2023-08-26 15:46:26','1');
INSERT INTO `permissions_granted` VALUES('62','b5ZUhuHHuug2ZWVwA','11','2023-08-26 15:46:30','1');
INSERT INTO `permissions_granted` VALUES('63','b5ZUhuHHuug2ZWVwA','12','2023-08-26 15:46:33','1');
INSERT INTO `permissions_granted` VALUES('64','b5ZUhuHHuug2ZWVwA','13','2023-08-26 15:46:38','1');
INSERT INTO `permissions_granted` VALUES('65','b5ZUhuHHuug2ZWVwA','14','2023-08-26 15:46:41','1');
INSERT INTO `permissions_granted` VALUES('66','b5ZUhuHHuug2ZWVwA','15','2023-08-26 15:46:45','1');
INSERT INTO `permissions_granted` VALUES('67','b5ZUhuHHuug2ZWVwA','19','2023-08-26 15:46:50','1');
INSERT INTO `permissions_granted` VALUES('68','b5ZUhuHHuug2ZWVwA','18','2023-08-26 15:46:53','1');
INSERT INTO `permissions_granted` VALUES('69','b5ZUhuHHuug2ZWVwA','17','2023-08-26 15:46:55','1');
INSERT INTO `permissions_granted` VALUES('70','b5ZUhuHHuug2ZWVwA','16','2023-08-26 15:47:02','1');
INSERT INTO `permissions_granted` VALUES('71','IPJnz7k5nDOcQWOpM2DVGjWaVCYe17JZ7GoSLq3MneUSYrkhZn8GBKFp9rD','1','2023-09-02 16:03:20','1');
INSERT INTO `permissions_granted` VALUES('72','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','2','2023-09-06 14:39:21','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('73','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','3','2023-09-06 14:39:30','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('74','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','4','2023-09-06 14:39:33','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('75','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','6','2023-09-06 14:40:11','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('76','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','5','2023-09-06 14:40:11','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('77','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','7','2023-09-06 14:40:12','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('78','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','16','2023-09-06 14:41:22','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('79','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','19','2023-09-06 14:41:22','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('80','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','17','2023-09-06 14:41:22','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('81','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','18','2023-09-06 14:41:22','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('82','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','15','2023-09-06 14:41:22','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('83','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','1','2023-09-06 14:46:27','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('84','1g2Xg8OetUpCAtJhjNb09mdqfwcGPJPkuguaJ','3','2023-09-06 14:56:38','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('85','1g2Xg8OetUpCAtJhjNb09mdqfwcGPJPkuguaJ','4','2023-09-06 14:56:39','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('86','1g2Xg8OetUpCAtJhjNb09mdqfwcGPJPkuguaJ','5','2023-09-06 14:57:29','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('87','1g2Xg8OetUpCAtJhjNb09mdqfwcGPJPkuguaJ','10','2023-09-06 14:57:40','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('88','1g2Xg8OetUpCAtJhjNb09mdqfwcGPJPkuguaJ','17','2023-09-06 14:57:50','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('89','1g2Xg8OetUpCAtJhjNb09mdqfwcGPJPkuguaJ','18','2023-09-06 14:57:54','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('91','1g2Xg8OetUpCAtJhjNb09mdqfwcGPJPkuguaJ','16','2023-09-06 14:58:47','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('92','1g2Xg8OetUpCAtJhjNb09mdqfwcGPJPkuguaJ','19','2023-09-06 14:58:51','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('93','FQqg7qb1YpQVerDuc','1','2023-09-06 17:48:34','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('94','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','8','2023-09-06 18:08:08','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('95','b5ZUhuHHuug2ZWVwA','2','2023-09-09 11:48:56','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('96','b5ZUhuHHuug2ZWVwA','1','2023-09-09 11:49:10','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('97','FQqg7qb1YpQVerDuc','3','2023-09-09 13:16:35','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('98','FQqg7qb1YpQVerDuc','4','2023-09-09 13:16:52','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('99','FQqg7qb1YpQVerDuc','17','2023-09-09 13:17:48','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('100','FQqg7qb1YpQVerDuc','18','2023-09-09 13:18:05','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('101','FQqg7qb1YpQVerDuc','19','2023-09-09 13:18:19','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('102','4GgsYbqqOz4iPFf0Xal2QC5ZEjtA05qCJyLj2w15a1U','3','2023-09-21 15:20:30','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('103','4GgsYbqqOz4iPFf0Xal2QC5ZEjtA05qCJyLj2w15a1U','4','2023-09-21 15:20:50','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('104','4GgsYbqqOz4iPFf0Xal2QC5ZEjtA05qCJyLj2w15a1U','5','2023-09-21 15:21:06','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('105','4GgsYbqqOz4iPFf0Xal2QC5ZEjtA05qCJyLj2w15a1U','9','2023-09-21 15:21:56','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('106','slHOM1yiiueTIq','3','2023-09-21 15:27:21','qDtav8vzqLBj7TbbE7baPbBcKzXj1m092zWq');
INSERT INTO `permissions_granted` VALUES('107','4GgsYbqqOz4iPFf0Xal2QC5ZEjtA05qCJyLj2w15a1U','6','2023-09-21 15:43:14','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('108','4GgsYbqqOz4iPFf0Xal2QC5ZEjtA05qCJyLj2w15a1U','8','2023-09-21 15:43:30','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('109','4GgsYbqqOz4iPFf0Xal2QC5ZEjtA05qCJyLj2w15a1U','19','2023-09-21 15:43:43','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('110','4GgsYbqqOz4iPFf0Xal2QC5ZEjtA05qCJyLj2w15a1U','18','2023-09-21 15:44:04','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('111','4GgsYbqqOz4iPFf0Xal2QC5ZEjtA05qCJyLj2w15a1U','12','2023-09-21 15:44:49','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('112','4GgsYbqqOz4iPFf0Xal2QC5ZEjtA05qCJyLj2w15a1U','15','2023-09-21 15:45:13','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('113','4GgsYbqqOz4iPFf0Xal2QC5ZEjtA05qCJyLj2w15a1U','10','2023-09-21 15:45:34','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `permissions_granted` VALUES('114','EO8rX6yLTUgmSS4p1Sby1sPVras6xHola','16','2023-10-31 01:24:47','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
INSERT INTO `petty_cash_requisitions` VALUES('1','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','1','Meal Allowance','MUSCCO','5000','Lunch allowance for one day','2023-09-06 15:24:46','1','b5ZUhuHHuug2ZWVwA','ok','2023-09-06');
INSERT INTO `petty_cash_requisitions` VALUES('2','4GgsYbqqOz4iPFf0Xal2QC5ZEjtA05qCJyLj2w15a1U','20','Allowance','MUSCCO','5000','Allowance','2023-09-21 16:14:05','1','b5ZUhuHHuug2ZWVwA','Go ahead','2023-09-21');
DROP TABLE IF EXISTS `pillars`;

CREATE TABLE `pillars` (
  `pillar_id` int NOT NULL AUTO_INCREMENT,
  `pillar` varchar(128) NOT NULL,
  PRIMARY KEY (`pillar_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1 COMMENT='Stores Sacco and Muscco Positions';
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
INSERT INTO `positions` VALUES('18','General Manager','2');
INSERT INTO `positions` VALUES('19','Loan Officer','2');
INSERT INTO `positions` VALUES('20','Credit Officer','2');
INSERT INTO `positions` VALUES('21','It officer','2');
INSERT INTO `positions` VALUES('22','Cashier','2');
INSERT INTO `positions` VALUES('23','Teller','2');
INSERT INTO `positions` VALUES('24','Marketing officer','2');
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
DROP TABLE IF EXISTS `public_holidays`;

CREATE TABLE `public_holidays` (
  `holiday_id` int NOT NULL AUTO_INCREMENT,
  `fy_id` int NOT NULL,
  `holiday` varchar(128) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`holiday_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
INSERT INTO `sacco` VALUES('1','Mphuzitsi','2008-11-20','Thyolo','26511115862','alexmakalani@gmail,com','Thyolo Number 1','Dr Febe','0','0','0','0','0','7005','5286','0','1','2023-09-09 11:54:41');
INSERT INTO `sacco` VALUES('2','FINCOOP','2008-02-01','Lilongwe','01756000','fincoop@fincoop.com','Mandala','Chiwalo','0','0','0','0','0','0','0','0','0','2023-09-21 14:57:09');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
INSERT INTO `sacco_members` VALUES('1','kecORjJq1Zq2Ci0PPSrxPFtD','Alex','Makalani','alexmakalani@gmail.com','265999255621','','','1');
INSERT INTO `sacco_members` VALUES('2','qDtav8vzqLBj7TbbE7baPbBcKzXj1m092zWq','Tiyamike','Mkombezi','fincoopsaccom@gmail.com','265888521225','','','2');
INSERT INTO `sacco_members` VALUES('3','slHOM1yiiueTIq','Lingson','Mwaiwala','Lmwaiwala@fincoop.org','0997465873','26','24','2');
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
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;
INSERT INTO `system_users` VALUES('1','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh','chawe','3be9c018356ac60fa7bcbc5a6c5ad6136ef295c9','0','0','1','0','2023-06-15 14:24:56');
INSERT INTO `system_users` VALUES('13','iUqiHBYPEsRdETsK4i9Jt8wpEfUTb00wcpfmcgZt6GWjknK','kondwani','a642a77abd7d4f51bf9226ceaf891fcbb5b299b8','1','3','0','0','2023-06-15 21:46:42');
INSERT INTO `system_users` VALUES('14','knFVGNw1qNp5pwnxUTzmrEmEn527rGybN78fkcO3grf54zg','mayamiko','68c0a3b30cda0c86140e3ba04f8c59c41250d5ff','1','4','0','0','2023-06-16 10:20:08');
INSERT INTO `system_users` VALUES('15','4ADyB2phVNO8LSQ7','hassan','b8b14e12403e31ea873c4fa8a44f8208ace56463','1','5','0','0','2023-06-16 10:24:44');
INSERT INTO `system_users` VALUES('16','zuEtGXUez55DBiuDEqEiEe4q','wendie','a642a77abd7d4f51bf9226ceaf891fcbb5b299b8','1','6','1','0','2023-06-16 16:41:50');
INSERT INTO `system_users` VALUES('17','9N40jLqge07VHqNAXDiXIXTChLVOTBkD4DK3','dsdsdsd','a642a77abd7d4f51bf9226ceaf891fcbb5b299b8','1','7','0','0','2023-06-16 17:27:57');
INSERT INTO `system_users` VALUES('18','Ye70bkc271KbrbspPBhfQ6Z9MgYevbMucFnlotBJ2m6J2k8','wezziemhango@yahoo.com','a642a77abd7d4f51bf9226ceaf891fcbb5b299b8','1','8','0','0','2023-06-16 17:31:28');
INSERT INTO `system_users` VALUES('19','D5CKDuRL1ppWaOWzMf0AjzTe9Cau','1111','a642a77abd7d4f51bf9226ceaf891fcbb5b299b8','1','9','0','0','2023-06-16 17:39:03');
INSERT INTO `system_users` VALUES('21','9CzmRWNrQUJHjaNSYSdd','francis','a642a77abd7d4f51bf9226ceaf891fcbb5b299b8','1','10','1','0','2023-06-19 16:34:06');
INSERT INTO `system_users` VALUES('24','7DKHe8o4B6ET2KaySKCwGgbuc0nXJzhkUz9e5ywHmq9VZcCuMEcsopr','erick','f638e2789006da9bb337fd5689e37a265a70f359','1','11','1','0','2023-06-20 22:24:58');
INSERT INTO `system_users` VALUES('25','tz4TdxysBac4CGJkxFlr0kQpyY3v2odXdJA5GkKRkwGsYTZWvFoqe','jane','b83755992eaa20453a0cd68fc01837c2422a6886','1','12','0','0','2023-06-21 13:55:52');
INSERT INTO `system_users` VALUES('26','NaDWA87mvh2sIzRKLE6','love','a642a77abd7d4f51bf9226ceaf891fcbb5b299b8','1','13','0','0','2023-06-21 14:04:12');
INSERT INTO `system_users` VALUES('27','s7bGYKKZkOZo31xr9c6bpN8WiRSOJjFu5uQHiPWApdvBwmc4Ihl21','andrew','a642a77abd7d4f51bf9226ceaf891fcbb5b299b8','3','11','0','0','2023-06-22 00:04:08');
INSERT INTO `system_users` VALUES('28','tByYPo1Aja8Zdmwn5','steve','356a192b7913b04c54574d18c28d46e6395428ab','3','11','1','0','2023-06-22 00:06:20');
INSERT INTO `system_users` VALUES('29','0X9nrcABNlTT5RwOuwXl4DyD5USXZaDDaRCflIPcc9g2NXgeqtUhO','chawe111','a642a77abd7d4f51bf9226ceaf891fcbb5b299b8','1','13','0','0','2023-07-13 19:22:50');
INSERT INTO `system_users` VALUES('30','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh','chawezie','3f196cfb6c4cffe3002c0495a1bc822521b6aa36','4','999','1','0','2023-07-13 23:17:22');
INSERT INTO `system_users` VALUES('31','7Fh2e6tPqTlJvYckPjEHncoG0h4jI8IRnMQHYaM','lovese','a642a77abd7d4f51bf9226ceaf891fcbb5b299b8','4','999','0','0','2023-07-13 23:23:56');
INSERT INTO `system_users` VALUES('32','6w63XMxKrqxJ5emiViDCC5HrVf9EO7','pauls','f638e2789006da9bb337fd5689e37a265a70f359','3','11','1','0','2023-07-17 16:57:58');
INSERT INTO `system_users` VALUES('34','wTKcHAp53T8FsMdBDwVL3Gbu','hanna','06651252b9be3adf9350c2ee5d2b581df4d6030c','4','999','1','0','2023-08-26 01:29:31');
INSERT INTO `system_users` VALUES('35','cHchMf3kzDBFPFL5PUeLelVXYxhj8X6Qj6G','adminasa','a642a77abd7d4f51bf9226ceaf891fcbb5b299b8','4','999','0','0','2023-08-26 15:29:31');
INSERT INTO `system_users` VALUES('36','b5ZUhuHHuug2ZWVwA','dan.imfa','85e6f1e8037d1ed98146b4576382e635960df241','0','0','1','0','2023-08-26 15:40:30');
INSERT INTO `system_users` VALUES('38','GEnQ4WkkGG1fCAifdZvdq','mnkhoma','8fff7e2dd88a6fe63d278043440671ea05bef30f','2','0','1','0','2023-09-05 12:02:11');
INSERT INTO `system_users` VALUES('39','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','ekuyeya','f7c3bc1d808e04732adf679965ccc34ca7ae3441','2','0','1','0','2023-09-06 14:38:45');
INSERT INTO `system_users` VALUES('40','1g2Xg8OetUpCAtJhjNb09mdqfwcGPJPkuguaJ','ethindwa','f7c3bc1d808e04732adf679965ccc34ca7ae3441','2','0','1','0','2023-09-06 14:42:51');
INSERT INTO `system_users` VALUES('42','kecORjJq1Zq2Ci0PPSrxPFtD','amakalani','2d9521d58de398c316542804e1652c0dbe41c638','1','1','1','0','2023-09-09 11:54:41');
INSERT INTO `system_users` VALUES('43','8FlnRBhzjuGPtguEN1DtBSySwGnoWULVYY4KbOEtJp3LqyF','fnyangulu','2d9521d58de398c316542804e1652c0dbe41c638','4','999','1','0','2023-09-09 12:14:23');
INSERT INTO `system_users` VALUES('44','qDtav8vzqLBj7TbbE7baPbBcKzXj1m092zWq','tmkombezi','c4c9483e6e5077219de94af6c74b53d682bbb652','1','2','1','0','2023-09-21 14:57:09');
INSERT INTO `system_users` VALUES('45','slHOM1yiiueTIq','Lmwaiwala','4632a4e835b2b6f3661ad18b240f370777c355e8','3','2','1','0','2023-09-21 15:14:50');
INSERT INTO `system_users` VALUES('47','B240DsqynvXcvCjDngrua6','kondi1','70efae45b29706bf18ba2de37609b5757071182a','4','999','0','0','2023-10-28 23:10:01');
INSERT INTO `system_users` VALUES('51','un9BIrM1o9hhIPLE8CV2gWDq6Eqs4HK','jfkdfjd','34097a260e377b43800f0131cd043ea3b686ee99','2','0','0','0','2023-10-30 16:04:24');
INSERT INTO `system_users` VALUES('52','EO8rX6yLTUgmSS4p1Sby1sPVras6xHola','chawezi','34097a260e377b43800f0131cd043ea3b686ee99','2','0','1','0','2023-10-30 16:08:17');
INSERT INTO `system_users` VALUES('53','IlbpDSH8oHDGLSq1VFxo4Ii6vRIdrP','nmnmnmnmnd','3898ab839ec8bf2ea56495e6ed2c63b9703c4e87','2','0','0','0','2023-10-31 02:33:20');
DROP TABLE IF EXISTS `ticket_categories`;

CREATE TABLE `ticket_categories` (
  `ticket_category_id` int NOT NULL AUTO_INCREMENT,
  `ticket_category` varchar(1028) NOT NULL,
  PRIMARY KEY (`ticket_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
INSERT INTO `ticket_categories` VALUES('1','General');
INSERT INTO `ticket_categories` VALUES('2','Hardware');
INSERT INTO `ticket_categories` VALUES('3','Software');
DROP TABLE IF EXISTS `ticket_response`;

CREATE TABLE `ticket_response` (
  `response_id` int NOT NULL AUTO_INCREMENT,
  `ticket_id` int NOT NULL,
  `member_id` varchar(60) NOT NULL,
  `response` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`response_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
INSERT INTO `ticket_response` VALUES('1','2','FQqg7qb1YpQVerDuc','The ticket is under scrutiny and work has started already','2023-09-09 06:41:24');
INSERT INTO `ticket_response` VALUES('2','3','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh','Please this has been sorted u can close the ticket','2023-09-21 08:57:43');
INSERT INTO `ticket_response` VALUES('3','3','4GgsYbqqOz4iPFf0Xal2QC5ZEjtA05qCJyLj2w15a1U','Alright Thank you','2023-09-21 08:58:15');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
INSERT INTO `tickets` VALUES('1','FQqg7qb1YpQVerDuc','Laptop Crash','I have a crashed laptop','3','2','4','','0','','2023-09-09 06:38:23','2023-09-09 13:36:52','thanks sorted','1','0','0');
INSERT INTO `tickets` VALUES('2','FQqg7qb1YpQVerDuc','Printer','I cant print from finance printer','2','3','2','','0','','2023-09-09 06:42:07','2023-09-09 13:40:23','thanks','1','0','0');
INSERT INTO `tickets` VALUES('3','4GgsYbqqOz4iPFf0Xal2QC5ZEjtA05qCJyLj2w15a1U','System url unreachable','Assist with connecting to the CBS','3','4','1','','0','','2023-09-21 08:59:11','2023-09-21 15:55:24','Sorted','1','0','91');
INSERT INTO `tickets` VALUES('4','qDtav8vzqLBj7TbbE7baPbBcKzXj1m092zWq','laptop Crash','Laptop crashed cant access any data','2','2','1','','0','','','2023-09-21 16:03:01','','0','2','0');
DROP TABLE IF EXISTS `travel_advance_liquidations`;

CREATE TABLE `travel_advance_liquidations` (
  `liquidation_id` int NOT NULL AUTO_INCREMENT,
  `travel_advance_id` varchar(80) NOT NULL,
  `liq_logistics` int NOT NULL,
  `liq_nights` int NOT NULL,
  `liq_mileage` double NOT NULL,
  `liq_fuel` double NOT NULL,
  `liq_day_meal` double NOT NULL,
  `liq_other` varchar(1028) DEFAULT NULL,
  `liq_other_amount` double NOT NULL DEFAULT '0',
  `liq_receipts` varchar(128) NOT NULL,
  `total_liquidation` double NOT NULL,
  `balance_overage` double NOT NULL,
  `liq_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `liq_status` int NOT NULL DEFAULT '0',
  `liq_approved_by` varchar(60) DEFAULT NULL,
  `liq_date_approved` date DEFAULT NULL,
  `liq_approval_remarks` text,
  PRIMARY KEY (`liquidation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
  `mileage` double DEFAULT '0',
  `total_fuel` double DEFAULT '0',
  `fuel` varchar(11) DEFAULT NULL,
  `fuel_price` double DEFAULT '0',
  `total_budget` double DEFAULT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `checked_by` varchar(60) DEFAULT NULL,
  `date_checked` date DEFAULT NULL,
  `checker_note` text,
  `approved_by` varchar(60) DEFAULT NULL,
  `date_approved` date DEFAULT NULL,
  `approver_note` text,
  `request_status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`advance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
INSERT INTO `travel_advance_request` VALUES('1','1694004626PBrbYT5jZqMksDL466s9pNZguWzm','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','3','Verification','1','4','15000','10000','700','134400','1','1920','204400','2023-09-06 14:51:22','','','','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','2023-09-06','okay','2');
INSERT INTO `travel_advance_request` VALUES('2','16940052078iwlRNEzJen28aSYWDXBTrwCfXM5INP8','1g2Xg8OetUpCAtJhjNb09mdqfwcGPJPkuguaJ','4','test','2','10','35000','10000','1000','174600','2','1746','534600','2023-09-06 15:00:41','','','','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','2023-09-06','Okay','2');
INSERT INTO `travel_advance_request` VALUES('3','1694259880v28ya65dNJg12SgTrda6BJS','FQqg7qb1YpQVerDuc','2','Setting up banner','2','5','30000','8000','300','52380','2','1746','210380','2023-09-09 13:45:14','','','','FQqg7qb1YpQVerDuc','2023-09-09','ok','2');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
INSERT INTO `vehicle_requests` VALUES('1','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','2023-09-06 15:26:55','EK','Meeting in BT','2023-09-08','2023-09-09','BT','LL','','','','','','','','','','','','','','','','0','','','','','','','','','','','');
INSERT INTO `vehicle_requests` VALUES('2','2RJfGo93E8lPHnW3mMEYbaHbWQzLnZ6iiV0inKzJ','2023-09-06 17:37:34','dan','dadadadada','2023-09-07','2023-09-14','BT','LL','','','','','','','','','','','','','','','','0','','','','','','','','','','','');


COMMIT;
-- database backup - 2023-11-02 13:20:21
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
DROP TABLE IF EXISTS `db_backups`;

CREATE TABLE `db_backups` (
  `backup_id` int NOT NULL AUTO_INCREMENT,
  `backedup_by` varchar(60) NOT NULL,
  `file_title` varchar(128) NOT NULL,
  `file_name` varchar(64) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`backup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
INSERT INTO `db_backups` VALUES('1','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh','2023','../db/muscco_backup_20231102_131835.sql','2023-11-02 15:18:36');
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
DROP TABLE IF EXISTS `discussion_replies`;

CREATE TABLE `discussion_replies` (
  `reply_id` int NOT NULL AUTO_INCREMENT,
  `topic_id` int NOT NULL,
  `reply` text NOT NULL,
  `replied_by` varchar(60) NOT NULL,
  `date_replied` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `member_of` int NOT NULL,
  PRIMARY KEY (`reply_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
DROP TABLE IF EXISTS `discussions`;

CREATE TABLE `discussions` (
  `topic_id` int NOT NULL AUTO_INCREMENT,
  `topic` text NOT NULL,
  `description` text NOT NULL,
  `access_rights` int NOT NULL DEFAULT '0',
  `posted_by` varchar(60) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`topic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
DROP TABLE IF EXISTS `document_categories`;

CREATE TABLE `document_categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(1028) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
INSERT INTO `document_categories` VALUES('1','Loan Application Forms');
INSERT INTO `document_categories` VALUES('2','Leave Application Forms');
INSERT INTO `document_categories` VALUES('8','New Form');
INSERT INTO `document_categories` VALUES('9','Newsletters');
INSERT INTO `document_categories` VALUES('10','Statistics');
INSERT INTO `document_categories` VALUES('11','SACCO Bylaws');
INSERT INTO `document_categories` VALUES('12','Vehicle Requests');
INSERT INTO `document_categories` VALUES('13','General');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
INSERT INTO `documents` VALUES('1','Leave Application form 2023','','1266134581_1698907360.pdf','2','0','0','2023-11-02 08:42:40','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `documents` VALUES('2','Systems Engineers','','340463320_1698928472.pdf','8','0','0','2023-11-02 14:34:32','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `documents` VALUES('3','2023 July Newsletter','','1660598257_1698928556.pdf','9','2','0','2023-11-02 14:35:56','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
DROP TABLE IF EXISTS `faqs`;

CREATE TABLE `faqs` (
  `faq_id` int NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `posted_by` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`faq_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
INSERT INTO `faqs` VALUES('1','What is an Admin Panel?','Admin Dashboard is the backend interface of a website or an application that helps to manage the website&apos;s overall content and settings. It is widely used by the site owners to keep track of their website, make changes to their content, and more.','2023-11-02 08:09:53','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
INSERT INTO `faqs` VALUES('2','What does the Admin Panel Include?','Admin dashboard template should include user &amp; SEO friendly design with a variety of components and application designs to help create your own web application with ease. This could include customization options, technical support and about 6 months of future updates.','2023-11-02 08:14:02','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh');
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
  `profile` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`muscco_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
INSERT INTO `muscco_members` VALUES('1','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh','MUSCCO/01/104q','2','James','Mhango','wezmhango@hotmail.com','0993189240','1','1','1988-01-01','2011-01-01','James_1698757089.jpg','2','A recent business economics graduate with a 2:1 honours degree from the University of X, looking to secure a Graduate Commercial Analyst position to use and further develop my analytical skills and knowledge in a practical and fast-paced environment. My career goal is to assume a role which allows me to take responsibility for the analysis and interpretation of commercial data for a well-respected and market-leading leading company.');
INSERT INTO `muscco_members` VALUES('16','2','1','0','hhhhah','heheheheh','heheh@gmail.com','099799391','4','3','2023-08-16','2023-08-01','','2','');
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;
INSERT INTO `system_users` VALUES('1','sac8zAqp78dA4SMUpI9kNzqiPRoh4tQuAahBfdMh','chawe','3be9c018356ac60fa7bcbc5a6c5ad6136ef295c9','0','0','1','0','2023-06-15 14:24:56');
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


COMMIT;
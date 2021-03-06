CREATE TABLE IF NOT EXISTS `Student` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` enum('男','女') NOT NULL,
  `major`  varchar(255) NOT NULL,
  `grade` varchar(30) NOT NULL,
  `class` varchar(30) NOT NULL,
  `status` enum('default','deleted') NOT NULL DEFAULT 'default',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `Activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `place` varchar(255) NOT NULL,
  `staff` varchar(255) NOT NULL,
  `status` enum('default','closed','deleted') NOT NULL DEFAULT 'default',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `Activity_Student` (
  `activity_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `note` varchar(255) NOT NULL DEFAULT '',
  `status` enum('default','deleted') NOT NULL DEFAULT 'default',
  PRIMARY KEY (`activity_id`,`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `Account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('default','deleted') NOT NULL DEFAULT 'default',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `Account_Activity` (
  `account_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `status` enum('default','deleted') NOT NULL DEFAULT 'default',
  PRIMARY KEY (`account_id`,`activity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `Volume` (
  `date_time` date NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`date_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
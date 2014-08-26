CREATE TABLE IF NOT EXISTS `Student` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `major` enum('Mathematics and Applied Mathematics',
               'Information Management and Information System',
               'Computer Science and Technology',
               'Information Security') NOT NULL,
  `grade` int(11) NOT NULL,
  `class` int(11) NOT NULL,
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
  `status` enum('default','deleted') NOT NULL DEFAULT 'default',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `Activity_Student` (
  `activityid` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `status` enum('default','deleted') NOT NULL DEFAULT 'default',
  PRIMARY KEY (`activityid`,`studentid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `Account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('default','deleted') NOT NULL DEFAULT 'default',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `Account_Activity` (
  `username` varchar(255) NOT NULL,
  `activityid` int(11) NOT NULL,
  `status` enum('default','deleted') NOT NULL DEFAULT 'default',
  PRIMARY KEY (`username`,`activityid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
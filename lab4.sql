use pengbin_db;

set foreign_key_checks=0;

DROP TABLE IF EXISTS `T_USER`;
CREATE TABLE IF NOT EXISTS `T_USER` (
  `User_ID` int(10) NOT NULL,
  `Username` varchar(10) NOT NULL,
  `Fullname` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `Class_level` int(1) NOT NULL,
  `ProjectID` int(10) NOT NULL,
  `Employee_ID` int(10) NOT NULL,
  PRIMARY KEY (User_ID),
  UNIQUE (Username),
  UNIQUE (ProjectID)
) ENGINE=InnoDB;

INSERT INTO `T_USER` (`User_ID`, `Username`, `Fullname`, `password`, `Class_level`,`ProjectID`,`Employee_ID`) VALUES
(111, "pb", "pengbin", "123124", 1, 111, 1);
INSERT INTO `T_USER` (`User_ID`, `Username`, `Fullname`, `password`, `Class_level`,`ProjectID`,`Employee_ID`) VALUES
(112, "aa", "helelo", "123qwedf", 2, 222, 2);
INSERT INTO `T_USER` (`User_ID`, `Username`, `Fullname`, `password`, `Class_level`,`ProjectID`,`Employee_ID`) VALUES
(113, "bb", "hihihi", "aaaaaaaa", 1, 333, 3);
INSERT INTO `T_USER` (`User_ID`, `Username`, `Fullname`, `password`, `Class_level`,`ProjectID`,`Employee_ID`) VALUES
(114, "cc", "king", "123123", 3, 444, 4);

DROP TABLE IF EXISTS `T_USER_CLASS`;
CREATE TABLE IF NOT EXISTS `T_USER_CLASS` (
  `Class_level` int(1) NOT NULL,
  `Username` varchar(10) NOT NULL,
  `Description` varchar(30) NOT NULL,
  `Hourly_cost` int(3) NOT NULL,
  `Charge_through_rate` int(3) NOT NULL,
  `Active` varchar(10) NOT NULL,
  UNIQUE (Class_level),
  FOREIGN KEY (Username) REFERENCES T_USER(Username)
) ENGINE=InnoDB;

INSERT INTO `T_USER_CLASS` (`Class_level`, `Username`, `Description`, `Hourly_cost`, `Charge_through_rate`, `Active`) VALUES
(1, "pb", "hello world aaaaaaaa", 10, 3, "yes");
INSERT INTO `T_USER_CLASS` (`Class_level`, `Username`, `Description`, `Hourly_cost`, `Charge_through_rate`, `Active`) VALUES
(2, "aa", "hello world aaaaaaaa", 20, 3, "no");
INSERT INTO `T_USER_CLASS` (`Class_level`, `Username`, `Description`, `Hourly_cost`, `Charge_through_rate`, `Active`) VALUES
(3, "bb", "hello world aaaaaaaa", 30, 2, "yes");

DROP TABLE IF EXISTS `T_ADMIN`;
CREATE TABLE IF NOT EXISTS `T_ADMIN` (
  `User_ID` int(10) NOT NULL,
  `Username` varchar(10) NOT NULL,
  `Fullname` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `Class_level` int(1) NOT NULL,
  `ProjectID` int(10) NOT NULL,
  `Employee_ID` int(10) NOT NULL,
  PRIMARY KEY (User_ID),
  UNIQUE (Username),
  UNIQUE (ProjectID)
) ENGINE=InnoDB;

INSERT INTO `T_ADMIN` (`User_ID`, `Username`, `Fullname`, `password`, `Class_level`,`ProjectID`,`Employee_ID`) VALUES
(111, "pb", "pengbin", "123124", 1, 111, 1);
INSERT INTO `T_ADMIN` (`User_ID`, `Username`, `Fullname`, `password`, `Class_level`,`ProjectID`,`Employee_ID`) VALUES
(112, "aa", "helelo", "123qwedf", 2, 222, 2);
INSERT INTO `T_ADMIN` (`User_ID`, `Username`, `Fullname`, `password`, `Class_level`,`ProjectID`,`Employee_ID`) VALUES
(113, "bb", "hihihi", "aaaaaaaa", 1, 333, 3);
INSERT INTO `T_ADMIN` (`User_ID`, `Username`, `Fullname`, `password`, `Class_level`,`ProjectID`,`Employee_ID`) VALUES
(114, "cc", "king", "123123", 3, 444, 4);


DROP TABLE IF EXISTS `T_PROJECT`;
CREATE TABLE IF NOT EXISTS `T_PROJECT` (
  `ProjectName` varchar(20) NOT NULL,
  `ProjectID` int(1) NOT NULL,
  `Mantis_ID` int(3) NOT NULL,
  `CustomerName` varchar(10) NOT NULL,
  `ShortDiscription` varchar(20) NOT NULL,
  `LongDiscription` varchar(40) NOT NULL,
  `LocalProRate` varchar(10) NOT NULL,
  `GlobalMaterialMarkup` varchar(10) NOT NULL,
  `Active` varchar(10) NOT NULL,
  `Status` varchar(10) NOT NULL,
  `Revision_letter` varchar(10) NOT NULL,
  `Dajac_sales_acc_name` varchar(10) NOT NULL,
  UNIQUE (Mantis_ID),
  UNIQUE (CustomerName),
  UNIQUE (GlobalMaterialMarkup),
  FOREIGN KEY (ProjectID) REFERENCES T_USER(ProjectID)
) ENGINE=InnoDB;

INSERT INTO `T_PROJECT` (`ProjectName`,`ProjectID`,`Mantis_ID`,`CustomerName`,`ShortDiscription`,`LongDiscription`,`LocalProRate`,`GlobalMaterialMarkup`,`Active`,`Status`,`Revision_letter`,
  `Dajac_sales_acc_name`) VALUES ("aaaa", 111, 1, "vv", "hello a", "ddddddd", "10", "dd", "yes", "ok", "asdasdsad", "pb");

INSERT INTO `T_PROJECT` (`ProjectName`,`ProjectID`,`Mantis_ID`,`CustomerName`,`ShortDiscription`,`LongDiscription`,`LocalProRate`,`GlobalMaterialMarkup`,`Active`,`Status`,`Revision_letter`,
  `Dajac_sales_acc_name`) VALUES ("bbbb", 222, 2, "vvqw", "hello ea", "ddddddd", "10", "ddd", "no", "ok", "asdasdsad", "pb1");

INSERT INTO `T_PROJECT` (`ProjectName`,`ProjectID`,`Mantis_ID`,`CustomerName`,`ShortDiscription`,`LongDiscription`,`LocalProRate`,`GlobalMaterialMarkup`,`Active`,`Status`,`Revision_letter`,
  `Dajac_sales_acc_name`) VALUES ("cccc", 333, 3, "vvasd", "helleo a", "ddddddd", "10", "dddd", "yes", "ok", "asdasdsad", "pb2");

INSERT INTO `T_PROJECT` (`ProjectName`,`ProjectID`,`Mantis_ID`,`CustomerName`,`ShortDiscription`,`LongDiscription`,`LocalProRate`,`GlobalMaterialMarkup`,`Active`,`Status`,`Revision_letter`,
  `Dajac_sales_acc_name`) VALUES ("dddd", 444, 4, "vvg", "herllo a", "ddddddd", "10", "ddddd", "yes", "ok", "asdasdsad", "pb3");


DROP TABLE IF EXISTS `T_PRO_LEVEL`;
CREATE TABLE IF NOT EXISTS `T_PRO_LEVEL` (
  `Percent_discount` int(3) NOT NULL,
  `value_discount` varchar(10) NOT NULL,
  `GlobalMaterialMarkup` varchar(5) NOT NULL,
  `sale_comm` varchar(10) NOT NULL,
  FOREIGN KEY (GlobalMaterialMarkup) REFERENCES T_PROJECT(GlobalMaterialMarkup)
) ENGINE=InnoDB;

INSERT INTO `T_PRO_LEVEL` (`Percent_discount` ,`value_discount` ,`GlobalMaterialMarkup`,`sale_comm`) VALUES (20, "aa", "ddd", "qweqwr");
INSERT INTO `T_PRO_LEVEL` (`Percent_discount` ,`value_discount` ,`GlobalMaterialMarkup`,`sale_comm`) VALUES (30, "saa", "dddd", "qwesqwr");
INSERT INTO `T_PRO_LEVEL` (`Percent_discount` ,`value_discount` ,`GlobalMaterialMarkup`,`sale_comm`) VALUES (10, "asa", "ddddd", "qweqssswr");

DROP TABLE IF EXISTS `T_CUSTOMER`;
CREATE TABLE IF NOT EXISTS `T_CUSTOMER` (
  `CustomerName` varchar(10) NOT NULL,
  `CustomerAddress` varchar(10) NOT NULL,
  `Notes` varchar(30) NOT NULL,
  `Active` varchar(10) NOT NULL,
  FOREIGN KEY (CustomerName) REFERENCES T_PROJECT(CustomerName)
) ENGINE=InnoDB;

INSERT INTO `T_CUSTOMER` (`CustomerName`,`CustomerAddress` ,`Notes` ,`Active`) VALUES ("hk", "aaa", "dddqwfdd", "yes");
INSERT INTO `T_CUSTOMER` (`CustomerName` ,`CustomerAddress`,`Notes` ,`Active`) VALUES ("ald", "bbb","xzxcasfasdasd", "no");
INSERT INTO `T_CUSTOMER` (`CustomerName` ,`CustomerAddress`,`Notes` ,`Active`) VALUES ("olkaa","ccc", "dddddsdfsdf", "yes");

DROP TABLE IF EXISTS `T_PROJECT_STATISTICS`;
CREATE TABLE IF NOT EXISTS `T_PROJECT_STATISTICS` (
  `ProjectID` int(1) NOT NULL,
  `Raw_Profit` int(3) NOT NULL,
  `Total_Labor_hour` int(3) NOT NULL,
  `Total_Labor_cost` int(5) NOT NULL,
  `Total_Labor_value_quote` int(3) NOT NULL,
  `Total_material_cost` int(3) NOT NULL,
  `Total_material_value_quote` int(3) NOT NULL,
  `Hour_used_pertask` int(3) NOT NULL,
  `Hour_remain_pertask` int(3) NOT NULL,
  `Hour_used_for_entireproject` int(3) NOT NULL,
  `Hour_remain_for_entireproject` int(3) NOT NULL,
  FOREIGN KEY (ProjectID) REFERENCES T_PROJECT(ProjectID)
) ENGINE=InnoDB;

INSERT INTO `T_PROJECT_STATISTICS` (`ProjectID` ,`Raw_Profit` ,`Total_Labor_hour`, `Total_Labor_cost`,
  `Total_Labor_value_quote`,
  `Total_material_cost` ,
  `Total_material_value_quote` ,
  `Hour_used_pertask` ,
  `Hour_remain_pertask` ,
  `Hour_used_for_entireproject` ,
  `Hour_remain_for_entireproject` ) VALUES (111, 1,1,1,1,1,1,1,1,1,1);
INSERT INTO `T_PROJECT_STATISTICS` (`ProjectID` ,`Raw_Profit` ,`Total_Labor_hour`, `Total_Labor_cost`,
  `Total_Labor_value_quote`,
  `Total_material_cost` ,
  `Total_material_value_quote` ,
  `Hour_used_pertask` ,
  `Hour_remain_pertask` ,
  `Hour_used_for_entireproject` ,
  `Hour_remain_for_entireproject` ) VALUES (222, 1,1,1,1,1,1,1,1,1,1);
INSERT INTO `T_PROJECT_STATISTICS` (`ProjectID` ,`Raw_Profit` ,`Total_Labor_hour`, `Total_Labor_cost`,
  `Total_Labor_value_quote`,
  `Total_material_cost` ,
  `Total_material_value_quote` ,
  `Hour_used_pertask` ,
  `Hour_remain_pertask` ,
  `Hour_used_for_entireproject` ,
  `Hour_remain_for_entireproject` ) VALUES (333, 1,1,1,1,1,1,1,1,1,1);

DROP TABLE IF EXISTS `T_TASK`;
CREATE TABLE IF NOT EXISTS `T_TASK` (
  `Mantis_ID` int(3) NOT NULL,
  `TaskName` varchar(10) NOT NULL,
  `Status` varchar(30) NOT NULL,
  `Subtask_ID` int(10) NOT NULL,
  `Flag_reason` varchar(30) NOT NULL,
  `Active` tinyint(1) NOT NULL,
  PRIMARY KEY (Subtask_ID),
  FOREIGN KEY (Mantis_ID) REFERENCES T_PROJECT(Mantis_ID)
) ENGINE=InnoDB;

INSERT INTO `T_TASK` (`Mantis_ID`,`TaskName`, `Status`,`Subtask_ID`,`Flag_reason`,`Active`) VALUES (1, "asd","10", 10, "aaa", 0);
INSERT INTO `T_TASK` (`Mantis_ID`,`TaskName`, `Status`,`Subtask_ID`,`Flag_reason`,`Active`) VALUES (2, "asd","10", 11, "bbb", 1);
INSERT INTO `T_TASK` (`Mantis_ID`,`TaskName`, `Status`,`Subtask_ID`,`Flag_reason`,`Active`) VALUES (3, "asd","10", 12, "ccc", 0);

DROP TABLE IF EXISTS `T_SUBTASK`;
CREATE TABLE IF NOT EXISTS `T_SUBTASK` (
  `Subtask_ID` int(10) NOT NULL,
  `SubtaskName` varchar(10) NOT NULL,
  `Material_ID` int(10) NOT NULL,
  `Active` varchar(5) NOT NULL,
  `Status` varchar(30) NOT NULL,
  `reason` varchar(10) NOT NULL,
  UNIQUE (Material_ID),
  FOREIGN KEY (Subtask_ID) REFERENCES T_TASK(Subtask_ID)
) ENGINE=InnoDB;

INSERT INTO `T_SUBTASK` (`Subtask_ID`,`SubtaskName`,`Material_ID`, `Active`,`Status`,`reason`) VALUES (125, "asd",10, "yes", "10", "12");
INSERT INTO `T_SUBTASK` (`Subtask_ID`,`SubtaskName`,`Material_ID`, `Active`,`Status`,`reason`) VALUES (127, "asd",11, "yes", "10", "12");
INSERT INTO `T_SUBTASK` (`Subtask_ID`,`SubtaskName`,`Material_ID`, `Active`,`Status`,`reason`) VALUES (128, "asd",12, "yes", "10", "12");

DROP TABLE IF EXISTS `T_MATERIAL`;
CREATE TABLE IF NOT EXISTS `T_MATERIAL` (
  `Material_ID` int(10) NOT NULL,
  `cost` int(10) NOT NULL,
  `Quantity` varchar(5) NOT NULL,
  `Extended_Cost` varchar(30) NOT NULL,
  `MaterialMarkup` varchar(10) NOT NULL,
  `Final_cost` int(10) NOT NULL,
  `Vendor` varchar(10) NOT NULL,
  `Vender_part_number` varchar(10) NOT NULL,
  `Manufacter` varchar(10) NOT NULL,
  `Manufacter_part_number` varchar(10) NOT NULL,
  `Note` varchar(40) NOT NULL,
  FOREIGN KEY (Material_ID) REFERENCES T_SUBTASK(Material_ID)
) ENGINE=InnoDB;

INSERT INTO `T_MATERIAL` (`Material_ID` ,
  `cost`,
  `Quantity`,
  `Extended_Cost`,
  `MaterialMarkup`,
  `Final_cost`,
  `Vendor` ,
  `Vender_part_number`,
  `Manufacter`,
  `Manufacter_part_number`,
  `Note`) VALUES (10, 12, "10", "10", "12", 11, "222", "asd", "asd", "asdwf", "wer");

INSERT INTO `T_MATERIAL` (`Material_ID` ,
  `cost`,
  `Quantity`,
  `Extended_Cost`,
  `MaterialMarkup`,
  `Final_cost`,
  `Vendor` ,
  `Vender_part_number`,
  `Manufacter`,
  `Manufacter_part_number`,
  `Note`) VALUES (11, 12, "10", "10", "12", 11, "222", "asd", "asd", "asdwf", "wer");
INSERT INTO `T_MATERIAL` (`Material_ID` ,
  `cost`,
  `Quantity`,
  `Extended_Cost`,
  `MaterialMarkup`,
  `Final_cost`,
  `Vendor` ,
  `Vender_part_number`,
  `Manufacter`,
  `Manufacter_part_number`,
  `Note`) VALUES (12, 12, "10", "10", "12", 11, "222", "asd", "asd", "asdwf", "wer");

set foreign_key_checks=1;











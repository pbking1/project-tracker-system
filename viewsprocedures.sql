

-- Drop existing tables.  Executing with EXECUTE IMMEDIATE to suppress error messages if objects does not exist.

BEGIN EXECUTE IMMEDIATE 'DROP TABLE T_ADMIN'; EXCEPTION WHEN OTHERS THEN NULL; END;
BEGIN EXECUTE IMMEDIATE 'DROP TABLE T_CUSTOMER'; EXCEPTION WHEN OTHERS THEN NULL; END;
BEGIN EXECUTE IMMEDIATE 'DROP TABLE T_MATERIAL'; EXCEPTION WHEN OTHERS THEN NULL; END;
BEGIN EXECUTE IMMEDIATE 'DROP TABLE T_PROJECT'; EXCEPTION WHEN OTHERS THEN NULL; END;
BEGIN EXECUTE IMMEDIATE 'DROP TABLE T_PROJECT_STATISTICS'; EXCEPTION WHEN OTHERS THEN NULL; END;
BEGIN EXECUTE IMMEDIATE 'DROP TABLE T_PRO_LEVEL'; EXCEPTION WHEN OTHERS THEN NULL; END;
BEGIN EXECUTE IMMEDIATE 'DROP TYPE T_TASK'; EXCEPTION WHEN OTHERS THEN NULL; END;
BEGIN EXECUTE IMMEDIATE 'DROP TYPE T_USER'; EXCEPTION WHEN OTHERS THEN NULL; END;
BEGIN EXECUTE IMMEDIATE 'DROP TABLE T_USER_CLASS'; EXCEPTION WHEN OTHERS THEN NULL; END;

----------------INSERT---------------------------------------------------------
INSERT INTO T_ADMIN VALUES ('0145','mtounkar','Safa Toun','safa123','2','04154mst','145');
INSERT INTO T_ADMIN VALUES ('0146','pengbin','Alex Bin','alex12','1','4158ab','451');
INSERT INTO T_ADMIN VALUES ('0147','francoise','Francoise R','franci852','2','894fr','317');
INSERT INTO T_USER_CLASS VALUES ('4','MT','Francoise','20','50','YES');

--------UPDATE table-------
Update T_USER_CLASS
set Description = 'Project Manager'
where Class_level= 2;

Update T_USER_CLASS
set Description = 'Multiple Role'
where Class_level= 3;


----------CREATE VIEWS-----
CREATE VIEW PROJECTS_USERS AS

SELECT fullname, projectname
from T_USER, T_PROJECT 
WHERE T_USER.ProjectID= T_PROJECT.ProjectID
------------------------
CREATE VIEW EMPLOYEE_PRIVILEGES AS 
---------------------
select fullname, Description
from T_ADMIN, T_USER_CLASS
WHERE T_ADMIN.Class_level = T_USER_CLASS.Class_level
----------------------
CREATE VIEW ACTIVE_PROJECTS AS 

SELECT ProjectName, CustomerName
from T_PROJECT
where Active = 'yes'; 
---------------------------------
CREATE VIEW NONACTIVE_PROJECTS AS 

SELECT ProjectName, CustomerName
from T_PROJECT
where Active = 'no'; 

------------------------------
CREATE VIEW OVERBUDGET AS

SELECT ProjectID
from T_PROJECT_STATISTICS
where Total_Labor_cost > Total_Labor_value_quote

---------------------------------
CREATE VIEW PROFITABLE_PROJECTS AS 
SELECT DISTINCT CustomerName, ProjectName, Raw_Profit
FROM T_PROJECT, T_PROJECT_STATISTICS
WHERE T_PROJECT_STATISTICS.ProjectID = T_PROJECT.projectID
AND Raw_Profit != 0
------------------------------------
CREATE VIEW MOST_TIME_WORKED AS 

SELECT MAX(TOTAL_LABOR_HOUR) AS MOST_TIME_WORKED
FROM T_PROJECT_STATISTICS
-----------------------------------------
CREATE VIEW AVERAGE_TOT AS 

ELECT AVG(Hour_used_pertask) AS AVERAGE_TOT
from T_PROJECT_STATISTICS
-----------------------------------------------

-----------CREATE PROCEDURES------------
------COUNT ADMINS------

Drop procedure if exists SP_COUNT_ADMIN;
Create Procedure SP_COUNT_ADMIN(IN Username VARCHAR(10), IN password VARCHAR(10), OUT count INT)
Select count(*) into count from T_ADMIN where username = uname and password = pwd;

-------INSERT NEW CUSTOMER--------------
Drop procedure if exists SP_INSERT_CUSTOMER;
Create Procedure SP_INSERT_CUSTOMER(IN CustomerName VARCHAR(10), IN CustomerAddress VARCHAR(10), IN Notes varCHAR(30), IN Active VARCHAR(10))
insert into T_CUSTOMER values (CustomerName,CustomerAddress, Notes, Active);

-----------insert new class-------------
Drop procedure if exists SP_INSERT_CLASS;
Create Procedure SP_INSERT_CLASS(IN Class_level int(1), IN Username VARCHAR(10), IN Desription varCHAR(30), IN Hourly_cost int(3), IN Charge_through_rate int(3), IN Active varchar(10))
insert into T_USER_CLASS values (ClassName,Description, HourlyCost, ChargeThroughRate, Active);

-----------insert new user-------------
Drop procedure if exists SP_INSERT_USER;
Create Procedure SP_INSERT_USER(IN Username VARCHAR(10), IN FullName varCHAR(10), IN password VARCHAR(10), IN EmployeeID int(10))
insert into T_USER values (FullName,UserName, Password, EmployeeID);

----------------insert new project------------------

Drop procedure if exists SP_INSERT_PROJECT;
Create Procedure SP_INSERT_PROJECT(IN ProjectName VARCHAR(20), IN ProjectID varCHAR(10), IN Revision_Letter VARCHAR(10), IN Mantis_ID int(3), IN CustomerName varchar(10), IN )
insert into T_PROJECT values (ProjectName,ProjectID, RevisionLetter, MantisID, Customer, );





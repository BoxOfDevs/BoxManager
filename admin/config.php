<?php
/**********************************************************************
 *Contains all the basic Configuration
 *dbHost = Host of your MySQL DataBase Server... Usually it is localhost
 *dbUser = Username of your DataBase
 *dbPass = Password of your DataBase
 *dbName = Name of your DataBase
 **********************************************************************/
$dbHost = 'localhost';
$dbUser = 'Data Base User Name';
$dbPass = 'Data Base Password';
$dbName = 'Data Base Name';
$dbC = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName)
        or die('Error Connecting to MySQL DataBase');
?>

/*************************************
* Run this MySQL query:
*
*CREATE TABLE login_admin
*(
*id INT NOT NULL AUTO_INCREMENT,
*user_name VARCHAR(100),
*user_pass VARCHAR(200),
PRIMARY KEY (id)
*)
*
* Then run this query: (Replace username and password, run this query again to add more users. DO NOT PUT THE '*' IN THE QUERY.
*
*INSERT INTO login_admin (user_name, user_pass)
*VALUES
*(
*‘Username’, SHA(‘Password’)
*)
*
*************************************/

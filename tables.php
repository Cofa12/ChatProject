<?php 
include_once('connection.php');

// Create the table of 
// $table = "SHOW TABLES LIKE '%users%'";
$table = "SELECT * FROM INFORMATION_SCHEMA.TABLES
WHERE TABLE_NAME = 'users'";
$re=$con->query($table)->fetch_object();

if (!((array)$re)['CREATE_TIME']){
     $sql = 'CREATE table users (id INT PRIMARY KEY AUTO_INCREMENT, uName varchar(255),u_image varchar(255),phone varchar(255))';
     $con->query($sql);
}

// ============================

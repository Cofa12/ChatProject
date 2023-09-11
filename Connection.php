<?php
$serveName = "localhost";
$userName = "root";
$password = "";
$database="";


$sql = 'SELECT COUNT(*) AS `exists` FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMATA.SCHEMA_NAME="chatdb"';
$con = new mysqli($serveName,$userName,$password);
$result = $con->query($sql)->fetch_object();
if (!((array)$result)['exists']){
    $sql = "CREATE database chatdb";
    $database = "chatdb";
    $con->query($sql2);
}

$con->select_db("chatdb");

session_start();



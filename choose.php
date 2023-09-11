<?php 
include_once('connection.php');
unset($_SESSION['reciever_id']);
$friendid = $_GET['reciever_id'];
$senderid = $_GET['sender_id'];
$table_name ="$friendid"."chat"."$senderid";
$table = "SELECT * FROM INFORMATION_SCHEMA.TABLES
WHERE TABLE_NAME = '$table_name'";
$re=$con->query($table)->fetch_object();

$table_nameReverse ="$senderid"."chat"."$friendid";
$table = "SELECT * FROM INFORMATION_SCHEMA.TABLES
WHERE TABLE_NAME = '$table_nameReverse'";
$re2=$con->query($table)->fetch_object();

// echo $table_name . " " . $table_nameReverse;
if (!$re2){
     if (!$re){
          $sql = "CREATE table $table_name (id INT PRIMARY KEY AUTO_INCREMENT ,texter_id INT, FOREIGN KEY (texter_id) REFERENCES users(id),message TEXT,status varchar(255) DEFAULT 'off')";
          $con->query($sql);
     }

}else {
     $table_name=$table_nameReverse;

} 

// if ($_POST['message']){

// }
$allMessages = mysqli_query($con,"UPDATE  $table_name set status = 'on' where status = 'off' AND texter_id = $friendid");

$_SESSION['reciever_id'] = $friendid;
$con->close();
header('location:chatHome.php');

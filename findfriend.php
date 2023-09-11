<?php 
include_once('connection.php');
$friendphone = $_POST['searchfriend'];
$useremail = $_SESSION['email'];
$sql = "SELECT id FROM users where email = '$useremail'";
$resultusers = $con->query($sql)->fetch_assoc();
$userid = $resultusers['id'];

$sql2 = "SELECT id FROM users where phone = '$friendphone'";
$resultusers2 = $con->query($sql2)->fetch_assoc();
$friendid = $resultusers2['id'];


$stm = $con->query("SELECT id FROM user_$userid where friend_id = $friendid");
// $allMessages = mysqli_query($con,"UPDATE  $table_name set status = 'on' where status = 'off' AND texter_id = $friendid");

$_SESSION['reciever_id'] = $friendid;

// echo $friendphone;
$con->close();
header('location:chatHome.php');


<?php
include_once('connection.php');
if ($_POST){
    $email =$_SESSION['email'];
    $sql = "SELECT id FROM users where email = '$email'";
    $resultusers = $con->query($sql)->fetch_assoc();
    $userid = $resultusers['id'];

    $message = $_POST['message'];
    $reciever_id = $_POST['reciever_id'];

    $table = "SELECT * FROM INFORMATION_SCHEMA.TABLES
    WHERE TABLE_NAME = 'user_$reciever_id'";
    $re=$con->query($table)->fetch_object();
    
    if (!$re){
        $sql = "CREATE table user_$reciever_id (id INT PRIMARY KEY ,friend_id INT, FOREIGN KEY (friend_id) REFERENCES users(id))";
        $con->query($sql);
    }

    $is_friend_exist = $con->query("SELECT friend_id FROM user_$reciever_id where friend_id = $userid")->fetch_assoc();
    if (!$is_friend_exist['friend_id']){
        $sql = "INSERT INTO user_$reciever_id (friend_id) values ($userid)";
        $stm = $con->prepare($sql);
        $stm->execute();
    }

    
    $table_name ="$reciever_id"."chat"."$userid";

    
    $table = "SELECT * FROM INFORMATION_SCHEMA.TABLES
    WHERE TABLE_NAME = '$table_name'";
    $re=$con->query($table)->fetch_object();
    
    if (!$re){
        $table_name ="$userid"."chat"."$reciever_id";
    }


    $message = filter_var($message,FILTER_SANITIZE_STRING);
    $sql = "INSERT INTO $table_name (texter_id,message) values($userid,'$message')";
    $stm = $con->prepare($sql);
    $stm->execute();

    $con->close();
    header('location:chatHome.php');
}
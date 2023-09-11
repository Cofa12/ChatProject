<?php
include_once("connection.php");
include_once("tables.php");

if (!$_POST){
    header('location:login.php');
}else {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
        header("location:login.php?erroremail=there is no email");
    }
    $email = filter_var($email,FILTER_SANITIZE_EMAIL);
    $stmt = $con->prepare("SELECT id, email, password FROM users where email='$email'");
    $stmt->execute();
    $array = [];
    foreach ($stmt->get_result() as $row)
    {
        $array[] = $row;
    }
    // print_r($row);

    echo $pass ."<br>";
    echo hash('md5',$pass) . "<br>" . $array[0]['password'];
    if ($email == $array[0]['email'] && hash('md5',$pass)== $array[0]['password']){
        $_SESSION['email']=$array[0]['email'];


        // make a table for this user
        $user_id = $array[0]['id'];

        $table = "SELECT * FROM INFORMATION_SCHEMA.TABLES
        WHERE TABLE_NAME = 'user_$user_id'";
        $re=$con->query($table)->fetch_object();

        if (!((array)$re)['CREATE_TIME']){
            $sql = "CREATE table user_$user_id (id int NOT NULL AUTO_INCREMENT,PRIMARY KEY (id), friend_id INT, FOREIGN KEY (friend_id) REFERENCES users(id))";
            $con->query($sql);
        }

        $con->close();
        header('location:chatHome.php');
    } else {
        header('location:login.php?error=there is no email and password');
        // echo "bad";
    }

  
}
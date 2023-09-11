<?php
include_once('connection.php');
include_once('tables.php');
if (!$_POST){
    header('location:register.php');
} else {
    
    $username = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $phone = $_POST['phone'];

    // sanitize and validate the email
    if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
        header('location:register.php?erroremail="invalid email"');
        exit();
    }
    $email = filter_var($email,FILTER_SANITIZE_EMAIL);

    //  validate the Password
    $upperCase = preg_match('@[A-Z]@',$pass);
    $lowerCase = preg_match('@[a-z]@',$pass);
    $number = preg_match('@[0-9]@',$pass);
    $specialchars = preg_match('@[^\w]@',$pass);
    if (!($upperCase && $lowerCase && $number && $specialchars && strlen($pass))){
        header("location:register.php?error=Your password must contain lowercase, uppercase , numbers, specialchars and greater than 7&email=$email&name=$username");
        exit();
    }

    $pass = hash('md5',$pass);

    // phone 
    if (strlen($phone)!=11){
        header('location:register.php?phoneerror=the phone number must be 11 chars');
    }
    
    if (filter_var($phone,FILTER_VALIDATE_INT)){
        header('location:register.php?phoneerror=it is not a number');
    }


    // photo 

    $image =$_FILES['image']['name'];
    $imageExtension = explode('.',$image)[1];
    
    $extensions = ['png', 'jpeg','jpg'];

    if (!in_array($imageExtension,$extensions)){
        header('location:register.php?errorimage="invalid extension"');
        exit();
    }

    $imageNewName = time().".".$imageExtension;
    if (!file_exists(__DIR__.'photo')){
        mkdir('photo');
    }
    move_uploaded_file($_FILES['image']['tmp_name'],__DIR__.'/photo'."/".$imageNewName);
    $sql = "INSERT INTO users(uName,u_image,email,password,phone) values('$username','$imageNewName','$email','$pass','$phone')";
    $con->query($sql);
    $con->close();
    header('location:login.php');
    clearstatcache();

}
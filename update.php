<?php
include_once('connection.php');
if (!$_POST){
    header('location:chatHome.php');
} else {
    $useremail = $_SESSION['email'];
    $sql = "SELECT id FROM users where email = '$useremail'";
    $resultusers = $con->query($sql)->fetch_assoc();
    $userid = $resultusers['id'];
    $username = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $bio = $_POST['bio'];
    // $userphoto = $_POST['image'];


    // sanitize and validate the email
    if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
        header('location:chatHome.php?erroremail="invalid email"');
        exit();
    }
    $email = filter_var($email,FILTER_SANITIZE_EMAIL);


    // phone 
    if (strlen($phone)!=11){
        header('location:chatHome.php?phoneerror=the phone number must be 11 chars');
    }
    
    if (filter_var($phone,FILTER_VALIDATE_INT)){
        header('location:chatHome.php?phoneerror=it is not a number');
    }


    // photo 
    // print_r(($_FILES['image']['size']));
    // print_r($_FILES['image']);
    if ($_FILES['image']['size']){
        $image =$_FILES['image']['name'];
        $imageExtension = explode('.',$image)[1];
        $extensions = ['png', 'jpeg','jpg'];
        if (!in_array($imageExtension,$extensions)){
            // header('location:chatHome.php?errorimage="invalid extension"');
            exit();
        }

        $imageNewName = time().".".$imageExtension;
        move_uploaded_file($_FILES['image']['tmp_name'],__DIR__.'/photo'."/".$imageNewName);
         
    //  echo $username;
     $sql = "UPDATE users SET uName = '$username', email = '$email', phone = '$phone', bio = '$bio', u_image = '$imageNewName' where id = $userid";
    } else {
        
        // echo $username;
        $sql = "UPDATE users SET uName = '$username', email = '$email', phone = '$phone', bio = '$bio' where id = $userid";

    }

    $con->query($sql);
    $con->close();
    header('location:chatHome.php');

    echo $username;

}
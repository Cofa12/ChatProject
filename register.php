<?php
include_once('connection.php');
include_once('tables.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn2.iconfinder.com/data/icons/leto-teamwork/64/__team_chat_communicarion-512.png" type = "image/png">
    <link rel="stylesheet" href="styling/register.css">
    <title>Register</title>

</head>
<body>
    <div class ="content">
        <h2>SIGN UP</h2>
        <form action="regis_back.php" method="post" enctype="multipart/form-data">
            <input type="text" name="name" class="text" placeholder = "Type Your Name" value = "<?php if(isset($_GET['name']))  echo $_GET['name'] ?>">

            <input type="email" name="email" id="" class="text" placeholder = "Type Your Email"value = "<?php if(isset($_GET['email']))  echo $_GET['email'] ?>">
            <span style="display:block;color:red"><?php if(isset($_GET['erroremail']))  echo $_GET['erroremail'] ?></span>
            <input type="text" name="phone" id="" class="text" placeholder = "Type Your Phone"value = "<?php if(isset($_GET['phone']))  echo $_GET['phone'] ?>">
            <span style="display:block;color:red"><?php if(isset($_GET['phoneerror']))  echo $_GET['phoneerror'] ?></span>
            <input type="password" name="password" id="pass" class="text" placeholder = "Type Your Password">
            <button onclick ="changeeye()" type="button">
                <img src="htmlPhoto/eye.png" id = "eye" class="eye" onclick ="changeeye()">
            </button>
            <span style="display:block;color:red"><?php if(isset($_GET['error']))  echo $_GET['error']?></span>
            
            <input type="file" name="image">
            <span style="display:block;color:red"><?php if(isset($_GET['errorimage']))  echo $_GET['errorimage']?></span>

            <input type="submit" value="Sign Up" class ="signup" name ="sign">
            <span>If you have an account <a href="login.php">LOGIN</a></span>

        </form>
    </div>
    <script src ="../chatProject/eye.js"></script>

</body>
</html>
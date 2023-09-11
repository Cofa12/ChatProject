<?php
include_once('connection.php');
include_once('tables.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn2.iconfinder.com/data/icons/leto-teamwork/64/__team_chat_communicarion-512.png" type = "image/png">
    <link rel="stylesheet" href="styling/login.css">
    <title>Login</title>
</head>
<body>
    <div class ="content">
        <h2>LOGIN</h2>
        <form action="login_back.php" method="post">

            <input type="email" name="email" id="" class="text" placeholder = "Type Your Email"value = "<?php if(isset($_GET['email']))  echo $_GET['email'] ?>" stytle="height:40px">
            <input type="password" name="password" id="" class="text" placeholder = "Type Your Password" stytle="height:40px">
            <span style="display:block;color:red"><?php if(isset($_GET['error']))  echo $_GET['error']?></span>
            <input type="submit" value="LOGIN" class ="signup">
            <span> If You Want To <a href="register.php">Sign Up</a></span>


        </form>
    </div>
</body>
</html>
<?php
include_once('connection.php');
if (!isset($_SESSION['email'])){
    header('location:login.php');
}
include_once('tables.php');
include_once('config.php');


$email =$_SESSION['email'];
$stm= $con->prepare("SELECT * From users where email='$email'");
$stm->execute();

$array=[];
foreach($stm->get_result() as $row){
    $array [] = $row;
}

$sql = "SELECT id FROM users where email = '$email'";
$resultusers = $con->query($sql)->fetch_assoc();
$userid = $resultusers['id'];
$stm2 = mysqli_query($con,"SELECT friend_id From user_$userid");
$result =mysqli_fetch_all($stm2, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn2.iconfinder.com/data/icons/leto-teamwork/64/__team_chat_communicarion-512.png" type = "image/png">

    <style>
        *{
    margin: 0;
    padding: 0;
}

body{
    background-color: #313866;
}

.container{
    width: 800px;
    height: 600px;
    margin: auto;
    position: relative;
    top: 60px;
    display: flex;

}

.friends{
    width: 35%;
    height: 100%;
    background-color: #176B87;
    float:left;
}

.chat{
    background-color: #DDD;
    width: 65%;
    height: 100%;
}

.Info_me{
    width: 91%;
    height: 100px;
    padding: 25px;
    display: flex;

}


.Info_me > img{
    width: 50px;
    height: 50px;
    border-radius: 26px;
    border: solid #18da5d 2px;
}

.Info_me h2{
    position: relative;
    top: 11px;
    left: 46px;
    color: #DDD;
    font-size: 20px;
    text-transform: capitalize;
    font-family: cursive;
}

.Info_me a{
    float: right;
    display: block;
    text-decoration: none;
    width: 68px;
    height: 32px;
    position: relative;
    left: 50px;
    top: 17px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.friends > form{
    margin-left:10px;
    position:relative;
}

.friends form input{
    width: 243px;
    height: 29px;
    background-color: #176b87;
    outline: none;
    border: solid #858282 1px;
    border-radius: 20px;
    padding-left: 32px;
    color: #DDD;
}

.friends form img{
    width: 25px;
    position: absolute;
    left: 3px;
    top: 3px;
}

.friends .allFriends{
    display:block;
    padding: 13px;
    width: 88%;
    height: 56%;
    margin-top: 25px;
    overflow:auto;
    text-decoration:none;
}

.allFriends div{
    width: 89%;
    height: 63px;
    display: flex;
    position: relative;
    padding: 11px;
}

.allFriends a{
    width: 90%;
    height: 63px;
    display: flex;
    position: relative;
    padding: 11px;
    text-decoration:none;
}

.allFriends div:hover{
    background-color:#1e5f75;
    cursor: pointer;
    height: 40px;

}

.allFriends div img{
    width: 50px;
    height: 50px;
    border-radius: 26px;
    border: solid #18da5d 2px;
}

.allFriends div h2{
    position: relative;
    top: 8px;
    left: 18px;
    color: #DDD;
    font-size: 15px;
    text-transform: capitalize;
    font-family: monospace;
}
.allFriends div span{
    position: absolute;
    top: 39px;
    left: 82px;
    font-size: 10px;
    font-family: monospace;
    color: #DDD;
}

.friends .settings{
    width: 100%;
    height: 5.5%;
    display: flex;
    justify-content: flex-start;
    align-items: center;
}
.friends .settings form{
    width: 49.5%;
    margin-left: 1px;
}
.friends .settings button{
    width: 100%;
    height: 35px;
    color: #FFF;
    background-color: #11556c;
    border: none;
    outline: none;
    margin-left: 0px;
    cursor: pointer;
    position: relative;

}

.friends .settings  .searchinfo{
    display: none;
    position: absolute;
    top: 25%;
    left: 25%;
    width: 50%;
    height: 50%;
    padding: 16px;
    border: 1px solid orange;
    background-color: #176b87;
    z-index: 1002;
    overflow: auto;
}

.settings .overlay{
    display: none;
  position: absolute;
  top: 0%;
  left: 0%;
  width: 100%;
  height: 100%;
  background-color: black;
  z-index: 1001;
  -moz-opacity: 0.8;
  opacity: .80;
  filter: alpha(opacity=80);
}
.friends .settings  .searchinfo div{
    width: 89%;
    height: 63px;
    display: block;
    position: relative;
    padding: 11px;
}


.allFriends div:hover{
    background-color:#1e5f75;
    cursor: pointer;
    height: 40px;
}

.friends .settings .searchinfo div >img{
    width: 50px;
    height: 50px;
    border-radius: 26px;
    border: solid #18da5d 2px;
}

.friends .settings  .searchinfo div h2{
    position: relative;
    top: -56px;
    left: 73px;
    color: #DDD;
    font-size: 15px;
    text-transform: capitalize;
    font-family: monospace;
}
.friends .settings  .searchinfo div span{
    position: absolute;
    top: 39px;
    left: 82px;
    font-size: 10px;
    font-family: monospace;
    color: #DDD;
}

.settings .info img{
    position: unset;
    display: block;
    width: 70px;
    margin: auto;
    height: 70px;
    border-radius: 38px;
}

.chat .chat_header{
    width: 95.5%;
    height: 51px;
    background-color: #FFF;
    padding-left: 23px;
    display: flex;
    align-items: center;
}

.chat .chat_header img{
    width: 20px;
    width: 40px;
    height: 40px;
    border-radius: 26px;
}
.chat .chat_header h2{
    color: #000;
    font-size: 16px;
    text-transform: capitalize;
    font-family: cursive;
    margin-left: 15px;
}

.chat .content_chat{
    width: 93%;
    height: 72%;
    padding: 38px;
    overflow: auto;

}
.chat .content_chat .meSend{
    color: red;
    min-width: 15px;
    min-height: 15px;
    background-color: #176b87;
    float: right;
    margin-right: 31px;
    padding: 2px;
    display: flex;
    align-items: center;
    padding-left: 21px;
    border-radius: 22px;
    padding-right: 21px;
    margin-bottom: 24px;

    color: #FFF;
    max-width:174px;
    margin-left: 200px;
    min-height: 35px;
    max-height: 150px;

}
.chat .content_chat .theirSend{
    color: red;
    min-width: 15px;
    min-height: 15px;
    background-color: #ffffff;
    float: left;
    margin-right: 31px;
    padding: 2px;
    display: flex;
    align-items: center;
    padding-left: 21px;
    border-radius: 22px;
    padding-right: 21px;
    margin-right: 200px;
    color: #000;
    margin-bottom: 24px;
    max-width:174px;
    min-height: 35px;
    max-height: 150px;
}

.chat form{
    width: 100%;
    height: 6.5%;
    display: flex;
    position: relative;
}
.chat form .text{
    width: 100%;
    padding-left: 20px;
    border: none;
    outline: none;
}
.chat form img{
    width: 20px;
}
.chat  form .sub{
    width: 48px;
    height: 39px;
    border: none;
    outline: none;
    background-color: #176b87;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    margin-top: 2px;
}

.settings .search_content .searchlink :hover{
    background-color:#1e5f75;
    cursor: pointer;
}




    </style>
    <title>Chat</title>
    <script src = "add_setting_script.js"></script>
    <script src = "theSettings.js"></script>

</head>
    <?php if (isset($_SESSION['overlay'])){
        echo "<body onload = 'showsearch()'>";
    } else {
        echo "<body>";

    }

    ?>
    <body>
    <div class="container">
        <div class="friends">
            <div class ="Info_me">
                <img src="../chatProject/photo/<?php echo $array[0]['u_image'] ?>" alt="">
                <h2><?php echo $array[0]['uName'] ?></h2>
                <a href="logout.php"><img src="../chatProject/htmlPhoto/logout.png" alt=""></a>
            </div>
            <form action="findfriend.php" method = "post">
                <img src="../chatProject/htmlPhoto/search.png" alt="">
                <input type="search" name="searchfriend" id="" placeholder = "Search Contacts..">
            </form>
            <div class ="allFriends">
                <?php 
                foreach($result as $row=> $val){
                    $val = $val['friend_id'];
                    // count the number of messages unread 
                    $table_name ="$val"."chat"."$userid";

                    $table = "SELECT * FROM INFORMATION_SCHEMA.TABLES
                    WHERE TABLE_NAME = '$table_name'";
                    $re=$con->query($table)->fetch_object();
                    
                    if (!$re){
                        $table_name ="$userid"."chat"."$val";
                    }
                    $allMessages = mysqli_query($con,"SELECT COUNT(id) as SUM FROM $table_name where status = 'off' AND texter_id = $val")->fetch_object();
                    $photo = $con->query("SELECT u_image FROM users where id = $val")->fetch_assoc();
                    $name = $con->query("SELECT uName FROM users where id = $val")->fetch_assoc();
                    $des = $con->query("SELECT bio FROM users where id = $val")->fetch_assoc();
                    if (((array)$allMessages)['SUM']){
                        echo "<a style = 'background-color:#1e5f75' href = 'choose.php?reciever_id=$val&sender_id=$userid'> "."<div>
                        <img src = " . "../chatProject/photo/". $photo['u_image'] .">".
                        "<h2>".$name['uName']."</h2>".
                        "<span>".$des['bio']."</span>".
                        "</div>"."</a>";
                    } else {
                        echo "<a href = 'choose.php?reciever_id=$val&sender_id=$userid'> "."<div>
                        <img src = " . "../chatProject/photo/". $photo['u_image'] .">".
                        "<h2>".$name['uName']."</h2>".
                        "<span>".$des['bio']."</span>".
                    "</div>"."</a>";
                    }

                }
                ?>
            </div>
            <div class = "settings">
                    <button type = "button" onclick="showsearch()" style = "display:flex; justify-content:center; align-items:center;font-size:12px">
                        <img src = "../chatProject/htmlPhoto/write.png" style = "position: unset;width:17px;margin-left:4px">
                        Write message...
                    </button>
                    <div id = "searchinfo" class = "searchinfo">
                            <form action="chatHome.php?" method="GET">
                                 <img src="../chatProject/htmlPhoto/search.png" alt="" style = "left: 23px;top: 19px;" >
                                <input type="search" name="phone" id="" style = "width:357px;" placeholder = "Search Contacts..">
                            </form>
                            <form action="deleteoverlay.php">
                                <button style = "left: 379px;top: -36px;cursor: pointer;width: 30px;position: relative;display: flex;justify-content: center; align-items: center;height: 33px;}">
                                    <img src="../chatProject/htmlPhoto/close.png" alt="" style = "cursor:pointer" onclick= "closefun()">
                                </button>
                            </form>
                        <div class = "search_content">
                        <?php 

                            if (!isset($_GET['phone'])){

                            }else{
                            $_SESSION['overlay']=1;
                            $phone = $_GET['phone'];
                            
                            $stm =$con->query("SELECT id, uName, u_image,email, bio FROM users where phone = $phone")->fetch_object();
                            $searchPhoto = ((array)$stm)['u_image'];
                            $searchName = ((array)$stm)['uName'];
                            $searchBio = ((array)$stm)['bio'];
                            $searchid = ((array)$stm)['id'];
                             
                            if (isset($searchName)){
                                $_SESSION['overlay']=1;
                            }
                            $phone = $_GET['phone'];
                            echo "<a class ='searchlink' href = 'choosefromsearch.php?reciever_id=$searchid&sender_id=$userid&phone=$phone'> "."<div>
                            <img src = " . "../chatProject/photo/".$searchPhoto.">".
                            "<h2>".$searchName."</h2>".
                            "<span>".$searchBio."</span>".
                            "</div>"."</a>";
                            }
                                
                        ?>
                        </div>
                    </div>
                    <div class = "overlay" id = "overlay"></div>
                <form action="">
                <button type = "button" onclick="settingshow()" style = "margin-top: 0px;display:flex; justify-content:center; align-items:center;font-size:12px">
                    <img src = "../chatProject/htmlPhoto/settings.png" style = "position: unset;width:17px; margin-left:4px">
                    Settings
                </button>
                </form>
                <!-- the pop up of setting -->
                <div id = "settinginfo" class = "searchinfo" style= "top: -3%;height:100%;text-align:center">
                            <button style = "left: 379px;top: -36px;cursor: pointer;width: 0px;position: relative;display: flex;justify-content: center; align-items: center;height: 0px;}">
                                    <img src="../chatProject/htmlPhoto/close.png" alt="" onclick= "settingshidden()" style = "cursor: pointer;width: 28px;height: 30px;position: relative;top: 42px;">
                                </button>                                 
                                <?php 
                                    $stm =$con->query("SELECT * FROM users where id = $userid")->fetch_object();
                                    $photo = ((array)$stm)['u_image'];
                                    $userName = ((array)$stm)['uName'];
                                    $userPhone = ((array)$stm)['phone'];
                                    $userBio = ((array)$stm)['bio'];
                                    $userEmail = ((array)$stm)['email'];
                                    echo "<img src = '../chatProject/photo/$photo' style ='width: 70px;
                                    height: 70px;
                                    border-radius: 100%;
                                    margin: auto;'>";
                                    echo "<form action="."update.php"." method = 'post' enctype='multipart/form-data'>
                                    <input type = 'file' name = 'image'  style = 'border: none;
                                    width: 180px;
                                    margin-bottom: 50px;
                                    padding: 0;
                                    display: block;
                                    position: relative;
                                    left: 106px;'>
                                    <input type = 'text' value = '$userName' name = 'name'style = 'width: 175%;
                                    border-radius: 0;
                                    height: 42px;
                                    padding-left: 14px;
                                    margin-bottom: 15px;'>
                                    <input type = 'text' value = '$userEmail' name = 'email'style = 'width: 175%;
                                    border-radius: 0;
                                    height: 42px;
                                    padding-left: 14px;
                                    margin-bottom: 15px;'>
                                    <input type = 'text' value = '$userPhone' name = 'phone' style = 'width: 175%;
                                    border-radius: 0;
                                    height: 42px;
                                    padding-left: 14px;
                                    margin-bottom: 15px;'>
                                    <textarea name = 'bio' style = 'width: 175%;
                                    border-radius: 0;
                                    height: 103px;
                                    padding-left: 14px;
                                    margin-bottom: 15px;
                                    background-color: #176b87;
                                    padding:10px;
                                    outline:none;
                                    resize: none;' placeholder = 'Bio...'>$userBio</textarea>

                                    <input type = 'submit' value = 'Update'style = 'position: relative;
                                    left: 73px;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    background-color: #DDD;
                                    color: #176b87;
                                    padding: 0;
                                    height: 39px;cursor:pointer'>
                                    </form>";
                                 ?>
                        <div class = "search_content">
                       
                        </div>
                    </div>
                    <div class = "overlay" id = "overlay"></div>

                <!-- -------- -->
            </div>
        </div>
        <div class="chat">
                <div class = "chat_header">
                    <?php 
                    if (isset($_SESSION['reciever_id'])){
                        $friendPhoto = $con->query("SELECT u_image FROM users where id = ".$_SESSION['reciever_id'])->fetch_assoc();
                        $friendname = $con->query("SELECT uName FROM users where id = ".$_SESSION['reciever_id'])->fetch_assoc();
                        echo 
                        "<img src=".'../chatProject/photo/'.$friendPhoto['u_image'].">".
                        "<h2>".$friendname['uName']."</h2>";
                    }
                    ?>
                </div>
                <div class="content_chat">
                    <?php 
                        if(isset($_SESSION['reciever_id'])){
                        $reciever_id = $_SESSION['reciever_id'];
                        $table_name ="$reciever_id"."chat"."$userid";

                        $table = "SELECT * FROM INFORMATION_SCHEMA.TABLES
                        WHERE TABLE_NAME = '$table_name'";
                        $re=$con->query($table)->fetch_object();
                        
                        if (!$re){
                            $table_name ="$userid"."chat"."$reciever_id";
                        }

                            $statement = mysqli_query($con,"SELECT texter_id, message FROM $table_name");
                            $messages = mysqli_fetch_all($statement,MYSQLI_ASSOC);
                            foreach($messages as $row){
                                if ($row['texter_id']==$userid){
                                    echo "<span class = 'meSend'>".$row['message']."</span>";
                                } else{
                                    echo "<span class ='theirSend'>".$row['message']."</span>";
                                }
                            }
                        


                    }
                    ?>
                </div>
                <form action="message.php" method="post">
                    <input type="text" name = "message" placeholder="Write Your Message" class="text">
                    <input type="hidden" name="reciever_id" value = "<?php if(isset($_SESSION['reciever_id']))  echo $_SESSION['reciever_id']?>">
                    <button class="sub" type = "submit">
                        <img src="../chatProject/htmlPhoto/send.png" alt="">
                    </button>
                </form>
        </div>
    </div>
</body>
</html>
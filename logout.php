<?php
include_once('connection.php');
unset($_SESSION['email']);
unset($_SESSION['reciever_id']);

header('location:login.php');
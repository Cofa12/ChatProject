<?php
include_once('connection.php');
unset($_SESSION['overlay']);

// echo $_SESSION['overlay'];
header('location:chatHome.php');
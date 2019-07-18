<?php
/**
 * Created by PhpStorm.
 * User: alihamza
 * Date: 5/28/18
 * Time: 1:47 PM
 */
include_once ('connection.php');
include_once ('userData.php');
session_start();


follow($_POST['userId'],$_SESSION['rollNo'],$conn);
insertFollowNotification($_POST['userId'],$_SESSION['rollNo'],$conn);
?>
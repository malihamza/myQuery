<?php
/**
 * Created by PhpStorm.
 * User: alihamza
 * Date: 6/13/18
 * Time: 12:21 AM
 */
include_once ("../connection.php");
session_start();
$quer = "SELECT notificationId from notifications where seen=0 and rollNo='".$_SESSION['rollNo']."'";
$res = mysqli_query($conn,$quer);
$numOfNotifications =mysqli_num_rows($res);
if($numOfNotifications>0)
 echo $numOfNotifications;
?>
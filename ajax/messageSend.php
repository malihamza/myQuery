<?php
/**
 * Created by PhpStorm.
 * User: alihamza
 * Date: 6/10/18
 * Time: 1:59 AM
 */
include_once ("../connection.php");
include_once ("../userData.php");
session_start();
if(strlen($_POST['message'])>0)
{
    date_default_timezone_set("Asia/Karachi");
    $timeOfMessage=date("h:i:sa");
    $dateOfMessage=date("Y/m/d",time());

    leftMessageDisplay($_POST['message'],$dateOfMessage,$timeOfMessage);
    sendMessage($_SESSION['rollNo'],$_POST['messageTo'],$_POST['message'],$conn);
}


?>
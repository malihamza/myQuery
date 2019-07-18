<?php
/**
 * Created by PhpStorm.
 * User: alihamza
 * Date: 6/10/18
 * Time: 1:59 AM
 */
include_once ("connection.php");
include_once ("userData.php");

session_start();
sendMessage($_SESSION['rollNo'],$_POST['messageTo'],$_POST['message'],$conn);
?>
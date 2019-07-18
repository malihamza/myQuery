<?php
/**
 * Created by PhpStorm.
 * User: alihamza
 * Date: 6/15/18
 * Time: 3:21 AM
 */

include_once ("../connection.php");
include_once ("../userData.php");
session_start();
$res = getMessageDataOfUnseen($_SESSION['rollNo'],$_POST['messageTo'],$conn);
makeUnseenSeen($_SESSION['rollNo'],$_POST['messageTo'],$conn);
$whomeToSend = $_POST['messageTo'];
$userDataOfMessageTo = getUserData($whomeToSend,$conn);
$userDataOfMessageToName = $userDataOfMessageTo['firstName']." ".$userDataOfMessageTo['lastName'];
    while($result = mysqli_fetch_assoc($res))
    {
        rightMessageDisplay($userDataOfMessageTo,$userDataOfMessageToName,$result['messageData'],$result['dateOfMesssage'],$result['timeOfMessage']);
    }
?>
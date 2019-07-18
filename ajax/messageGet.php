<?php
/**
 * Created by PhpStorm.
 * User: alihamza
 * Date: 6/10/18
 * Time: 8:29 PM
 */
include_once ("../connection.php");
include_once ("../userData.php");
session_start();
$whomeToSend = $_POST['messageTo'];
$userDataOfMessageTo = getUserData($whomeToSend,$conn);
$userDataOfMessageToName = $userDataOfMessageTo['firstName']." ".$userDataOfMessageTo['lastName'];
$result = getMessageData($_SESSION['rollNo'],$whomeToSend,$conn);
$q = "UPDATE messages set seen = 1 WHERE seen = 0 AND messageFrom = '".$_SESSION['rollNo']."' AND messageTo = '".$whomeToSend."'";
mysqli_query($conn,$q);
while($row = mysqli_fetch_assoc($result))
{
    if($row['messageFrom']==$_SESSION['rollNo'])
    {
        leftMessageDisplay($row['messageData'],$row['dateOfMesssage'],$row['timeOfMessage']);
    }
    else
    {
        rightMessageDisplay($userDataOfMessageTo,$userDataOfMessageToName,$row['messageData'],$row['dateOfMesssage'],$row['timeOfMessage']);
    }
}
?>

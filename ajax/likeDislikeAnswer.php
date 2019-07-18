<?php
/**
 * Created by PhpStorm.
 * User: alihamza
 * Date: 6/19/18
 * Time: 7:43 PM
 */

include_once ("../connection.php");
include_once ("../userData.php");
session_start();
if(isset($_POST['choice']))
{
    if($_POST['choice']==1)
    {
        $quer = "DELETE FROM voteAnswer WHERE rollNo ='".$_SESSION['rollNo']."' AND answerId = ".$_POST['answerId'];

        mysqli_query($conn,$quer);
    }
    else if($_POST['choice']==2)
    {
        $quer = "UPDATE voteAnswer set voteType = 1 WHERE rollNo ='".$_SESSION['rollNo']."' AND answerId = ".$_POST['answerId'];
        mysqli_query($conn,$quer);
    }
    else if($_POST['choice']==3)
    {
        $quer = "INSERT INTO voteAnswer (rollNo,answerId,voteType) VALUES ('".$_SESSION['rollNo']."',".$_POST['answerId'].",1)";
        mysqli_query($conn,$quer);
    }
    else if($_POST['choice']==4)
    {
        $quer = "DELETE FROM voteAnswer WHERE rollNo ='".$_SESSION['rollNo']."' AND answerId = ".$_POST['answerId'];
        mysqli_query($conn,$quer);
    }
    else if($_POST['choice']==5)
    {
        $quer = "UPDATE voteAnswer set voteType = -1 WHERE rollNo ='".$_SESSION['rollNo']."' AND answerId = ".$_POST['answerId'];
        mysqli_query($conn,$quer);
    }
    else if($_POST['choice']==6)
    {
        $quer = "INSERT INTO voteAnswer (rollNo,answerId,voteType) VALUES ('".$_SESSION['rollNo']."',".$_POST['answerId'].",-1)";
        mysqli_query($conn,$quer);
    }
}

?>
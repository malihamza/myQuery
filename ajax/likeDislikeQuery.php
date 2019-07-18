<?php
/**
 * Created by PhpStorm.
 * User: alihamza
 * Date: 6/15/18
 * Time: 6:50 PM
 */
include_once ("../connection.php");
include_once ("../userData.php");
session_start();
if(isset($_POST['choice']))
{
    if($_POST['choice']==1)
    {
        $quer = "DELETE FROM voteQuery WHERE rollNo ='".$_SESSION['rollNo']."' AND questionId = ".$_POST['questionId'];

        mysqli_query($conn,$quer);
    }
    else if($_POST['choice']==2)
    {
        $quer = "UPDATE voteQuery set voteType = 1 WHERE rollNo ='".$_SESSION['rollNo']."' AND questionId = ".$_POST['questionId'];
        mysqli_query($conn,$quer);
    }
    else if($_POST['choice']==3)
    {
        $quer = "INSERT INTO voteQuery (rollNo,questionId,voteType) VALUES ('".$_SESSION['rollNo']."',".$_POST['questionId'].",1)";
        mysqli_query($conn,$quer);
    }
    else if($_POST['choice']==4)
    {
        $quer = "DELETE FROM voteQuery WHERE rollNo ='".$_SESSION['rollNo']."' AND questionId = ".$_POST['questionId'];
        mysqli_query($conn,$quer);
    }
    else if($_POST['choice']==5)
    {
        $quer = "UPDATE voteQuery set voteType = -1 WHERE rollNo ='".$_SESSION['rollNo']."' AND questionId = ".$_POST['questionId'];
        mysqli_query($conn,$quer);
    }
    else if($_POST['choice']==6)
    {
        $quer = "INSERT INTO voteQuery (rollNo,questionId,voteType) VALUES ('".$_SESSION['rollNo']."',".$_POST['questionId'].",-1)";
        mysqli_query($conn,$quer);
    }
}
?>


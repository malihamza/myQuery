<?php
/**
 * Created by PhpStorm.
 * User: alihamza
 * Date: 5/24/18
 * Time: 12:27 PM
 */
include_once ("connection.php");
include_once ("userData.php");
session_start();

if(strlen($_POST['commentData'])>0)
{
    $q = getQuestionDetail($_POST['questionId'],$conn);
    $questionFrom = $q['rollNo'];
    postComment($_SESSION['rollNo'],$_POST['questionId'],$_POST['commentData'],$conn);
    $id = mysqli_insert_id($conn);
    if($questionFrom!=$_SESSION['rollNo'])
    {
        insertCommentNotification($questionFrom,$_SESSION['rollNo'],$_POST['questionId'],$_POST['commentData'],$conn);
    }
    displayComment($id,$conn);
}
?>
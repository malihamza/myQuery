<?php
/**
 * Created by PhpStorm.
 * User: alihamza
 * Date: 6/13/18
 * Time: 6:25 PM
 */

include_once ("../connection.php");
include_once ("../userData.php");
session_start();
if(isset($_POST['limit']))
{
    $getQuestion=getTimelineQuestionId($_SESSION['rollNo'],$_POST['limit'],$_POST['offset'],$conn);
    while($row=mysqli_fetch_assoc($getQuestion))
    {
        $questionId=$row['questionId'];
        displayQuery($_SESSION['rollNo'],$questionId,$conn);
    }
}
?>

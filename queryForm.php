<?php
/**
 * Created by PhpStorm.
 * User: alihamza
 * Date: 5/23/18
 * Time: 6:54 PM
 */
include_once ("connection.php");
include_once ("userData.php");
session_start();
if(isset($_POST['submit']))
{
    $rollNo=$_SESSION['rollNo'];
    $headingOfQuery=$_POST['heading'];
    $descriptionOfQuery= $_POST['description'];
    $subjectName= $_POST['subject'];

    $subjectId=getSubjectId($subjectName,$conn)['subjectId'];
    $date=date("y/m/d",time());
    $time=date("h:i:sa");
    $insertQuestionQuery="insert into questions (rollNo,heading,description,subjectId,dateOfQuestion ,timeOfQuestion)
                          values  ('" . $rollNo . "','" . $headingOfQuery . "','" . $descriptionOfQuery . "','" . $subjectId . "','" . $date . "','" . $time . "')";
    $resultOfQuery=mysqli_query($conn,$insertQuestionQuery);
    $qid = mysqli_insert_id($conn);
    echo $qid;
     $getResult = "SELECT rollNo from subjectsUserBridge where subjectId = '".$subjectId."'";

    $res = mysqli_query($conn,$getResult);

    while ($row = mysqli_fetch_assoc($res))
    {
        if($row['rollNo']!=$_SESSION['rollNo'])
        {
            insertQueryNotification($row['rollNo'],$_SESSION['rollNo'],$qid,$_POST['heading'],$conn);
        }
    }

    $getResult = "SELECT followerId from followers where rollNo = '".$_SESSION['rollNo']."' and followerId NOT IN (SELECT rollNo from notifications where notificationLink = '".$qid."'
                    and notificationType=3)";
    echo  $getResult;
    $res = mysqli_query($conn,$getResult);

    while ($row = mysqli_fetch_assoc($res))
    {
        insertQueryNotification($row['followerId'],$_SESSION['rollNo'],$qid,$_POST['heading'],$conn);
    }
   // header('Location: query.php');

}
?>



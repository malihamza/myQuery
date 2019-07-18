<?php
/**
 * Created by PhpStorm.
 * User: alihamza
 * Date: 5/19/18
 * Time: 2:12 PM
 */
session_start();
include_once ("connection.php");
if(isset($_POST['submit']))
{
    $rollNo=$_SESSION['rollNo'];
   // echo $_SESSION['rollNo']."<br>";
    foreach($_POST as $value)
    {
        $getSubjectId="select subjectId from subjects where lower(subjectName) = "."'".strtolower($value)."'";
        if(strlen($value)>0)
        {
            $getResult=mysqli_query($conn,$getSubjectId);
         //   echo $getResult;
            $res=$getResult->fetch_assoc();

            //   echo $getSubjectId."<br>";
            if($res['subjectId'])
            {
                $insertInUserBridge="INSERT INTO subjectsUserBridge (rollNo,subjectId) values ('".$rollNo."','".$res['subjectId']."')";
                mysqli_query($conn,$insertInUserBridge);
            }
        }

    }
    header("Location: pic.php");
}
<?php
/**
 * Created by PhpStorm.
 * User: alihamza
 * Date: 5/26/18
 * Time: 6:51 PM
 */
include_once ('connection.php');
include_once ('userData.php');
session_start();
if(isset($_POST['submit']))
{
    $questionId = $_POST['id'];
    $desc = $_POST['description'];
    $rollNo = $_SESSION['rollNo'];
    postAnswer($rollNo,$questionId,$desc,$conn);

}
else
    {
        header('Location: pageNotFound.php');
    }
?>
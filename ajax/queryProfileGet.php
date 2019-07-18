<?php
/**
 * Created by PhpStorm.
 * User: alihamza
 * Date: 6/13/18
 * Time: 6:32 PM
 */
include_once ("../connection.php");
include_once ("../userData.php");
session_start();
if($_POST['rollNo'])
{
    $rollNo=$_POST['rollNo'];
    $getQuestion=getQuestionsId($rollNo,$_POST['limit'],$_POST['offset'],$conn);
    //echo $_POST['rollNo'];
    while($row=mysqli_fetch_assoc($getQuestion))
    {
        $questionId=$row['questionId'];
        displayQuery($_SESSION['rollNo'],$questionId,$conn);
    }
}
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">

<title><?php echo $userData['firstName']." ".$userData['lastName']; ?></title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="dist/css/adminlte.min.css">
<!-- Custom style -->
<link rel="stylesheet" href="dist/css/custom.css">


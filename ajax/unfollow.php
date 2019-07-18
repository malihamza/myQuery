<?php
/**
 * Created by PhpStorm.
 * User: alihamza
 * Date: 7/3/18
 * Time: 2:54 PM
 */
include_once ("../connection.php");
session_start();
$roll = $_SESSION['rollNo'];
$query = "DELETE FROM followers where followerId = '".$roll."' AND rollNo = '".$_POST['rollNo']."'";
$res = mysqli_query($conn,$query);


?>
<?php
/**
 * Created by PhpStorm.
 * User: alihamza
 * Date: 5/19/18
 * Time: 1:55 PM
 */
session_start();
include_once ("connection.php");
if($_POST['rollNo']) {
    $rollNo = $_POST['rollNo'];
    $queryForCheck = "select firstName from userInfo where lower(rollNo)=" . $rollNo;
    $res = mysqli_query($conn, $queryForCheck);

    if (!$res) {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $gender = $_POST['gender'];

        $password = $_POST['password'];

        $date = $_POST['dateOfBirth'];
        $insertQuery = "insert into userInfo (firstName,lastName,rollNo,userPassword,dateOfBirth ,gender) 
                          values  ('" . $firstName . "','" . $lastName . "','" . $rollNo . "','" . $password . "','" . $date . "','" . $gender . "')";

        $checkInsertQueryResult = mysqli_query($conn, $insertQuery);

        $_SESSION['rollNo'] = $rollNo;
        $_SESSION['firstName'] = $firstName;
        $_SESSION['lastName'] = $lastName;
    } else {
        echo "1";
    }

}
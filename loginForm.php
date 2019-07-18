<?php
/**
 * Created by PhpStorm.
 * User: alihamza
 * Date: 5/22/18
 * Time: 4:34 PM
 */

include_once ("connection.php");
session_start();
    $rollNo=$_POST['rollNo'];
    $passwd=$_POST['passwd'];
    $checkExistingQuery="SELECT rollNo,userPassword from userInfo where lower(rollNo) = '".strtolower($rollNo)."'";
    $resultExistingQuery=mysqli_query($conn,$checkExistingQuery);
    $res=$resultExistingQuery->fetch_assoc();
    if($res['rollNo'] && $passwd==$res['userPassword'])
    {
        $_SESSION['rollNo']=$rollNo;

    }
    else
    {
        echo "1";
    }

?>
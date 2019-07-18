<?php
/**
 * Created by PhpStorm.
 * User: alihamza
 * Date: 5/19/18
 * Time: 1:47 PM
 */
$conn=mysqli_connect("localhost","root","","myQuery");
if($conn->connect_error)
{
    header("Location: pages/examples/500.html");
}
?>
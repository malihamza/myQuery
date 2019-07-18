<?php
/**
 * Created by PhpStorm.
 * User: alihamza
 * Date: 6/14/18
 * Time: 4:23 PM
 */
include_once ("../connection.php");
if(isset($_POST['questionId']))
{

    $query = "DELETE FROM questions WHERE questionId = ".$_POST['questionId'].";";
    mysqli_query($conn,$query);
}
?>
<?php
/**
 * Created by PhpStorm.
 * User: alihamza
 * Date: 6/14/18
 * Time: 6:48 PM
 */

$queryAnswer = "DELETE FROM answers WHERE answerId = ".$_POST['answerId'].";";
echo $queryAnswer;
?>
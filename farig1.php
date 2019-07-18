<?php
/**
 * Created by PhpStorm.
 * User: alihamza
 * Date: 5/22/18
 * Time: 5:05 PM
 **/
/*
include_once("connection.php");
include_once ("userData.php");
session_start();
follow("BSEF17A020","BSEF17A023",$conn);*/
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Hahaah</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Custom style -->
    <link rel="stylesheet" href="dist/css/custom.css">
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- Google Font: Source Sans Pro -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">-->

</head>
<body class="hold-transition sidebar-mini">
<button id ="load">load</button>
<div id="content">

</div>
<script>
$(document).ready(function () {
    $("#load").click(function(){
        $.post("ajax/messageGet.php",{

        },function (data,status) {
            alert(data);
            alert(status);
        });
    });
});
</script>
</body>
</html>
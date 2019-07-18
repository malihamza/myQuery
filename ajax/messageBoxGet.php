<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Hahaha</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- Custom style -->
    <link rel="stylesheet" href="../dist/css/custom.css">

    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- Google Font: Source Sans Pro -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">-->

</head>
<body class="hold-transition sidebar-mini">

</body>
</html>
<?php
include_once ("../connection.php");
include_once ("../userData.php");
if(isset($_POST['messageTo'])) {
    echo "<script>

    $(document).ready(function() 
    {
    $.post('../newsFeed.php',
        {
            flags:1
        },function(data) 
        {
           document.write(data);  
        });
 });
    </script>";
}
?>


<?php
/**
 * Created by PhpStorm.
 * User: alihamza
 * Date: 5/19/18
 * Time: 2:13 PM
 *
 */
session_start();
?>
a<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Registration Page</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        .body{
            background: url(64xk850n3a8uzse6fi11l3vmz.jpg);
        }
        .register-box{
            width: 480px;
        }
        .selection{
            padding: 10px 0px;
        }
        .btn-select{
            border-radius: 20px;
            background: transparent;
            color: black;
            margin: 3px;
            font-weight: 200;
        }
        .btn-select:hover{
            color: white;
            background-color: rgb(36,137,197);
        }
        .btn-select:active{
            color: white;
            background-color: rgb(36,137,197);
        }
        .activeCheck{
            color: white;
            background-color: rgb(36,137,197);
        }
        .icheckbox_square-blue{
            background-position: 90px 90px;
        }
    </style>
</head>
<body class="hold-transition register-page body">

<div class="register-box">
    <div class="register-logo">
        <a href="index2.html" style="color: white"><b>myQuery</b>.com</a>
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Now <span style="color: #00c0ef;font-size: large"><?php echo $_SESSION['firstName'] ?></span> Select your the subjects which you have interest</p>

            <form action="topicForm.php" method="post">
                <div class="selection">
                    <label class="btn btn-primary btn-select">
                        <input type="checkbox" class="check" value="algorithms" name="algorithms"> Algorithms
                    </label>
                    <label class="btn btn-primary btn-select">
                        <input type="checkbox" class="check" value="itc" name="itc"> ITC
                    </label>
                    <label class="btn btn-primary btn-select">
                        <input type="checkbox" class="check" value="web Design" name="web Design"> Web Design
                    </label>
                    <label class="btn btn-primary btn-select">
                        <input type="checkbox" class="check" value="machine Learning" name="machine Learning"> Machine Learning
                    </label>
                    <label class="btn btn-primary btn-select">
                        <input type="checkbox" class="check" value="calculus" name="calculus"> Calculus
                    </label>
                    <label class="btn btn-primary btn-select">
                        <input type="checkbox" class="check" value="object Oriented" name="OOP"> OOP
                    </label>
                    <label class="btn btn-primary btn-select">
                        <input type="checkbox" class="check" name="operating System" value="operating System"> Operating System
                    </label>
                    <label class="btn btn-primary btn-select">
                        <input type="checkbox" class="check" value="software Engineering"> Software Engineering
                    </label>
                    <label class="btn btn-primary btn-select">
                        <input type="checkbox" class="check" value="programming Fundamentals" name="programming Fundamentals"> Programming Fundamentals
                    </label>
                    <label class="btn btn-primary btn-select">
                        <input type="checkbox" class="check" value="data Structures" name="data Structures"> Data Structures
                    </label>
                    <label class="btn btn-primary btn-select">
                        <input type="checkbox" class="check" value="database" name="database"> Database
                    </label>

                </div>
                <div class="row">
                    <div class="col-8">
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Next</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('.check').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass   : 'iradio_square-blue',
            increaseArea : '10%' // optional
        });
        $('.check').on('ifChecked', function (event) {
            let elem = $(this).parent().parent();
            elem.addClass( "activeCheck" );
        });
        $('.check').on('ifUnchecked', function (event) {
            let elem = $(this).parent().parent();
            elem.removeClass( "activeCheck" );
        });
    })
</script>
</body>
</html>


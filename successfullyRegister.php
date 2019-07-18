<?php
/**
 * Created by PhpStorm.
 * User: alihamza
 * Date: 5/22/18
 * Time: 3:43 PM
 */
session_start();
?>

<!DOCTYPE html>
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


    <!-- pic-name-show-url-->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

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
            <div class="row">
                <div class="widget-user-image col-md-4" ></div>
                <div class="widget-user-image col-md-4" >
                    <img class="img-circle elevation-2" src="<?php echo $_SESSION['userPic'] ?>" style="width: 100%;" alt="User Avatar">
                </div>
            <p class="login-box-msg">Hy! <span style="color: #00c0ef;font-size: large"><?php echo $_SESSION['firstName'] ?></span> Tou have successfully registered
                 Now Login,ask and answers queries it</p>

            </div>
            <form action="login.php">
                 <div class="row">

                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.pic-name-show -->
<script>
    $('#fileToUpload').on('change',function(){
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    })
</script>
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



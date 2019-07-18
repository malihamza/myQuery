<?php
/**
 * Created by PhpStorm.
 * User: alihamza
 * Date: 5/22/18
 * Time: 4:26 PM
 */?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Log in</title>
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
</head>
<body class="hold-transition login-page" style="background: url('64xk850n3a8uzse6fi11l3vmz.jpg');">
<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html" style="color: white"><b>myQuery</b>.com</a>
    </div>
    <!-- /.login-logo -->
    <div class="card" >
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

                <div class="input-group mb-3">
                    <input type="text" id="rollno" class="form-control" placeholder="Roll No" name="rollNo" aria-describedby="basic-addon2" required>
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">@pucit.edu.pk</span>
                    </div>
                </div>
                <span class="fa fa-envelope form-control-feedback" style="margin-top: -25px;"></span>

                <div class="form-group has-feedback" id="loginBox">
                    <input type="password" id="passwd" class="form-control" name="password" placeholder="Password" required>
                    <span class="fa fa-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" name="signIn" onclick="signInMe()" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
                   <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass   : 'iradio_square-blue',
            increaseArea : '20%' // optional
        })
    });
function signInMe()
{
    var roll = document.getElementById('rollno').value;
    var pass = document.getElementById('passwd').value;
    $.post('loginForm.php',{rollNo:roll,passwd:pass
    },function (data,status)
    {
        if(status)
        {
            if (data == "1")
            {
                $('#loginBox').append("<span style='color: red'>RollNo or password is incorrect</span>");
            }
            else
                {
                    window.location="newsFeed.php";
                }
        }

    });

}

</script>
</body>
</html>


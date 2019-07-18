<?php
/**
 * Created by PhpStorm.
 * User: alihamza
 * Date: 5/19/18
 * Time: 1:47 PM
 */
//include_once ("connection.php");

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminLTE 3 | Registration Page</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta id="viewport" content="width=device-width, initial-scale=1">

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
        </style>
    </head>
    <body class="hold-transition register-page body">

        <div class="register-box">
            <div class="register-logo">
                <a href="index2.html" style="color: white"><b>myQuery</b>.com</a>
            </div>

            <div class="card">
                <div class="card-body register-card-body">
                    <p class="login-box-msg">Register a new membership</p>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="First Name" id="firstName" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Last Name" id="lastName" >
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Roll No" id="rollNo" aria-describedby="basic-addon2" required>
                            <div class="input-group-append" >
                                <span class="input-group-text" id="basic-addon2">@pucit.edu.pk</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="date" class="form-control" placeholder="Date of Birth" id="dateOfBirth">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group " style="margin: 0.5rem 0rem;">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="gender" id="inlineRadio1" value="M">
                                        <label class="form-check-label" for="inlineRadio1"> Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="gender" id="inlineRadio2" value="F">
                                        <label class="form-check-label" for="inlineRadio2"> Female</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" class="form-control" placeholder="Password" id="password" >
                        </div>
                        <div class="form-group has-feedback" id="ha">
                            <input type="password" class="form-control" placeholder="Retype password" id="retypePassword" >
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="checkbox icheck">
                                    <label>
                                        <input type="checkbox" required> I agree to the <a href="#">terms</a>
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button onclick="register1()" id="submit"  class="btn btn-primary btn-block btn-flat">Register</button>
                            </div>
                            <!-- /.col -->
                        </div>


                    <a href="login.php" class="text-center">I already have a membership</a>
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
            function register1()
            {
                var roll = document.getElementById('rollNo').value;
                var fName = document.getElementById('firstName').value;
                var lName = document.getElementById('lastName').value;
                var pass = document.getElementById('password').value;
                var repass = document.getElementById('retypePassword').value;
                var dob = document.getElementById('dateOfBirth').value;
                var gend = document.getElementById('gender').value;

                if(pass == repass)
                {
                    $.post('registerForm.php',{rollNo:roll,password:pass,firstName :fName,lastName :lName,gender:gend,dateOfBirth:dob
                    },function (data,status)
                    {
                        if(status)
                        {
                            if (data == "1")
                            {
                                $('#rollNo').append("<span style='color: red'>User Already Exist</span>");
                            }
                            else
                            {
                                window.location="topic.php";
                            }
                        }

                    });
                }
                else
                {
                    $('#ha').append('<span style="color: red">Password did not match.</span>');
                }


            }

            $(function () {
    $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass   : 'iradio_square-blue',
                    increaseArea : '20%' // optional
                })
            })
        </script>
    </body>
</html>

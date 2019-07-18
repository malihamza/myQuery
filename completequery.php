<?php
/**
 * Created by PhpStorm.
 * User: alihamza
 * Date: 5/26/18
 * Time: 11:51 AM
 */
include_once ('connection.php');
include_once ('userData.php');
session_start();
?>
<?php
/**
 * Created by PhpStorm.
 * User: alihamza
 * Date: 5/25/18
 * Time: 11:28 PM
 */
include_once('connection.php');
include_once('userData.php');
$rollNo=$_SESSION['rollNo'];
$userData= getUserData($rollNo,$conn);
$userName = $userData['firstName']." ".$userData['lastName'];
$userPic = $userData;
$questionId = $_GET['qid'];
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title><?php echo $userName ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Custom style -->
    <link rel="stylesheet" href="dist/css/custom.css">
    <!-- Google Font: Source Sans Pro -->

    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- Google Font: Source Sans Pro -->

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->

    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <nav class="main-header navbar  navbar-expand navbar-light border-bottom fixed-top" style="background-color:#293042;height: 43px;">
            <div class="container" ">
            <!-- Left navbar links -->


            <!-- SEARCH FORM -->
            <form class="form-inline ml-5" method="get" action="search.php">
                <div class="input-group input-group-sm">
                    <select name="advancedSearch" class="form-control " style="
                        width: 100px;height: 30px;margin-top: -0.07em;background-color: #E4DFDD;">
                        <option value="people">People</option>
                        <option value="questions">Questions</option>
                    </select>
                    <input class="form-control form-control-navbar" onkeyup="liveSearch(this.value)" style="width: 400px;background-color: white;" type="search" name="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append" style="background-color: #f2f4f6">
                        <button class="btn btn-navbar" type="submit"  name="query" style="background-color: #f2f4f6">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <ul class="navbar-nav" >
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="newsFeed.php" class="nav-link " style="color: white;">Home</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto" >
                <!-- Messages Dropdown Menu -->
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link"      href="notification.php">
                        <i class="fa fa-bell-o" style="font-size: 20px;color: white;";></i>
                        <span class="badge badge-warning navbar-badge" id="notifications"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="dropdown" style="">
                        <div class="widget-user-image" style="margin-top: -5px;">
                            <img class="img-circle elevation-2" style="height: 35px;width: 40px;" src="<?php echo $userData['userPic']?>" alt="User Avatar" style="width: 40px;height: 40px;">

                        </div>

                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="margin-right: 140px;">

                        <a href="login.php" class="dropdown-item dropdown-footer">Log Out</a>
                    </div>

                </li>
            </ul>

            <a href="query.php"><button class="btn btn-primary btn-sm" ><i class="fa fa-plus"></i> <b>Ask Query</b></button></a>

    </div>

    </nav>

    <div class="content">
            <div class="container-fluid">
                <div class="row news-feed">
                    <div class="container">
                        <div class="row" style="width: 1300px;margin-left: -75px;">
                            <!-- /.col -->
                            <div class="col-md-8 ">
                                    <!-- /.card-header -->
                                                <!-- Post -->
                                                <?php

                                                    displaySingleQuery($_SESSION['rollNo'],$userPic['userPic'],$questionId,$conn);
                                                    echo "<br><br><br><br><br><br><br>";
                                                    $result  = getAnswerDetail($questionId,$conn);
                                                    $numOfRows = mysqli_num_rows($result);
                                                    echo "<h1><b>Answers(".$numOfRows.")</b></h1>
                                                    <hr size='30'>
                                                    <br><br>";

                                                    if($numOfRows>0)
                                                    {
                                                        while($row = mysqli_fetch_assoc($result))
                                                        {
                                                            displayAnswer($_SESSION['rollNo'],$row['rollNo'],$row['description'],$row['timeOfAnswer'],
                                                                $row['dateOfAnswer'],$row['answerId'],$conn);
                                                        }
                                                    }
                                                    
                                                    ?>

                                <!-- /.tab-content -->

                                      <!-- /.card -->
                                    <form action="answerForm.php" method="post">

                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    Answer the Query
                                                </h3>
                                                <!-- tools box -->
                                                <div class="card-tools">


                                                </div>
                                                <!-- /. tools -->
                                            </div>
                                            <!-- /.card-header -->

                                            <div class="card-body pad">
                                                <div class="mb-3">

                                                <textarea class="textarea form-control rounded-0" name="description" placeholder="Place some text here"
                                                          style="width: 100%; height: 200px; border-radius:5px;font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>

                                                    <p></p>
                                                    <div class="row">
                                                        <div class="col-md-9"></div>
                                                        <div class="col-md-3">
                                                            <input type="hidden" name="id" value=<?php echo $questionId?>>
                                                        <button type="submit" name="submit" style="width: 100%;" class="btn btn-primary btn-block btn-flat
                                                             ">Submit Answer</button>
                                                    </div>


                                                </div>

                                            </div>
                                    </form>
                                </div>

                            <!-- /.nav-tabs-custom -->
                            </div>

                            <!-- /.col -->

                        <div class="col-md-1" style="margin-top: -20px;position:fixed;right:0;border:1px solid #f4f5f9;border-left-color: #ccc;margin-right: 100px;"  >
                            <p><b>CONTACTS</b></p>
                            <?php
                            $res = getFollowing($_SESSION['rollNo'],$conn);
                            while ($row = mysqli_fetch_assoc($res))
                            {
                                singlePersonMessage($row['rollNo'],$conn);
                            }
                            ?>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->

<div id="chat-box" style="display: none">
    <div class='chatbox' >
        <div class='card card-primary direct-chat direct-chat-primary' style='border-radius: 0px;margin-bottom: 0px !important;'>
            <div class='card-header' style='border-radius: 0px;padding: .4rem 1.25rem;'>
                <h3 class='card-title'>Direct Chat</h3>

                <div class='card-tools'>
                    <span data-toggle='tooltip' title='3 New Messages' class='badge bg-primary'>3</span>
                    <button type='button' class='btn btn-tool' data-widget='collapse'><i class='fa fa-minus'></i>
                    </button>
                    <button type='button' class='btn btn-tool' data-toggle='tooltip' title='Contacts' data-widget='chat-pane-toggle'>
                        <i class='fa fa-comments'></i></button>
                    <button type='button' class='btn btn-tool' onclick="closeBox()"><i class='fa fa-times'></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class='card-body'>
                <!-- Conversations are loaded here -->
                <div class='direct-chat-messages' id='directMessage'>
                    <!-- Message. Default to the left -->
                </div>
                <!-- Contacts are loaded here -->
                <div class='direct-chat-contacts'>
                    <!-- /.contatcts-list -->
                </div>
                <!-- /.direct-chat-pane -->
            </div>
            <!-- /.card-body -->

            <div class='card-footer' style="height: 80px;">
                <div class='input-group'>
                    <input type='text' id='message' placeholder='Type a message ...' class='form-control'>
                    <input type='hidden' value='' id='messageTo'>
                    <span class='input-group-append'>
                                <button id='submit1' class='btn btn-primary'>Send</button>
                            </span>
                </div>

                <div class="dropup">
                    <span data-toggle="dropdown" style="font-size: 25px;cursor: pointer"><p>&#9786</p></span>
                    <ul class="dropdown-menu" style="height: 320px;>
                                <li class="divider"><span class="emoji" id="&#x1f603" onclick="f(this.id)">&#x1f603</span>
                    <span class="emoji" id="&#x1f601"  onclick="f(this.id)">&#x1f601</span>
                    <span class="emoji" id="&#x1f917" onclick="f(this.id)">&#x1f917</span>
                    <span class="emoji" id="&#x1f929" onclick="f(this.id)">&#x1f929</span>
                    <span class="emoji" id="&#x1f914" onclick="f(this.id)">&#x1f914</span>
                    <span class="emoji" id="&#x1f928" onclick="f(this.id)">&#x1f928</span>
                    <span class="emoji" id="&#x1f600" onclick="f(this.id)">&#x1f600</span>
                    <span class="emoji" id="&#x1f396" onclick="f(this.id)">&#x1f396</span>
                    </li>
                    <li class="divider">
                        <span class="emoji" id="&#x1f602" onclick="f(this.id)">&#x1f602</span>
                        <span class="emoji" id="&#x1f604" onclick="f(this.id)">&#x1f604</span>
                        <span class="emoji" id="&#x1f605" onclick="f(this.id)">&#x1f605</span>
                        <span class="emoji" id="&#x1f606" onclick="f(this.id)">&#x1f606</span>
                        <span class="emoji" id="&#x1f609" onclick="f(this.id)">&#x1f609</span>
                        <span class="emoji" id="&#x1f60A" onclick="f(this.id)">&#x1f60A</span>
                        <span class="emoji" id="&#x1f60B" onclick="f(this.id)">&#x1f60B</span>
                        <span class="emoji" id="&#x1f381" onclick="f(this.id)">&#x1f381</span>
                    </li>
                    <li class="divider">
                        <span class="emoji" id="&#x1f60E" onclick="f(this.id)">&#x1f60E</span>
                        <span class="emoji" id="&#x1f618" onclick="f(this.id)">&#x1f618</span>
                        <span class="emoji" id="&#x1f610" onclick="f(this.id)">&#x1f610</span>
                        <span class="emoji" id="&#x1f617" onclick="f(this.id)">&#x1f617</span>
                        <span class="emoji" id="&#x1f619" onclick="f(this.id)">&#x1f619</span>
                        <span class="emoji" id="&#x263A" onclick="f(this.id)">&#x263A</span>
                        <span class="emoji" id="&#x1f642" onclick="f(this.id)">&#x1f642</span>
                        <span class="emoji" id="&#x1f384" onclick="f(this.id)">&#x1f384</span>
                    </li>
                    <li class="divider">
                        <span class="emoji" id="&#x1f611" onclick="f(this.id)">&#x1f611</span>
                        <span class="emoji" id="&#x1f644" onclick="f(this.id)">&#x1f644</span>
                        <span class="emoji" id="&#x1f636" onclick="f(this.id)">&#x1f636</span>
                        <span class="emoji" id="&#x1f623" onclick="f(this.id)">&#x1f623</span>
                        <span class="emoji" id="&#x1f625" onclick="f(this.id)">&#x1f625</span>
                        <span class="emoji" id="&#x1f910" onclick="f(this.id)">&#x1f910</span>
                        <span class="emoji" id="&#x1f62A" onclick="f(this.id)">&#x1f62A</span>
                        <span class="emoji" id="&#x1f388" onclick="f(this.id)">&#x1f388</span>
                    </li>
                    <li class="divider">
                        <span class="emoji" id="&#x1f62B" onclick="f(this.id)">&#x1f62B</span>
                        <span class="emoji" id="&#x1f61B" onclick="f(this.id)">&#x1f61B</span>
                        <span class="emoji" id="&#x1f61C" onclick="f(this.id)">&#x1f61C</span>
                        <span class="emoji" id="&#x1f61D" onclick="f(this.id)">&#x1f61D</span>
                        <span class="emoji" id="&#x1f924" onclick="f(this.id)">&#x1f924</span>
                        <span class="emoji" id="&#x1f613" onclick="f(this.id)">&#x1f613</span>
                        <span class="emoji" id="&#x1f624" onclick="f(this.id)">&#x1f624</span>
                        <span class="emoji" id="&#x1f3C6" onclick="f(this.id)">&#x1f3C6</span>
                    </li>
                    <li class="divider">
                        <span class="emoji" id="&#x1f62D" onclick="f(this.id)">&#x1f62D</span>
                        <span class="emoji" id="&#x1f628" onclick="f(this.id)">&#x1f628</span>
                        <span class="emoji" id="&#x1f62F" onclick="f(this.id)">&#x1f62F</span>
                        <span class="emoji" id="&#x1f631" onclick="f(this.id)">&#x1f631</span>
                        <span class="emoji" id="&#x1f92A" onclick="f(this.id)">&#x1f92A</span>
                        <span class="emoji" id="&#x1f621" onclick="f(this.id)">&#x1f621</span>
                        <span class="emoji" id="&#x1f912" onclick="f(this.id)">&#x1f912</span>
                        <span class="emoji" id="&#x1f630" onclick="f(this.id)">&#x1f630</span>
                    </li>
                    <li class="divider">
                        <span class="emoji" id="&#x1f607" onclick="f(this.id)">&#x1f607</span>
                        <span class="emoji" id="&#x1f920" onclick="f(this.id)">&#x1f920</span>
                        <span class="emoji" id="&#x1f92D" onclick="f(this.id)">&#x1f92D</span>
                        <span class="emoji" id="&#x1f9D0" onclick="f(this.id)">&#x1f9D0</span>
                        <span class="emoji" id="&#x1f915" onclick="f(this.id)">&#x1f915</span>
                        <span class="emoji" id="&#x1f92F" onclick="f(this.id)">&#x1f92F</span>
                        <span class="emoji" id="&#x1f630" onclick="f(this.id)">&#x1f630</span>
                        <span class="emoji" id="&#x1f479" onclick="f(this.id)">&#x1f479</span>
                    </li>
                    <li class="divider">
                        <span class="emoji" id="&#x1f92F" onclick="f(this.id)">&#x1f92F</span>
                        <span class="emoji" id="&#x1f915" onclick="f(this.id)">&#x1f915</span>
                        <span class="emoji" id="&#x1f922" onclick="f(this.id)">&#x1f922</span>
                        <span class="emoji" id="&#x1f92E" onclick="f(this.id)">&#x1f92E</span>
                        <span class="emoji" id="&#x1f92D" onclick="f(this.id)">&#x1f92D</span>
                        <span class="emoji" id="&#x1f913" onclick="f(this.id)">&#x1f913</span>
                        <span class="emoji" id="&#x1f921" onclick="f(this.id)">&#x1f921</span>
                        <span class="emoji" id="&#x1f927" onclick="f(this.id)">&#x1f927</span>
                    </li>
                    <li class="divider">
                        <span class="emoji" id="&#x1f448" onclick="f(this.id)">&#x1f448</span>
                        <span class="emoji" id="&#x1f449" onclick="f(this.id)">&#x1f449</span>
                        <span class="emoji" id="&#x1f446" onclick="f(this.id)">&#x1f446</span>
                        <span class="emoji" id="&#x1f44C" onclick="f(this.id)">&#x1f44C</span>
                        <span class="emoji" id="&#x1f44D" onclick="f(this.id)">&#x1f44D</span>
                        <span class="emoji" id="&#x1f44E" onclick="f(this.id)">&#x1f44E</span>
                        <span class="emoji" id="&#x1f44A" onclick="f(this.id)">&#x1f44A</span>
                        <span class="emoji" id="&#x1f44B" onclick="f(this.id)">&#x1f44B</span>
                    </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /.card-footer-->
    </div>
</div>

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>


<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- CK Editor -->
<script src="plugins/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        ClassicEditor
            .create(document.querySelector('#editor1'))
            .then(function (editor) {
                // The editor instance
            })
            .catch(function (error) {
                console.error(error)
            })

        // bootstrap WYSIHTML5 - text editor

        $('.textarea').wysihtml5({
            toolbar: { fa: true }
        })
    })
</script>
<script>
    var timer, delay = 2000;

    timer = setInterval(function(){
        $.ajax({
            type: 'POST',
            url: "ajax/notificationGet.php",
            success: function(html){
                $('#notifications').text(html);
            }
        });
    }, delay);
</script>
<script>
    var flagOpen = 0;
    function showMessageBox(id)
    {
        flagOpen = 1;
        $('#directMessage').text('');
        document.getElementById('chat-box').style.display='block';
        $.post('ajax/messageGet.php',
            {
                messageTo:id

            },
            function (data,status)
            {
                $('#directMessage').append(data)

            });
        document.getElementById('messageTo').value=id;
        document.getElementById("directMessage").scrollTop = document.getElementById("directMessage").scrollHeight;
    }

    function closeBox()
    {
        flagOpen=0;
        document.getElementById('chat-box').style.display='none';
    }

    $(document).ready(function ()
    {
        $("#submit1").click(function ()
        {
            var mTo = document.getElementById('messageTo').value;
            $.post('ajax/messageSend.php',
                {
                    messageTo:mTo,
                    message:$('#message').val()
                },function (data)
                {
                    $('#directMessage').append(data);
                });
            document.getElementById('message').value='';
            document.getElementById("directMessage").scrollTop = document.getElementById("directMessage").scrollHeight+100;
        });

    });

    var timer, delay = 2000;
    timer = setInterval(function()
    {
        if(flagOpen==1)
        {
            var mTo = document.getElementById('messageTo').value;
            $.post("ajax/singleMessageGet.php",{messageTo:mTo},function (data)
            {
                $('#directMessage').append(data);
            });
        }

    }, delay);
    function f(id)
    {
        $('#message').val($('#message').val() + id);

    }
</script>
<!-- Bootstrap 4 -->
<!-- AdminLTE App -->
<script>
    function deleteAnswer(id)
    {
        $('#myInput').trigger('focus');
        $('#ha').click(function ()
        {
            $.post("ajax/deleteAnswer.php",
                {
                    answerId:id
                },
                function (data)
                {
                    alert(data);
                });
        });
        /* */
    }

</script>

<div class="modal fade" id="exampleModalCenterQuery" tabindex="-1"
     role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
     style="margin-top: -195px;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><b>Delete Post</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                You are about to delete this post. The post will also be removed
                from your posts permanently.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="ha" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<div class="modal fade" id="exampleModalCenter" tabindex="-1"
     role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"
     style="margin-top: -195px;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><b>Delete Post</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                You are about to delete this answer. The answer will also be removed
                 permanently.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="ha" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>



<div id="chat-box" style="display: none">
    <div class='chatbox' >
        <div class='card card-primary direct-chat direct-chat-primary' style='border-radius: 0px;margin-bottom: 0px !important;'>
            <div class='card-header' style='border-radius: 0px;padding: .4rem 1.25rem;'>
                <h3 class='card-title'>Direct Chat</h3>

                <div class='card-tools'>
                    <span data-toggle='tooltip' title='3 New Messages' class='badge bg-primary'>3</span>
                    <button type='button' class='btn btn-tool' data-widget='collapse'><i class='fa fa-minus'></i>
                    </button>
                    <button type='button' class='btn btn-tool' data-toggle='tooltip' title='Contacts' data-widget='chat-pane-toggle'>
                        <i class='fa fa-comments'></i></button>
                    <button type='button' class='btn btn-tool' onclick="closeBox()"><i class='fa fa-times'></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class='card-body'>
                <!-- Conversations are loaded here -->
                <div class='direct-chat-messages' id='directMessage'>
                    <!-- Message. Default to the left -->
                </div>
                <!-- Contacts are loaded here -->
                <div class='direct-chat-contacts'>
                    <!-- /.contatcts-list -->
                </div>
                <!-- /.direct-chat-pane -->
            </div>
            <!-- /.card-body -->

            <div class='card-footer'>
                <div class='input-group'>
                    <input type='text' id='message' placeholder='Type a message ...' class='form-control'>
                    <input type='hidden' value='' id='messageTo'>
                    <span class='input-group-append'>
                                <button id='submit1' class='btn btn-primary'>Send</button>
                            </span>
                </div>
            </div>
            <!-- /.card-footer-->
        </div>
    </div>
</div>


<script>
    function postComment(id,e)
    {
        var v = document.getElementById(id).value;
        var qid = id.slice(0,-1);
        var box = qid+"comment";
        if(e.keyCode==13)
        {
            $.post("commentPost.php",
                {
                    questionId: qid,
                    commentData:v
                },function (data)
                {
                    $('#'+box).append(data);
                }
            );

            document.getElementById(id).value="";
        }

    }
</script>


<script>
    var flagOpen = 0;
    function showMessageBox(id)
    {
        flagOpen = 1;
        $('#directMessage').text('');
        document.getElementById('chat-box').style.display='block';
        $.post('ajax/messageGet.php',
            {
                messageTo:id

            },
            function (data,status)
            {
                $('#directMessage').append(data)

            });
        document.getElementById('messageTo').value=id;
        document.getElementById("directMessage").scrollTop = document.getElementById("directMessage").scrollHeight;
    }

    function closeBox()
    {
        flagOpen=0;
        document.getElementById('chat-box').style.display='none';
    }

    $(document).ready(function ()
    {
        $("#submit1").click(function ()
        {
            var mTo = document.getElementById('messageTo').value;
            $.post('ajax/messageSend.php',
                {
                    messageTo:mTo,
                    message:$('#message').val()
                },function (data)
                {
                    $('#directMessage').append(data);
                });
            document.getElementById('message').value='';
            document.getElementById("directMessage").scrollTop = document.getElementById("directMessage").scrollHeight+100;
        });

    });

    var timer, delay = 2000;
    timer = setInterval(function()
    {
        if(flagOpen==1)
        {
            var mTo = document.getElementById('messageTo').value;
            $.post("ajax/singleMessageGet.php",{messageTo:mTo},function (data)
            {
                $('#directMessage').append(data);
            });
        }

    }, delay);
</script>
<script>
    function likeQuery(id)
    {
        var choice = 0;
        id = id.slice(0,-1);
        if(document.getElementById(id+'l').style.color=='blue')
        {
            document.getElementById(id+'d').style.color="black";
            document.getElementById(id+'l').style.color="black";
            choice =1;
            $.post("ajax/likeDislikeQuery.php",{choice:choice,questionId:id});
        }
        else if(document.getElementById(id+'d').style.color=='red')
        {
            document.getElementById(id+'d').style.color="black";
            document.getElementById(id+'l').style.color="blue";
            choice =2;
            $.post("ajax/likeDislikeQuery.php",{choice:choice,questionId:id});
        }
        else
        {
            document.getElementById(id+'d').style.color="black";
            document.getElementById(id+'l').style.color="blue";
            choice =3;
            $.post("ajax/likeDislikeQuery.php",{choice:choice,questionId:id});
        }

    }
    function disLikeQuery(id)
    {
        var choice =0;
        id = id.slice(0,-1);
        if(document.getElementById(id+'d').style.color=='red')
        {
            document.getElementById(id+'d').style.color="black";
            document.getElementById(id+'l').style.color="black";
            choice =4;
            $.post("ajax/likeDislikeQuery.php",{choice:choice,questionId:id});
        }
        else if(document.getElementById(id+'l').style.color=='blue')
        {
            document.getElementById(id+'d').style.color="red";
            document.getElementById(id+'l').style.color="black";
            choice =5;
            $.post("ajax/likeDislikeQuery.php",{choice:choice,questionId:id});
        }
        else
        {
            document.getElementById(id+'d').style.color="red";
            document.getElementById(id+'l').style.color="black";
            choice =5+1;
            $.post("ajax/likeDislikeQuery.php",{choice:choice,questionId:id});
        }
    }
</script>



<script>
    function likeAnswer(id)
    {
        var choice = 0;
        id = id.slice(0,-1);
        if(document.getElementById(id+'l').style.color=='blue')
        {
            document.getElementById(id+'d').style.color="black";
            document.getElementById(id+'l').style.color="black";
            choice =1;
            $.post("ajax/likeDislikeAnswer.php",{choice:choice,answerId:id});
        }
        else if(document.getElementById(id+'d').style.color=='red')
        {
            document.getElementById(id+'d').style.color="black";
            document.getElementById(id+'l').style.color="blue";
            choice =2;
            $.post("ajax/likeDislikeAnswer.php",{choice:choice,answerId:id});
        }
        else
        {
            document.getElementById(id+'d').style.color="black";
            document.getElementById(id+'l').style.color="blue";
            choice =3;
            $.post("ajax/likeDislikeAnswer.php",{choice:choice,answerId:id});
        }

    }
    function disLikeAnswer(id)
    {
        var choice =0;
        id = id.slice(0,-1);
        if(document.getElementById(id+'d').style.color=='red')
        {
            document.getElementById(id+'d').style.color="black";
            document.getElementById(id+'l').style.color="black";
            choice =4;
            $.post("ajax/likeDislikeAnswer.php",{choice:choice,answerId:id});
        }
        else if(document.getElementById(id+'l').style.color=='blue')
        {
            document.getElementById(id+'d').style.color="red";
            document.getElementById(id+'l').style.color="black";
            choice =5;
            $.post("ajax/likeDislikeAnswer.php",{choice:choice,answerId:id});
        }
        else
        {
            document.getElementById(id+'d').style.color="red";
            document.getElementById(id+'l').style.color="black";
            choice =5+1;
            $.post("ajax/likeDislikeAnswer.php",{choice:choice,answerId:id});
        }
    }
</script>
</body>
</html>




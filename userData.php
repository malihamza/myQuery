<?php
/**
 * Created by PhpStorm.
 * User: alihamza
 * Date: 5/22/18
 * Time: 5:26 PM
 */

function getMonth($month)
{
    $monthArray = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
    return $monthArray[$month];
}

function getDateInFormat($date)
{
    $d = $date[8].$date[9]." ".getMonth(($date[5])*10+($date[6]))." ".$date[0].$date[1].$date[2].$date[3];
    return $d;
}

function getTimeFormat($date)
{
    $t = $date[11].$date[12].$date[13].$date[14].$date[15];
    return $t;
}

function getFisrtAndLastName($rollNo,$conn)
{
    $query = "SELECT firstName,lastName from userInfo where lower(rollNo)='".strtolower($rollNo)."'";
    $resultOfQuery = mysqli_query($conn,$query);
    $getResult = $resultOfQuery->fetch_assoc();
    return $getResult;
}
function getUserPicAddress($rollNo,$conn)
{
    $getPicQuery = "SELECT userPic from userInfo where lower(rollNo) = '".strtolower($rollNo)."'";
    $resultPicQuery = mysqli_query($conn,$getPicQuery);
    $userPic = $resultPicQuery->fetch_assoc();
    return $userPic;
}
function getSubjectId($subjectName,$conn)
{
    $query = "SELECT subjectId from subjects where lower(subjectName)='".strtolower($subjectName)."'";
    $resultOfQuery = mysqli_query($conn,$query);
    $getResult = $resultOfQuery->fetch_assoc();
    return $getResult;

}
function getQuestionDetail($questionId,$conn)
{
    $query = "SELECT heading,description, dateOfQuestion,timeOfQuestion,subjectId,rollNo from questions where questionId=".$questionId;
    $resultOfQuery = mysqli_query($conn,$query);
    $getResult = $resultOfQuery->fetch_assoc();
    return $getResult;
}
function getSubjectName($subjectId,$conn)
{
    $query = "SELECT subjectName from subjects where lower(subjectId)='".strtolower($subjectId)."'";
    $resultOfQuery = mysqli_query($conn,$query);
    $getResult = $resultOfQuery->fetch_assoc();
    return $getResult['subjectName'];
}
function getQuestionsId($rollNo,$limit,$offset,$conn)
{
    $q = "SELECT questionId from questions where lower(rollNo)= '".strtolower($rollNo)."' 
    order by dateOfQuestion,timeOfQuestion DESC LIMIT $limit OFFSET $offset";
    $res = mysqli_query($conn,$q);
    return $res;
}
function postComment($rollNo,$questionId,$commentData,$conn)
{
    date_default_timezone_set("Asia/Karachi");
    $timeOfComment=date("h:i:sa");
    $dateOfComment=date("y/m/d",time());

    $insertQuery = "INSERT INTO comments(rollNo,questionId,commentData,timeOfComment,dateOfComment)
                    VALUES ('".$rollNo."',".$questionId.",'".$commentData."','".$timeOfComment."','".$dateOfComment."')";
    $res=mysqli_query($conn,$insertQuery);
}
function getCommentData($commentId,$conn)
{
    $getQuery = "SELECT rollNo,timeOfComment,dateOfComment,commentData from comments where commentId = ".$commentId;
    $res = mysqli_query($conn,$getQuery);
    $resu = $res->fetch_assoc();
    return $resu;
}
function displayComment($commentId,$conn)
{

    $commentData    =     getCommentData($commentId,$conn);
    $rollNo         =     $commentData['rollNo'];
    $userPic        =     getUserPicAddress($rollNo,$conn);
    $userName       =     getFisrtAndLastName($rollNo,$conn);
    $commentDescription = $commentData['commentData'];
    $commentTime    =     $commentData['timeOfComment'];
    $commentTime    =     $commentTime[0].$commentTime[1].$commentTime[2].$commentTime[3].$commentTime[4];
    $commentDate    =     $commentData['dateOfComment'];
    date_default_timezone_set("Asia/Karachi");
    $d = date('Y-M-d',time());
    $date = date_create($d);
    $date2 = date_create($commentDate);
    $diff=date_diff($date2,$date);
    if($diff->format("%R%a days")<1)
    {
        $commentDate = "Today";
    }
    else if($diff->format("%R%a days")==1)
    {
        $commentDate = "Yesterday";
    }

    echo "<div class='card-comment'>
               <img class='img-circle img-sm' src='".$userPic['userPic']."' alt='User Image'>
               <div class='comment-text'>
                    <span class='username'>".$userName['firstName']." ".$userName['lastName']."
                        <span class='text-muted float-right'>".$commentTime." ".$commentDate."</span>
                    </span><!-- /.username -->
                       ".$commentDescription."
                </div>
          </div>";
}
function getCommentsId($questionId,$conn)
{
    $getQuery = "SELECT commentId from comments where questionId = ".$questionId." ORDER BY  dateOfComment,timeOfComment";
    $res = mysqli_query($conn,$getQuery);
    return $res;

}



function addToYourFeedOne($rollNo,$conn)
{
    $userPic = getUserPicAddress($rollNo,$conn);
    $userName = getFisrtAndLastName($rollNo,$conn);
    echo "<div class='row'>
              <div class='col-md-2'>
                 <img class='img-circle' width='100%' src='".$userPic['userPic']."' alt='User Image'>
              </div>
              <div class='col-md-6'>
                <a href='profile.php?id=".$rollNo."'  style='font-size: 14px;'>".$userName['firstName']." ".$userName['lastName']."</a>
              </div>
              <div class='col-md-2'>
                  <a href='#' class='btn btn-primary btn-sm' style='font-size: 12px;'><i class='fa fa-plus'></i> Follow</a>
              </div>
          </div>
          <p></p>";

}
function getCampus($rollNo)
{
    if($rollNo[7]=='0')
    {
        return "Old Campus";
    }
    return "New Campus";
}
function getDegree($rollNo)
{
    if($rollNo[1]=='S')
    {
        return "Software Engineering";
    }
    if($rollNo[1]=='C')
    {
        return "Computer Science";
    }
    return "Information Technology";
}
function getNoOfQuestionAsked($rollNo,$conn)
{
    $getQuery = "SELECT  questionId from questions where rollNo = '".$rollNo."'";
    $res = mysqli_query($conn,$getQuery);
    return mysqli_num_rows($res);
}

function getUserData($rollNo,$conn)
{
    $getQuery = "SELECT * from userInfo where rollNo = '".$rollNo."'";
    $res = mysqli_query($conn,$getQuery);
    return $res->fetch_assoc();
}


function postAnswer($rollNo,$questionId,$description,$conn)
{
    date_default_timezone_set("Asia/Karachi");
    $timeOfAnswer=date("h:i:sa");
    $dateOfAnswer=date("y/m/d",time());
    $insertQuery = "INSERT INTO answers (rollNo,questionId,description,timeOfAnswer,dateOfAnswer) VALUES 
                     ('".$rollNo."',".$questionId.",'".$description."','".$timeOfAnswer."','".$dateOfAnswer."');";
    $res = mysqli_query($conn,$insertQuery);
}



function getAnswerDetail($questionId,$conn)
{
    $getQuery = "SELECT * FROM answers WHERE questionId = ".$questionId;
    $res = mysqli_query($conn,$getQuery);
    return $res;
}

function getAnswerVoteType($rollNo,$answerId,$conn)
{
    $quer = "SELECT voteType from voteAnswer WHERE rollNo = '".$rollNo."' AND answerId = ".$answerId;
    $res = mysqli_query($conn,$quer);
    return $res;

}


function displayAnswer($roll,$rollNo,$desc,$time,$date1,$answerId,$conn)
{

    $getUserDetail = getUserData($rollNo,$conn);

    date_default_timezone_set("Asia/Karachi");
    $d = date('Y-M-d',time());
    $date = date_create($d);
    $date2 = date_create($date1);
    $diff=date_diff($date2,$date);
    if($diff->format("%R%a days")<1)
    {
        $date1 = "Today";
    }
    else if($diff->format("%R%a days")==1)
    {
        $date1 = "Yesterday";
    }


    $voteType = getAnswerVoteType($roll,$answerId,$conn);
    $resultVote = mysqli_fetch_assoc($voteType);


    echo " <div class='card-header'>
              <div class='user-block'>
                  <img class='img-circle' src='".$getUserDetail['userPic']."' alt='User Image'>
                        <form>
                         <span class='username'><a href='profile.php?id=".$rollNo."'>".$getUserDetail['firstName']." ".$getUserDetail['lastName']." </a> </span>
                        </form>
                        <span class='description' >answerd at -".$time." ".$date1."</span>
              </div>";
    if($roll==$rollNo)
    {
        echo "   
                        <div class='card-tools'>
                            <button type='button' class='btn btn-tool' data-toggle='modal' data-target='#exampleModalCenter' 
                            id='".$answerId."'  onclick='deleteAnswer(this.id)' 
                             ><i class='fa fa-times'></i>
                            </button>
                        </div>";
    }
    echo "
            </div>
            <div class='card-body' style='border: 0px solid black;;'>
                 <p >".$desc."</p>";
    if($resultVote=='')
    {
        echo "<button type='button' class='btn btn-default btn-sm ' id='".$answerId."l' onclick='likeAnswer(this.id)'><i class='fa fa-thumbs-o-up' ></i> Like</button>
                         <button type='button' class='btn btn-default btn-sm ' id='".$answerId."d' onclick='disLikeAnswer(this.id)'><i class='fa fa-thumbs-o-down' ></i> Dislike</button>";
    }
    else if($resultVote['voteType']==1)
    {
        echo "<button type='button' class='btn btn-default btn-sm ' id='".$answerId."l' onclick='likeAnswer(this.id)'
                         style='color:blue'><i class='fa fa-thumbs-o-up' ></i> Like</button>
                         <button type='button' class='btn btn-default btn-sm ' id='".$answerId."d' onclick='disLikeAnswer(this.id)'><i class='fa fa-thumbs-o-down' ></i> Dislike</button>";
    }
    else if($resultVote['voteType']==-1)
    {
        echo "<button type='button' class='btn btn-default btn-sm ' id='".$answerId."l' onclick='likeAnswer(this.id)'
                         ><i class='fa fa-thumbs-o-up' ></i> Like</button>
                         <button type='button' class='btn btn-default btn-sm ' id='".$answerId."d' onclick='disLikeAnswer(this.id)'
                         style='color:red'><i class='fa fa-thumbs-o-down'></i> Dislike</button>";
    }
    echo " </div>
              <br>";
}






function noOfComments($questionId,$conn)
{
    $quer = "SELECT commentId from comments where questionId = ".$questionId;
    $res = mysqli_query($conn,$quer);
    return mysqli_num_rows($res);
}

function getSearchResults($search,$conn)
{
    $search1 = mysqli_real_escape_string($conn,$search);
    $searchQuery = "SELECT rollNo,firstName,lastName,userPic from userInfo where rollNo LIKE '%".$search1."%' OR firstName LIKE '%".$search1."%' OR lastName LIKE '%".$search1."%'";
    $getResult = mysqli_query($conn,$searchQuery);
    return $getResult;
}


function getQuestionSearchResults($search,$conn)
{
    $search1 = mysqli_real_escape_string($conn,$search);
    $searchQuery = "SELECT rollNo,heading,questionId from questions where heading LIKE '%".$search1."%'";
    $getResult = mysqli_query($conn,$searchQuery);
    return $getResult;
}


function follow($rollNoToFollow,$myRollNo,$conn)
{
    $insertQuery = "INSERT INTO followers (rollNo,followerId) VALUES 
                     ('".$rollNoToFollow."','".$myRollNo."');";
    $res = mysqli_query($conn,$insertQuery);
}

function getFollowers($rollNo,$conn)
{
    $searchQuery = "SELECT followerId from followers where rollNo ='".$rollNo."'";
    $getResult = mysqli_query($conn,$searchQuery);
    return $getResult;
}


function getFollowing($rollNo,$conn)
{
    $searchQuery = "SELECT rollNo from followers where followerId ='".$rollNo."'";
    $getResult = mysqli_query($conn,$searchQuery);
    return $getResult;
}
function isFollowing($frollNo,$rollNo,$conn)
{
    $getQuery = "SELECT followerId from followers where rollNo = '".$rollNo."' AND followerId = '".$frollNo."'";
    $res = mysqli_query($conn,$getQuery);
    return mysqli_num_rows($res)==1;
}


function searchDisplay($fRollNo,$rollNo,$name,$userPic,$conn)
{


      echo "<div class='row' style='margin-left: 10px;margin-top: 15px;'>
                                    <div class='col-md-2'>
                                        <img class='img-circle' style='height: 70%;width:70%;'; src='".$userPic."' alt=''>
                                    </div>
                                    <div class='col-md-8'>

                                        <span class='username'><a href='profile.php?id=".$rollNo."'><b>".$name."</b></a> </span><br>
                                         ".getDegree($rollNo)."<br>
                                        <i class='fa fa-map-marker mr-1'></i> <span class='description' style='color: rgba(0,0,0,.6);'>".getCampus($rollNo)."</span>
                                        <hr size='90'>
                                        
                                    </div>
                                    <div class='col-md-2' id='".$rollNo."'>";
                                    if($fRollNo!=$rollNo)
                                    {


                                        if (isFollowing($fRollNo, $rollNo, $conn) == 1)
                                        {
                                            echo "<button  type='submit'  class='btn   btn-outline-primary  btn-sm' id='" . $rollNo . "fol' onclick='followS(this.id)' style='font-size: 17px';>unfollow</button>";
                                            echo " <hr size='30' style='margin-top: 53px;margin-left: -15px;'>";
                                        }
                                        else
                                            {
                                            echo "

                                        <button  type='submit' name='submit' id='" . $rollNo . "fol' class='btn btn-primary btn-sm' onclick='followS(this.id)' style='font-size: 17px;'>Follow</button>
                                       ";
                                            echo " <hr size='30' style='margin-top: 53px;margin-left: -15px;'>";
                                        }
                                    }
                                      echo"

                                    </div>

                                </div>";
}


function searchQuestionDisplay($rollNo,$questionId,$heading,$conn)
{
    $userName = getFisrtAndLastName($rollNo,$conn);
    echo "<div class='row' style='margin-left: 5px;margin-top: 10px;'>
               <div class='col-md-8' style='margin-top: 2px;'>
                     <a href='completequery.php?qid=".$questionId."' style='color: black;'><h3><b>".$heading."</b></h3></a>
                     <span style='color: rgba(0,0,0,.6);font-size: 12px;';>asked by</span> <a href='profile.php?id=".$rollNo."'><b>".$userName['firstName']." ".$userName['lastName']."</b></a>
                      
               </div>
               <div class='col-md-2 ' >
                    <p></p>
                    <span  class='bg-info' style='padding: 18px 18px 18px 18px;border-radius: 50%;color: white;'>".noOfAnswers($questionId,$conn)."</span><br><p></p><span style='font-size: 12px;'>Answers</span>
               </div> 
 
               <div class='col-md-2 ' >
                    <p></p>
                    <span  style='padding: 18px 10px 18px 10px;border-radius: 50%;background-color: #D57108;color:white;'>122</span><br><p></p><span style='font-size: 12px;'><span style='color: white;'>h</span>Votes </span>
               </div>

           </div>

           <div class='row'>
                <div class='col-md-2'>
                </div>
                <div class='col-md-10'>
                    <hr size='30'>
                </div>
             </div>";
}


function noOfAnswers($questionId,$conn)
{
    $quer = "SELECT answerId from answers where questionId = ".$questionId;
    $res = mysqli_query($conn,$quer);
    return mysqli_num_rows($res);
}


function displaySingleQuery($roll,$picAddress,$questionId,$conn)
{


    $questionDetail = getQuestionDetail($questionId,$conn);

    $headingOfQuestion = $questionDetail['heading'];
    $descriptionOfQuestion = $questionDetail['description'];

    $res = getCommentsId($questionId,$conn);

    $numOfComments = mysqli_num_rows($res);
    $votes =countQueryVotes($questionId,$conn);
    if($votes=='')
    {
        $votes="No vote";
    }
    else if($votes==1)
    {
        $votes="1 vote";
    }
    else
    {
        $votes = $votes." votes";
    }
    $voteType = getQueryVote($roll,$questionId,$conn);
    $resultVote = mysqli_fetch_assoc($voteType);

    echo "<div class='card card-widget'>
                                         <!-- /.card-header -->
            <div class='card-body'>
            <div class='row'>
            <div class='col-md-11'>
                <h2><b>".$headingOfQuestion."</b></h2>
                </div>
         ";
    if($roll==$questionDetail['rollNo'])
    {
        echo "
                        <div class='card-tools col-md-1'>
                            <button type='button' class='btn btn-tool' data-toggle='modal' data-target='#exampleModalCenterQuery'
                            id='".$questionId."'  onclick='deleteQuery(this.id)'
                             ><i class='fa fa-times'></i>
                            </button>
                        </div>";
    }

           echo "
</div>
     <p>".$descriptionOfQuestion."</p>";
    if($resultVote=='')
    {
        echo "<button type='button' class='btn btn-default btn-sm ' id='".$questionId."l' onclick='likeQuery(this.id)'><i class='fa fa-thumbs-o-up' id='".$questionId."y'></i> Like</button>
                         <button type='button' class='btn btn-default btn-sm ' id='".$questionId."d' onclick='disLikeQuery(this.id)'><i class='fa fa-thumbs-o-down' id='".$questionId."n'></i> Dislike</button>";
    }
    else if($resultVote['voteType']==1)
    {
        echo "<button type='button' class='btn btn-default btn-sm ' id='".$questionId."l' onclick='likeQuery(this.id)'
                         style='color:blue'><i class='fa fa-thumbs-o-up' ></i> Like</button>
                         <button type='button' class='btn btn-default btn-sm ' id='".$questionId."d' onclick='disLikeQuery(this.id)'><i class='fa fa-thumbs-o-down' ></i> Dislike</button>";
    }
    else if($resultVote['voteType']==-1)
    {
        echo "<button type='button' class='btn btn-default btn-sm ' id='".$questionId."l' onclick='likeQuery(this.id)'
                         ><i class='fa fa-thumbs-o-up' ></i> Like</button>
                         <button type='button' class='btn btn-default btn-sm ' id='".$questionId."d' onclick='disLikeQuery(this.id)'
                         style='color:red'><i class='fa fa-thumbs-o-down'></i> Dislike</button>";
    }
              echo"  <span class='float-right text-muted'> ".$votes." - ".$numOfComments." Comments - ".noOfAnswers($questionId,$conn)." Answers</span>
               
          </div>
           
           
                                    <!-- /.card-body -->
          <div class='card-footer card-comments' id='".$questionId."comment'>";

    if($numOfComments)
    {
        while($row = mysqli_fetch_assoc($res))
        {

            displayComment($row['commentId'],$conn);
        }
    }
    echo "                               <!-- /.card-comment -->
          
        </div>
           
           
                                    <!-- /.card-footer -->
        <div class='card-footer'>
           
              <img class='img-fluid img-circle img-sm' src='".getUserPicAddress($roll,$conn)['userPic']."' alt='Alt Text'>
              <div class='img-push'>
                   <input type='hidden' name='questionId' value='".$questionId."'>
                  <input type='text' name='commentData' id='".$questionId."c' onkeypress='postComment(this.id,event)' class='form-control form-control-sm' placeholder='Press enter to post comment'>
              </div>
        </div>
       </div>";
}



function getTimelineQuestionId($rollNo,$limit,$offset,$conn)
{
    $q = "SELECT questionId from questions where rollNo= '".$rollNo."' OR rollNo In (SELECT rollNo from followers where followerId = '".$rollNo."')
            LIMIT $limit OFFSET $offset";
    $res = mysqli_query($conn,$q);
    return $res;

}


function getQueryVote($rollNo,$questionId,$conn)
{
    $quer = "SELECT voteType from voteQuery WHERE rollNo = '".$rollNo."' AND questionId = ".$questionId;
    $res = mysqli_query($conn,$quer);
    return $res;
}

function countQueryVotes($questionId,$conn)
{
    $quer = "SELECT voteType from voteQuery WHERE questionId = ".$questionId." AND voteType = 1";
    $res = mysqli_query($conn,$quer);
    $querN = "SELECT voteType from voteQuery WHERE questionId = ".$questionId." AND voteType = -1";
    $resN = mysqli_query($conn,$querN);
    return mysqli_num_rows($res)-mysqli_num_rows($resN);
}
function displayQuery($roll,$questionId,$conn)
{


    $questionDetail = getQuestionDetail($questionId,$conn);
    $rollNo = $questionDetail['rollNo'];
    $questionFrom = $rollNo;
    $userName = getFisrtAndLastName($rollNo,$conn);
    $userPic = getUserPicAddress($rollNo,$conn);

    $headingOfQuestion = $questionDetail['heading'];
    $descriptionOfQuestion = $questionDetail['description'];
    $timeOfQuery = $questionDetail['timeOfQuestion'];
    $dateOfQuery = $questionDetail['dateOfQuestion'];
    $subject = getSubjectName($questionDetail['subjectId'],$conn);

    $noOfAnswers = noOfAnswers($questionId,$conn);
    if($noOfAnswers==0)
    {
        $noOfAnswers = "No";
    }

    $res = getCommentsId($questionId,$conn);
    $numOfComments = mysqli_num_rows($res);
    $comm = $numOfComments;
    if($comm==0)
    {
        $comm = "No";
    }

    $votes =countQueryVotes($questionId,$conn);
    if($votes=='')
    {
        $votes="No vote";
    }
    else if($votes==1)
    {
        $votes="1 vote";
    }
    else
    {
        $votes = $votes." votes";
    }
    $voteType = getQueryVote($roll,$questionId,$conn);
    $resultVote = mysqli_fetch_assoc($voteType);
    echo "<div class='card card-widget' id='".$questionId."'>
            <div class='card-header'>
              <div class='user-block'>
                  <img class='img-circle' src='".$userPic['userPic']."' alt='User Image'>
                        <form>
                         <span class='username'><a href='profile.php?id=".$rollNo."'>".$userName['firstName']."  ".$userName['lastName']."</a> asked for <span style='color:#007bff;'>".$subject."</span> </span>
                        </form>
                        <span class='description' >posted at - ".$timeOfQuery."  ".$dateOfQuery."</span>
              </div>
              ";
                if($roll==$rollNo)
                {
                    echo "   
                        <div class='card-tools'>
                            <button type='button' class='btn btn-tool' data-toggle='modal' data-target='#exampleModalCenter' 
                            id='".$questionId."'  onclick='deleteQuery(this.id)' 
                             ><i class='fa fa-times'></i>
                            </button>
                        </div>";
                }
                echo "
            </div>               
                                    <!-- /.card-header -->
            <div class='card-body'>
                <h4><b>".$headingOfQuestion."</b></h4>
                <p>".$descriptionOfQuestion."<a href='completequery.php?qid=".$questionId."'>more...</a></p>
                ";
                if($resultVote=='')
                {
                    echo "<button type='button' class='btn btn-default btn-sm ' id='".$questionId."l' onclick='likeQuery(this.id)'><i class='fa fa-thumbs-o-up' id='".$questionId."y'></i> Like</button>
                         <button type='button' class='btn btn-default btn-sm ' id='".$questionId."d' onclick='disLikeQuery(this.id)'><i class='fa fa-thumbs-o-down' id='".$questionId."n'></i> Dislike</button>";
                }
                 else if($resultVote['voteType']==1)
                {
                        echo "<button type='button' class='btn btn-default btn-sm ' id='".$questionId."l' onclick='likeQuery(this.id)'
                         style='color:blue'><i class='fa fa-thumbs-o-up' ></i> Like</button>
                         <button type='button' class='btn btn-default btn-sm ' id='".$questionId."d' onclick='disLikeQuery(this.id)'><i class='fa fa-thumbs-o-down' ></i> Dislike</button>";
                }
                 else if($resultVote['voteType']==-1)
                 {
                     echo "<button type='button' class='btn btn-default btn-sm ' id='".$questionId."l' onclick='likeQuery(this.id)'
                         ><i class='fa fa-thumbs-o-up' ></i> Like</button>
                         <button type='button' class='btn btn-default btn-sm ' id='".$questionId."d' onclick='disLikeQuery(this.id)'
                         style='color:red'><i class='fa fa-thumbs-o-down'></i> Dislike</button>";
                 }

     echo " <span class='float-right text-muted'> ".$votes." - ".$comm." Comments - ".$noOfAnswers." Answers</span>
          </div>
           
           
                                    <!-- /.card-body -->
          <div class='card-footer card-comments' id='".$questionId."comment'>";

    if($numOfComments==1)
    {

        $row = mysqli_fetch_assoc($res);
        displayComment($row['commentId'],$conn);
    }
    else if($numOfComments>=2)
    {
        $row = mysqli_fetch_assoc($res);
        displayComment($row['commentId'],$conn);
        $row = mysqli_fetch_assoc($res);
        displayComment($row['commentId'],$conn);
    }


    echo "                               <!-- /.card-comment -->
          
        </div>
           
           
                                    <!-- /.card-footer -->
        <div class='card-footer'>
           
              <img class='img-fluid img-circle img-sm' src='".getUserPicAddress($roll,$conn)['userPic']."' alt='Alt Text'>
              <div class='img-push'>
                    <input type='hidden' name='questionFrom' value='".$questionFrom."'>
                   <input type='hidden' name='questionId' value='".$questionId."'>
                  <input type='text' name='commentData' id='".$questionId."c' onkeypress='postComment(this.id,event)' class='form-control form-control-sm' placeholder='Press enter to post comment'>
              </div>
        </div>
       </div>";
}

function sendMessage($rollNo,$messageTo,$messageData,$conn)
{
    date_default_timezone_set("Asia/Karachi");
    $timeOfMessage=date("h:i:sa");
    $dateOfMessage=date("y/m/d",time());
    $insertQuery = "INSERT INTO messages (messageFrom,messageTo,timeOfMessage,dateOfMesssage,messageData) VALUES 
                     ('".$rollNo."','".$messageTo."','".$timeOfMessage."','".$dateOfMessage."','".$messageData."');";
    $res = mysqli_query($conn,$insertQuery);

}

function leftMessageDisplay($message,$date,$time)
{
    $date = getDateInFormat($date);
    $time = $time[0].$time[1].$time[2].$time[3].$time[4];
    echo "<div class='direct-chat-msg'>
                    <!-- /.direct-chat-info -->
                    <!-- /.direct-chat-img -->
                   <div class='direct-chat-text' data-toggle='tooltip' data-placement='left' title='".$date." ".$time."' style='font-size: 14px;'>".
                    $message
                    ."</div>
                    <!-- /.direct-chat-text -->
                </div>";
}


function isEmoji($message)
{
    if($message[0]=='&')
    {
        return 1;
    }
    return 0;
}


function rightMessageDisplay($userDataOfMessageTo,$userName,$message,$date,$time)
{
    $dateExact = getDateInFormat($date);
    $timeExact = $time[0].$time[1].$time[2].$time[3].$time[4];
    echo "<div class='direct-chat-msg right'>
                    <div class='direct-chat-info clearfix'>
                        <span class='direct-chat-name float-right'>".$userName."</span>
                    
                    </div>
                    <!-- /.direct-chat-info -->
                    <img class='direct-chat-img' src='".$userDataOfMessageTo['userPic']."'  alt='Message User Image'>
                    <!-- /.direct-chat-img -->
                    <div class='direct-chat-text' title='".$dateExact." ".$timeExact."' style='font-size: 14px;'>".
                    $message
                    ."</div>
                    <!-- /.direct-chat-text -->
                </div>
               
                <!-- /.direct-chat-msg -->
            ";

}

function getMessageData($rollNo,$messageTo,$conn)
{
    $getQuery = "SELECT messageFrom,messageTo,dateOfMesssage,timeOfMessage,messageData from messages WHERE 
                (lower(messageFrom) ='".strtolower($rollNo)."' and lower(messageTo) ='".strtolower($messageTo)."') OR 
                (lower(messageFrom) ='".strtolower($messageTo)."' and lower(messageTo) ='".strtolower($rollNo)."')
                ORDER BY dateOfMesssage,timeOfMessage";
    $result  = mysqli_query($conn,$getQuery);
    return $result;
}

function getMessageDataOfUnseen($rollNo,$messageTo,$conn)
{
    $getQuery = "SELECT * from messages WHERE 
                lower(messageFrom) ='".strtolower($messageTo)."' and lower(messageTo) ='".strtolower($rollNo)."' and seen=0
                ORDER BY dateOfMesssage,timeOfMessage";
    $result  = mysqli_query($conn,$getQuery);

    return $result;
}

function makeUnseenSeen($rollNo,$messageTo,$conn)
{
    $getQuery = "UPDATE messages set seen =1 WHERE seen=0 AND  
                ((lower(messageFrom) ='".strtolower($rollNo)."' and lower(messageTo) ='".strtolower($messageTo)."') OR 
                (lower(messageFrom) ='".strtolower($messageTo)."' and lower(messageTo) ='".strtolower($rollNo)."'));";
    mysqli_query($conn,$getQuery);
}


function displayMessageBox($rollNo,$messageTo,$conn)
{
    $userData = getUserData($rollNo,$conn);
    $userDataOfMessageTo = getUserData($messageTo,$conn);
    $userDataOfMessageToName = $userDataOfMessageTo['firstName']." ".$userDataOfMessageTo['lastName'];


    echo "
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
                <button type='button' class='btn btn-tool' data-widget='remove'><i class='fa fa-times'></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class='card-body'>
            <!-- Conversations are loaded here -->
            <div class='direct-chat-messages' id='directMessage'>
                <!-- Message. Default to the left -->
                
                ";


            echo  "<!--/.direct-chat-messages-->
               </div>
            <!-- Contacts are loaded here -->
            <div class='direct-chat-contacts'>
                <!-- /.contatcts-list -->
            </div>
            <!-- /.direct-chat-pane -->
        </div>
        <!-- /.card-body -->

        <div class='card-footer'>
            <form action='ajax/messageSend.php' method='post' _lpchecked='1'>
                 <div class='input-group'>
                    <input type='text' id='message' placeholder='Type a message ...' class='form-control'>
                    <input type='hidden' value='".$messageTo."' id='messageTo'>
                    <span class='input-group-append'>
                                <button id='submit' class='btn btn-primary'>Send</button>
                            </span>
                </div>

                </form>
            </div>
        <!-- /.card-footer-->
    </div>
</div>";
}

function singlePersonMessage($rollNo,$conn)

{
    $userData = getUserData($rollNo,$conn);
    echo "<div class='card-header chat' id = '".$rollNo."' onclick='showMessageBox(this.id)' 
                style='cursor: pointer;height: 47px;width: 300px;margin-left: -7px;border-bottom: 1px solid #f4f5f9;'>
        <div class='user-block'>
        <input type='hidden' value='".$rollNo."' id='rollNo'>
        <img class='img-circle' src='".$userData['userPic']."' style='margin-top:-10px;' alt='User Image'>
            <span  style='font-size: 17px;margin-left: 10px;'>".$userData['firstName']." ".$userData['lastName']."</span>
    </div>
</div>";

}


function followedNotification($rollNo,$dateTime,$conn)
{
    $d = getDateInFormat($dateTime);
    $t = getTimeFormat($dateTime);
    $name = getFisrtAndLastName($rollNo,$conn);

    echo "<li>
            <i class='fa fa-user bg-info'></i>
           <div class='timeline-item'>
               <span class='time'><i class='fa fa-clock-o'></i>".$t."</span>
            <h3 class='timeline-header no-border'><a href='profile.php?id=".$rollNo."'>".$name['firstName']." ".$name['lastName']."</a> followed you</h3>
            </div>
                                                </li>";
}


function commentNotification($rollNo,$questionId,$dateTime,$commentData,$conn)
{
    $d = getDateInFormat($dateTime);
    $t = getTimeFormat($dateTime);
    $name = getFisrtAndLastName($rollNo,$conn);
    echo "
    <li>
    <i class='fa fa-comments bg-warning'></i>
        <div class='timeline-item'>                                           
            <span class='time'><i class='fa fa-clock-o'></i> ".$t."</span>
            <h3 class='timeline-header'><a href='profile.php?id=".$rollNo."'>".$name['firstName']." ".$name['lastName']."</a> commented on your post</h3>
            <div class='timeline-body'>
            ".$commentData."
            </div>
            <div class='timeline-footer'>
            <a href='completequery.php?qid=".$questionId."' class='btn btn-warning btn-flat btn-sm'>View comment</a>
            </div>
         </div>
   </li>";

}

function queryNotification($rollNo,$questionId,$dateTime,$heading,$conn)
{
    $d = getDateInFormat($dateTime);
    $t = getTimeFormat($dateTime);
    $name = getFisrtAndLastName($rollNo,$conn);
    echo "
    <li>
        <i class='fa fa-envelope bg-primary'></i> 
        <div class='timeline-item'>
            <span class='time'><i class='fa fa-clock-o'></i>".$t."</span>
            <h3 class='timeline-header'><a href='profile.php?id=".$rollNo."'>".$name['firstName']." ".$name['lastName']."</a> aksed a question</h3>
            <div class='timeline-body'>
            ".$heading."
            </div>
            <div class='timeline-footer'>
                    <a href='completequery.php?qid=".$questionId."' class='btn btn-primary btn-sm'>Read more</a>
             </div>
        </div>
    </li>
    
    ";
}

function insertCommentNotification($rollNo,$whomeDid,$questionId,$commentData,$conn)
{
    date_default_timezone_set("Asia/Karachi");
    $dateOfNotification=date("Y-m-d h:i:sa",time());
    $insertQuery = "INSERT INTO notifications (rollNo,notificationFrom,notificationLink,dateTimeOfNotification,notificationHeading,seen,
                    notificationType) VALUES 
                     ('".$rollNo."','".$whomeDid."',".$questionId.",'".$dateOfNotification."','".$commentData."',0,1)";
    echo $insertQuery;
    $res = mysqli_query($conn,$insertQuery);

}

function insertQueryNotification($rollNo,$whomeDid,$questionId,$heading,$conn)
{
    date_default_timezone_set("Asia/Karachi");
    $dateOfNotification=date("Y-m-d h:i:sa",time());
    $insertQuery = "INSERT INTO notifications (rollNo,notificationFrom,notificationLink,dateTimeOfNotification,notificationHeading,seen,
                    notificationType) VALUES 
                     ('".$rollNo."','".$whomeDid."',".$questionId.",'".$dateOfNotification."','".$heading."',0,3)";
    // echo $insertQuery;
    $res = mysqli_query($conn,$insertQuery);
}

function insertFollowNotification($rollNo,$whomeDid,$conn)
{
    date_default_timezone_set("Asia/Karachi");
    $dateOfNotification=date("Y-m-d h:i:sa",time());
    $insertQuery = "INSERT INTO notifications (rollNo,notificationFrom,dateTimeOfNotification,seen,
                    notificationType) VALUES 
                     ('".$rollNo."','".$whomeDid."','". $dateOfNotification."',0,2)";

    $res = mysqli_query($conn,$insertQuery);

}




function getNotificationData($rollNo,$conn)
{
    $getQuery = "SELECT * from notifications where rollNo = '".$rollNo."'ORDER BY  dateTimeOfNotification DESC" ;
    $res = mysqli_query($conn,$getQuery);
    return $res;
}
?>


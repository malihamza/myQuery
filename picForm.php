<?php

// Check if image file is a actual image or fake image
include_once("connection.php");
session_start();
if(isset($_POST["submit"]))
{
    $target_dir = "uploads/";
    $target_file = "";
    echo $_FILES["fileToUpload"]["tmp_name"];
    if(strlen(basename($_FILES["fileToUpload"]["name"]))<=0)
    {
        $insertPicQuery = "UPDATE userInfo 
                               SET  userPic = 'uploads/default_pic.jpg'
                                where lower(rollNo) = '" .
            strtolower($_SESSION['rollNo']) . "'";
        $res = mysqli_query($conn, $insertPicQuery);
        $_SESSION['userPic'] = "uploads/default_pic.jpg";
        header("Location: successfullyRegister.php");

    }
    else {
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
// Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
// Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $picName = basename($_FILES["fileToUpload"]["name"]);
                $insertPicQuery = "UPDATE userInfo 
                               SET  userPic = 'uploads/" . $picName . "'
                                where lower(rollNo) = '" .
                    strtolower($_SESSION['rollNo']) . "'";
                $res = mysqli_query($conn, $insertPicQuery);
                $_SESSION['userPic'] = "uploads/" . $picName;
                header("Location: successfullyRegister.php");

            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}
// Check if file already exists

?>
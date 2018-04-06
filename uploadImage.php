<?php
session_start();
?>


<!doctype HTML>
<html>
	<head>
	  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Digital Memories Alzhiemers</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/overwrite.css">
  <link href="css/animate.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet" />
  <!-- =======================================================
    Theme Name: Bikin
    Theme URL: https://bootstrapmade.com/bikin-free-simple-landing-page-template/
    Author: BootstrapMade
    Author URL: https://bootstrapmade.com
  ======================================================= -->
<br>
<br>
<br>
<br>
<br>
<body> 
<header id="header">
    <nav class="navbar navbar-fixed-top" role="banner">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
          </button>
          <a class="navbar-brand" href="index.html">Digital Memories Alzheimers</a>
        </div>
        <div class="collapse navbar-collapse navbar-right" id="navbar-nav">
          <ul class="navbar-nav">
		  <li class="nav-item">
		  <a class="nav-link" href="userprofilepage.php">Profile</a>
		  </li>
		   <li class="nav-item">
                <a class="nav-link" href="digitalphotos.php">Digital Album</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cathDigitalJournal.php">Digital Journal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="calendar.php">Calendar</a>
            </li>
        </ul>
    </div>
</nav>

<br>
<html>
<body>
<form enctype="multipart/form-data" action="imageGallery.php" method="POST">
Image Title: <input type="text" name="img_title" /><br /><br />
Image Description: <input type="text" name="img_desc" /><br /><br />
Choose a file to upload: <input name="uploadedfile" type="file" /><br /><br />
<input name="submit" type="submit" value="submit" />
</form>
</body>
</html>

<?
error_reporting(E_ALL);
ini_set('display_errors',1);


include("dbConnect.php");

if(isset($_POST['submit'])){
$file = $_FILES['file'];

$img_title=$_FILES["img_title"];
$img_desc=$_FILES["img_desc"];
}
$img_name=$_FILES["file"]["name"];
if (($_FILES["file"]["type"]=="image/gif"
|| $_FILES["file"]["type"]=="image/jpeg"
|| $_FILES["file"]["type"]=="image/pjpeg"
&& $_FILES["file"]["size"]<20000))
{
if ($_FILES["file"]["error"]>0)
{
echo "Return Code:".$_FILES["file"]["error"]."<br />";
}
else
{
$i=1;
$success=false;
$new_img_name=$img_name;
while(!$success)
{
if (file_exists("uploads/".$new_img_name))
{
$i++;
$new_img_name="$i".$img_name;
}
else
{
$success=true;
}
}
move_uploaded_file($_FILES["file"]["tmp_name"],"uploads/".$new_img_name);
echo "stored in: "."uploads/".$new_img_name;
echo "<br/>";

$query="INSERT INTO User_Image(img_title,img_desc,img_filename)
VALUES('$img_title','$img_desc','$new_img_name')";
if(!mysql_query($query))
{
die("An error".mysql_error());
}
else
{
echo "1 row added";
}
}
}
else
{
echo "Invalid file";
}
?>

<?

error_reporting(E_ALL);
ini_set('display_errors',1);
include("dbConnect.php");


if (isset($_POST["submit"])){
	$file = $_FILES['file'];
	
	$fileimg_name = $_FILES['file']['img_name'];
	$fileimg_title = $_FILES['file']['img_title'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType = $_FILES['file']['type'];
	
	$fileExt = explode ('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));
	
	$allowed = array ('jpg', 'jpeg', 'png', 'pdf');
	
	if (in_Array($fileActualExt, $allowed)) {
		if ($fileError ===0){
			if ($fileSize < 1000000) {
			$fileNameNew = uniqid ('', true). ".".$fileActualExt;	
			
			$fileDestination = 'uploads/'.$fileNameNew;
			move_uploaded_file($fileTmpName, $fileDestination);
			header("Location: imageGallery?uploadsuccess");
			} else {
				echo "Your file was too big!";
			}
			
		} else {
			echo "There was an error uploading your file!";
		}
	} else {
	echo "You cannot upload files of this type";
	}
}
?>

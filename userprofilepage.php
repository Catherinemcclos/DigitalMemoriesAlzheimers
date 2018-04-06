<!DOCTYPE html>

<?php
include("dbConnect.php");

session_start();
if (isset($_SESSION["currentUser"])) {
	 $dbParams = array('Username' =>$_SESSION["currentUser"]);
	 
	 //var_dump ($_SESSION["currentUserID"]);
 
//$_SESSION["currentUser"]=$formUser;
//$_SESSION["currentUserID"]=$dbRow["Username"];
 }
?>
       
<html lang="en">

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
  </header>
  <br><br><br><br><br>
  
  
 
<center><h2> Welcome to your Digital Memories Archive <?php echo ($_SESSION["currentUser"]); ?>!</h2>
<p></p>
</head>

<br><br><br><br><br>

         
  
<?php 
if (!isset($_SESSION["currentUser"])) 
     header("Location: userprofilepage.php");
session_start();
include("dbConnect.php");

$sql = "SELECT * FROM Users";
$result = $conn->query($sql);


if (($result ) >0) {
	while ($row = $result ->fetchALL(PDO::FETCH_ASSOC);
    $id =$row['id'];
	$queryImg = "SELECT * FROM profileimg WHERE userid='$id'";
	//$stmtImg = mysql_query($conn, $queryImg);
   while ($rowImg =mysql_fetch_assoc($resultImg))	{
		echo "<div>";
		if (rowImg['status'] ==0) {
			echo "<img src ='uploads/profile".$id.".jpg?".mt_rand()."'>";
		} else {
			echo "<img src='uploads/profiledefault.jpg'>";
		}
		echo $row['username'];
		echo "</div>";
	}
} else {
	echo "There are no users yet!";
}

?>
<center> <div class="container">
<div class="row">
<div class="col-xs-12 col-sm-6 col-md-6">
<div class="well well-sm">
<div class="row">
<div class="col-sm-6 col-md-4">
<form action='upload.php' method ='POST' enctype ='multipart/form-data'>
<input type='file' name='file'>
<button type ='submit' name='submit'>UPLOAD FILE</button> <br><br><br><br>
<img src='http://placehold.it/380x500' alt='' class='img-rounded img-responsive' />
</form>
</div>
<div class="col-sm-6 col-md-8">
<h4>Catherine McCloskey</h4>
<small><cite title="San Francisco, USA">Coleraine, Ireland <i class="glyphicon glyphicon-map-marker">
</i></cite></small>
<p>
<i class="glyphicon glyphicon-envelope"></i>mccloskey-c22@ulster.ac.uk
<br/>
<i class="glyphicon glyphicon-gift"></i>29th August 1995</p>
                        <!-- Split button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary"> Settings</button>
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span><span class="sr-only">Social</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li>Log Out</a></li>
                                <li>update Profile Picture</a></li>
                                <li>Change password</a></li>
                                <li>Add member</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

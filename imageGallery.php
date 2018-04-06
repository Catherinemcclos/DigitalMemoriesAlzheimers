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
		
	</head>
 
 <?php
include("dbConnect.php");
session_start();
echo "<center><h1>Image Gallery</h1></center>";
echo "<table border=\"2\" align=\"center\">
<th>Image Title</th>
<th>Image Description</th>
<th>Image</th>";


$sql="SELECT * FROM User_Image";
$result = $conn->query($sql);

while($row = mysqli_fetch_array($result))
{
	$img_Title=$row["img_title)"];
	$img_desc=$row["img_desc)"];
	$img_filename=$row["img_filename)"];
	echo "<tr>
	<td align=\"center\">";
	echo $img_Title;
	echo "</td>
	<td align=\"center\">";
	echo $img_desc;
	echo "</td>
	<td align=\"center\"><imgsrc='http://www.digitalmemoriesalzheimers.co.uk/Project/uploads/";
	echo $img_filename;
	echo " height=\"100\"
	width=\"100\"/></td></tr>";
	
	echo "hello";
   	echo $img_Title;
}
echo "</table>";
//verify record is found 


	
//while($row= $stmt->fetch(PDO::FETCH_ASSOC);
{
echo "<tr><td align=\"center\">".$row["img_title"]."</td>
<td align=\"center\">".$row["img_desc"]."</td>
<td align=\"center\"><img
src=http://localhost//Image/uploads/".$row["img_filename"]." height=\"100\"
width=\"100\"/></td></tr>";
}

echo "</table>";
?>
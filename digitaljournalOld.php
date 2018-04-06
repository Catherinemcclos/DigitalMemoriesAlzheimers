<?php 
error_reporting(E_ALL);
ini_set('display_errors',1);

session_start ();
if(!isset($_SESSION["User_ID"])){
header('Location: signIn.php');
	exit();
}*/
include ("dbConnect.php");
post count 
$post_count =$dbQuery->("SELECT * FROM posts");

?> 

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<style>

body {
	
}
#container {
	padding:10px;
	width:800px;
	margin: auto;
	background:white;
	
}

#menu {
	height:40px;
	line-height:40px;
}
#menu ul {
	margin:0;
	padding:0;
}
#menu ul li(
display:inline;
list-style:none;
margin-right:10px;
font-szie:10px;
}

#mainContent {
	clear:both;
	margin-top:5px;
	font-size:25px;
}

#header {
	height:80px;
	line-height:80px;
	
}

#container #header h1 {
	font-size: 45px;
	margin:0;
}
</head>
<body>
<div id="container">

<div id= "menu">
<li><a href ="#">Home</a></li>
<li><a href ="#">Create New Entry</a></li>
<li><a href ="#">Delete Post</a></li>
<li><a href ="#">Log out</a></li>
<li><a href ="#">Journal Home</a></li>

<div id="mainContent">
<table> 
<tr>
<td>Total Blog Post </td>
<td> <?php $post_count->num_rows?></td>
</tr>

</div>
</body>
</html>

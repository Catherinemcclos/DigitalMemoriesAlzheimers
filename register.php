<!doctype html>
<html lang="en">
  <head>
    <title>Digital Memories</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  </head>
  <body class="bg-info">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/">Digital Memories</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php">Sign In</a>
      </li>
      
      
    </ul>
  </div>
</nav>



<html lang="en">
    <head> 
		<meta name="viewport" content="width=device-width, initial-scale=1">


		<!-- Website CSS style -->
		<link href="U:\finalYear\Project\Digital Memories for Alzheimers\regStyleSheet.css" rel="stylesheet">

		<!-- Website Font style -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		<link rel="stylesheet" href="style.css">
		<!-- Google Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

		<title>Register</title>
	</head>
	<body>
		<div class="container">
			<div class="row main">
				<div class="main-login main-center">
				<h2>Reigster User Account</h2>
					<form class="" method="POST">
						
						<div class="form-group">
							<label for="Name" class="cols-sm-2 control-label">Your Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="Name" id="Name"  placeholder="Enter your Name"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="Email_address" class="cols-sm-2 control-label">Your Email</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="Email_address" id="Email_address"  placeholder="Enter your Email"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="Username" class="cols-sm-2 control-label">Username</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="Username" id="Username"  placeholder="Enter your Username"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="Password" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="Password" class="form-control" name="Password" id="Password"  placeholder="Enter your Password"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="ConfirmPassword" class="cols-sm-2 control-label">Confirm Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="ConfirmPassword" class="form-control" name="ConfirmPassword" id="ConfirmPassword"  placeholder="Confirm your Password"/>
								</div>
							</div>
						</div>

						<div class="form-group ">
						<button type="button" class="cancelbtn">Cancel</button>
						<button type="submit" name="submit" class ="submit">Sign Up</button>					
						</div>
						
					</form>
				</div>
			</div>
		</div>
		
		<?php
session_start();
ob_start();
include("dbConnect.php");

if (isset($_POST['submit'])){
	
	//var_dump([$_POST['Name'],
	$password = $_POST['Password'];
	$email = $_POST['Email_address'];
	$name = $_POST['Name'];
	$confirm = $_POST['ConfirmPassword'];
	$username = $_POST['Username'];
	
	var_dump('successful');
	print_r($_POST);
	
	
	$dbQuery = $conn->prepare("select Password from Users");
	$dbQuery->execute();
	echo "<p>There are " . $dbQuery->rowCount() . " rows</p>";
	
	try {
		//insert into database with a prepared statement 
		$sql = "INSERT INTO Users (Password, Email_Address, Name, ConfirmPassword, Username) VALUES ('$password', '$email', '$name', '$confirm', '$username')";
		echo "<p>$sql</p>";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		/*
		$stmt = $conn->prepare('INSERT INTO Users (Password, Email_Address, Name, ConfirmPassword, Username) VALUES (?,?,?,?,?)');
		
		
		$stmt->execute(array(
		$_POST['Password'],
		$_POST['Email_address'],
		$_POST['Name'],
		$_POST['ConfirmPassword'],
		$_POST['Username']
		));
		*/
		//$UserID = $conn->lastInterId('UserID');
		//redirect to index page 
		
		//echo'<script>window.location = "index.php?action=joined";</script>';
		//header("Location: index.php?action=joined");
		exit;
		
		//else catch the exception and show the error. 
	} catch (PDOException $e) {
		$error[] = $e->getMessage();
		echo "<p>ERROR!!!!!!!!!!!!!!!!!!!!!!!!</p>";
	}
	
	//if action is joined show sucess
	if(isset($_GET['action']) && $_GET['action'] == 'joined'){
		echo "<h2>Registration successful</h2>";
	}
}else{
	var_dump('xxxxxx');
}

  ?>

		 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	</body>
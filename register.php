<!DOCTYPE html>

<?php
include("dbConnect.php");
  ?>

<html lang="en">
<body>
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
</head>


<body>
  <header id="header">
    <nav class="navbar navbar-fixed-top" role="banner">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">Digital Memories Alzheimers</a>
        </div>
        <div class="collapse navbar-collapse navbar-right">
          <ul class="nav navbar-nav">
          </ul>
        </div>
      </div>
      <!--/.container-->
    </nav>
    <!--/nav-->
  </header>
  <!--/header-->
 
<div class="container">
  <h3></h3>
  <p></p>
</div>

</body>
</html>

<!DOCTYPE html>
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
					<form class="" method="post" action="#">
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Your Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="name" id="name"  placeholder="Enter your Name"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Your Email</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="email" id="email"  placeholder="Enter your Email"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="username" class="cols-sm-2 control-label">Username</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="username" id="username"  placeholder="Enter your Username"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="confirm" id="confirm"  placeholder="Confirm your Password"/>
								</div>
							</div>
						</div>

						<div class="form-group ">
							<a href="userprofilepage.php" target="_blank" type="button" id="button" class="btn btn-primary btn-lg btn-block login-button">Register</a> <!--Link to database -->
						</div>
						
					</form>
				</div>
			</div>
		</div>

		 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	</body>
</html>

<?php

session_start();

try{
	
	$con - new PDO ("mysql:host=$ost_name;;dbname=$database","root","");
	
	if(isset($_POST['Register'])){
		
		$Name = $_POST['Name'];
		$Email_address = $_POST['Email_address'];
		$Username = $_POST['Username'];
		$Password = $_POST ['Password'];
		$ConfirmPassword = $_POST ['ConfirmPassword'];
		
		$insert = $con->prepare("INSERT INTO Users (Name,Email_address,Username,Password,ConfirmPassword)
		values(:Name,:Email_address,:Username,:Password,:ConfirmPassword) ");
		$insert->bindParam(':Name',$name);
		$insert->bindParam('Email_address',$Email_address);
		$insert->bindParam('Username',$Username);
		$insert->bindParam('Password',$Password);
		$insert->bindParam('ConfirmPassword',$ConfirmPassword);
		$insert->execute();
		}elseif(isset($_POST['signin'])){
			$Email_address = $_POST['Email_address'];
			$Password = $_POST['Password'];
			
			$select = $con->prepare("SELECT * FROM users WHERE email='$email' and Password='$Password'");
			$select->setFetchMode(PDO::FETCH_ASSOC);
			$select->execute();
			$data=$select->fetch();
			if($data['Email_address']!=$Email_address and $data['Password']!=$pass)
			{
				echo "invalid email or passsword";
			}
			elseif($data['Email_address']==$Email_address and $data['Password']==$Password)
			{
				$_SESSION['Email_address']=$data['Email_address'];
				$_SESSION['Name']=$data['Name'];
				header("location:profile.php");
			}
		}
}
catch(PDOException $e)
{
	echo "error".$e->getMessage();
}
?>
	



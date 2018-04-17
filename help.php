<!DOCTYPE html>
<html lang="en">
<body>

<form method="POST" style="border:1px solid #ccc">
  <div class="container">
    <h1>Sign Up</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="Email_address" required>

    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="Password" required>

    <label><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="ConfirmPassword" required>

    <label>
      <input type="checkbox" checked="checked" style="margin-bottom:15px"> Remember me
    </label>

    <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

    <div class="clearfix">
      <button type="button" class="cancelbtn">Cancel</button>
      <button name ="submit" type="submit" class="signupbtn">Sign Up</button>
    </div>
  </div>
</form>

		<?php
session_start();
ob_start();
include("dbConnect.php");

if (isset($_POST['submit'])){
	
	/*var_dump([$_POST['Name'],
	$_POST['Password'],
	$_POST['Email_address'],
	$_POST['Name'],
	$_POST['ConfirmPassword']
	$_POST['Username']]);*/
	
	var_dump('successful');
	
	try {
		//insert into database with a prepared statement 
		$stmt = $conn->prepare('INSERT INTO Users (Password, Email_Address, Name, ConfirmPassword, Username) VALUES (?, ?, ?, ?)');
		
		
		$stmt->execute(array(
		$_POST['Password'],
		$_POST['Email_address'],
		$_POST['Name'],
		$_POST['ConfirmPassword'],
		$_POST['Username']
		));
		//$UserID = $conn->lastInterId('UserID');
		//redirect to index page 
		
		echo'<script>window.location = "index.php?action=joined";</script>';
		//header("Location: index.php?action=joined");
		exit;
		
		//else catch the exception and show the error. 
	} catch (PDOException $e) {
		$error[] = $e->getMessage();
	}
	
	//if action is joined show sucess
	if(isset($_GET['action']) && $_GET['action'] == 'joined'){
		echo "<h2>Registration successful</h2>";
	}
}else{
	var_dump('xxxxxx');
}

  ?>
<?php
session_start();
   //unset($_SESSION["currentUser"]);
   //unset($_SESSION["currentUserID"]);
   var_dump($_POST);
		if (isset($_POST)) {
			
			
	
			$formUser=$_POST["Username"];
			var_dump('xxxxxxxxxxxxxxxxx');
			$formPass=$_POST["Password"];

			include("dbConnect.php");
		
			$dbQuery=$conn->prepare("select * from Users where Username=:formUser"); 
			$dbParams=array('formUser'=>$formUser);
			$dbQuery->execute($dbParams);
			$dbRow = $dbQuery->fetch(PDO::FETCH_ASSOC);
			
			print_r($dbRow);
			
			
			var_dump('SELECTED VALUES');
			if ($dbRow["Username"]==$formUser) {       
				if ($dbRow["Password"]==$formPass) {
					$_SESSION["currentUser"]=$formUser;
					$_SESSION["currentUserID"]=$dbRow["User_ID"];
					var_dump("TRUE");
					header("Location: userprofilepage.php");
				}
				else {
					var_dump("FALSE");
					header("Location: signIn.php?failCode=2");
				}
			} else {
				header("Location: signIn.php?failCode=1");
			}

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



 <body>
 <header id="signIn">
		
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
	
	
	<div class="container">
			<div class="row main">
				<div class="main-login main-center">
				<h5>Sign in to account <h5>
				
				<?php
   if (isset($_GET["failCode"])) {
      if ($_GET["failCode"]==1)
         echo "<h3>Incorrect Username entered</h3>";
      if ($_GET["failCode"]==2)
         echo "<h3>Incorrect Password entered</h3>";
   }      
?>  
							<form id='login' action='<?php echo($_SERVER['PHP_SELF']) ?>' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Login</legend>

<label for='username' >UserName*:</label>
<input type='text' name='Username' id='Username'  maxlength="50" />

<label for='password' >Password*:</label>
<input type='password' name='Password' id='Password' maxlength="50" />

<input type='submit' name='Submit' value='Submit' />

</fieldset>
</form>
						</div>
						
					</form>
				</div>
			</div>
		</div>
  <h3></h3>
  <p></p>
</div>

</body>
</html>
</head>
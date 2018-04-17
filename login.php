<?php
   session_start();
   
   unset($_SESSION["currentUser"]);
   unset($_SESSION["currentUserID"]);

   if (isset($_POST["login"])) {

      $formUser=$_POST["username"];
      $formPass=$_POST["password"];

      include("dbConnect.php");
      $dbQuery=$conn->prepare("select * from Users where Username=:formUser"); 
      $dbParams=array('formUser'=>$formUser);
      $dbQuery->execute($dbParams);
      $dbRow = $dbQuery->fetch(PDO::FETCH_ASSOC);
      if ($dbRow["username"]==$formUser) {       
         if ($dbRow["password"]==$formPass) {
            $_SESSION["currentUser"]=$formUser;
            $_SESSION["currentUserID"]=$dbRow["User_ID"];
            header("Location: userprofilepage.php");
         }
         else {
            header("Location: signIn.php?failCode=2");
         }
      } else {
            header("Location: signIn.php?failCode=1");
      }

   } 

?>
<html>

<head>
<title>My Playlist Manager</title>
</head>
<body>

<h1>Playlist manager</h1>

<h2>Login</h2>

<?php
   if (isset($_GET["failCode"])) {
      if ($_GET["failCode"]==1)
         echo "<h3>Bad username entered</h3>";
      if ($_GET["failCode"]==2)
         echo "<h3>Bad password entered</h3>";
   }      
?>         

<form name="login" method="post" action="login.php">
  <div>Username<br>
  <input type="text" name="username"></div>

  <div>Password<br>
  <input type="text" name="password"></div>

  <div>
  <input type="submit" name="login" value="Login"></div>
  
</form>

</body>

</html>



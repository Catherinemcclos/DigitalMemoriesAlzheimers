<!DOCTYPE html>

<?php
require 'mainHeader.html';
include("dbConnect.php");

session_start();
if (isset($_SESSION["currentUser"])) {
	 $dbParams = array('Username' =>$_SESSION["currentUser"]);
	 
	 //var_dump ($_SESSION["currentUserID"]);
 
//$_SESSION["currentUser"]=$formUser;
//$_SESSION["currentUserID"]=$dbRow["Username"];
 }
?>
       

<br><br><br><br><br>
  
  

<center><h2> Welcome to your Digital Memories Archive <?php echo ($_SESSION["currentUser"]); ?>!</h2></center>
<p></p>


<br><br><br><br><br>

         
  
<?php 
if (!isset($_SESSION["currentUser"])) 
     header("Location: userprofilepage.php");
session_start();
include("dbConnect.php");

$sql = "SELECT * FROM Users";
$result = $conn->query($sql);


if (($result ) >0) {
	//while ($row = $result ->fetchALL(PDO::FETCH_ASSOC);
    $id =$row['id'];
	$queryImg = "SELECT * FROM profileimg WHERE User_ID='$id'";
	//$stmtImg = mysql_query($conn, $queryImg);
   while ($rowImg =mysqli_fetch_assoc($resultImg))	{
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

<?php 
include("dbConnect.php");

$Username = $_POST['Username'];
$User_ID = $_POST['User_ID'];
$Password = $_POST['Password'];

$stmt = $conn->prepare('INSERT INTO Users (Username, User_ID, Password) VALUES (?, ?, ?, ?)');
$stmt->execute(array(
$_POST['Username'],
$_POST['User_ID'],
$_POST['Password']
));

$stmt ="SELECT * FROM Users WHERE Username ='$Username' AND User_ID='$User_ID'";
$result =mysqli_query($conn, $sql);

if (mysql_num_rows($result) > 0){
	while ($row =mysql_fetch_assoc($result)){
		$User_ID = $row['id'];
		$stmt=$conn->prepare("INSERT INTO profileimg (User_ID, status) VALUES ('$User_ID, 1");
        $stmt->execute();
		header("Location: UserPofilePage.php");
	}
} else {
	echo "You have an error!";
}


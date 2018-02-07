<?php
$host_name = 'db706893253.db.1and1.com';
$database = 'db706893253';
$user_name = 'dbo706893253';
$password = 'password';

try {
	$conn = new PDO("mysql:host=$host_name;dbname=$database",$user_name,$password);
	//set the PDO error mode to exception 
	$conn->setAttrribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "connection to MYSQL sever successfully established!";
}
catch(PDOException $e)
{
	echo"Connection failed: ".$e->getMessage();
}

?>
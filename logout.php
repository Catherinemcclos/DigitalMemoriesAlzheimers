<?php
session_start();
echo "You are Logged Out"."<br />";
echo "<a href=\"signIn.php\">Login Form</a>";
session_destroy();
?>
<?php   


	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password=""; // Mysql password 
	$db_name="forum"; // Database name 
	$tbl_name="admin"; // Table name 
	// Connect to server and select databse.
	$conn = mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
?>
<?php
session_start();

	if(isset( $_SESSION['user'] ))
	{
    	header("location:admin.php");
	}

	//check for null values
	if( isset($_POST['user']) and isset($_POST['pass']) ){

		$host="localhost"; // Host name 
		$username="root"; // Mysql username 
		$password=""; // Mysql password 
		$db_name="forum"; // Database name 
		$tbl_name="admin"; // Table name 

		// Connect to server and select databse.
		mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
		mysql_select_db("$db_name")or die("cannot select DB");


		// username and password sent from form 
		$myusername=$_POST['user']; 
		$mypassword=$_POST['pass']; 

		// To protect MySQL injection (more detail about MySQL injection)
		$myusername = stripslashes($myusername);
		$mypassword = stripslashes($mypassword);
		$myusername = mysql_real_escape_string($myusername);
		$mypassword = mysql_real_escape_string($mypassword);
		$mypassword = md5($mypassword);

		$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and pass='$mypassword'";
		$result=mysql_query($sql);

		// Mysql_num_row is counting table row
		$count=mysql_num_rows($result);

		// If result matched $myusername and $mypassword, table row must be 1 row
		if($count==1){

		// Register $myusername, $mypassword and redirect to file "login_success.php"
		//session_register("myusername");
		//session_register("mypassword"); 
			$_SESSION['user']=$myusername;
			header("location:admin.php");
		}
		else {
			echo "Wrong Username or Password";
		}
	}
	
?>


<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

	</head>
	<body>
	<header>
		<nav class="navbar navbar-default">
			<div class="container">

				<a class="navbar-brand" href="#">SiteName</a>
			</div>
		</nav>
	</header>

	<div class="container">
		<div class="row">
			<form role="form" name="admin-login" method="POST" action="">
			  <div class="form-group">
			    <label for="username">Username :</label>
			    <input type="text" class="form-control" id="username" name="user" placeholder="Enter Username">
			  </div>
			  <div class="form-group">
			    <label for="password">Password</label>
			    <input type="password" class="form-control" id="password" name="pass" placeholder="Password">
			  </div>
			  <button type="submit" class="btn btn-default">Submit</button>
			</form>
		</div>
	</div><!--container-->
	</body>
</html>
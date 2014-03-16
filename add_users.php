<?php 

session_start();

if(!isset( $_SESSION['user'] ))
{
	header("location:admin-login.php");
}

if (isset($_GET['view'])){
	view_all_users();
}

elseif (isset($_GET['del'])){
	$usr = mysql_real_escape_string($_GET['del']);
	del_usr($usr);
}


elseif (empty($_POST['new-user']) or empty($_POST['new-user-pass']) ){
	$message = "Username or password couldn't be blank";
	echo $message;
}

elseif (isset($_POST['new-user']) and isset($_POST['new-user-pass']) ){
	
	include 'dbconnect.php';
	$db_name = 'forum';
	$tbl_name = 'users';
	
	$new_user = $_POST['new-user'];
	$new_user_pass = $_POST['new-user-pass'];
	$new_user_desg = $_POST['new-user-designation'];

	//cleaning post parameters
	$new_user = stripslashes($new_user);
	$new_user = mysql_real_escape_string($new_user);
	$new_user_pass = stripslashes($new_user_pass);
	$new_user_pass = mysql_real_escape_string($new_user_pass);
	$new_user_desg = stripslashes($new_user_desg);
	$new_user_desg = mysql_real_escape_string($new_user_desg);
	
	//hashing password
	$new_user_pass = md5($new_user_pass);

	$sql = "CREATE TABLE IF NOT EXISTS users( ".
	       "user_id INT(5) NOT NULL AUTO_INCREMENT, ".
	       "username VARCHAR(80) NOT NULL, ".
	       "password VARCHAR(70) , ".
	       "designation  VARCHAR(60), ".
	       "date_added   timestamp, ".
	       "last_logged   timestamp, ".
	       "primary key ( user_id ))";

	mysql_select_db("$db_name")or die("cannot select DB");
	$retval = mysql_query( $sql, $conn );
	if(! $retval )
	{
	  die('Could not create table: ' . mysql_error());
	}

	$sql="SELECT * FROM $tbl_name WHERE username='$new_user'";
	$result=mysql_query($sql, $conn);

	// Mysql_num_row is counting table row
	$count=mysql_num_rows($result);

	// If result matched $myusername and $mypassword, table row must be 1 row
	if($count!=0){
		$message = "Failure: Cannot add user because user".$new_user." is already present in db.";
	}
	else{

		$sql = "INSERT INTO $tbl_name ".
		       "(username,password, designation, date_added) ".
		       "VALUES('$new_user','$new_user_pass','$new_user_desg', (now()))";
		
		$retval = mysql_query( $sql, $conn );
		if(! $retval )
		{
		  $message = "Failure: Couldn't add to db due to db error";
		}
		else{
			$message = "Success: user ".$new_user." added to database.";
			mysql_close($conn);
		}

	}

	
echo $message;
}

else{
echo "No parameters were specified.";
 }

 // F    U   N    C    T    I    O    N    S

function view_all_users(){
	include 'dbconnect.php';
	$db_name = 'forum';
	$tbl_name = 'users';
	mysql_select_db("$db_name")or die("cannot select DB");
	$result = mysql_query("SELECT * FROM $tbl_name",$conn);
	echo "<table class='table table-striped'>
	<tr>
	<th>Username</th>
	<th>Designation</th>
	<th>Date added</th>
	<th>Last Logged</th>
	<th>Operation</th>
	</tr>";

	while($row = mysql_fetch_array($result))
	  {
	  echo "<tr>";
	  echo "<td>" . $row['username'] . "</td>";
	  echo "<td>" . $row['designation'] . "</td>";
	  echo "<td>" . $row['date_added'] . "</td>";
	  echo "<td>" . $row['last_logged'] . "</td>";
	  echo "<td> <a style='cursor:pointer;' alt='Delete this user' onclick='javascript:del_user(\"" .$row['username']. "\")'><span class='glyphicon glyphicon-remove'></span> Delete </a></td>";
	  echo "</tr>";
	  }
	echo "</table>";

	mysql_close($conn);
}

function del_usr($usr){
	include 'dbconnect.php';
	$db_name = 'forum';
	$tbl_name = 'users';
	$sql = "DELETE FROM $tbl_name WHERE username='".$usr."'";
	mysql_select_db("$db_name")or die("cannot select DB");
	$result = mysql_query($sql,$conn);	
	if(!$result){
		echo "Error: Cannot Delete the username '$usr'";

	}
	else{
	echo "Success: User $usr is successfully deleted from the database.";
	}
	mysql_close($conn);
}
?>
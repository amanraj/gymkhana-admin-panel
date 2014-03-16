<?php 

session_start();

if(!isset( $_SESSION['user'] ))
{
	header("location:admin-login.php");
}

if (isset($_GET['view'])){
	$event= mysql_real_escape_string($_GET['view']);
	view_all_moms($event);
}

elseif (isset($_GET['del'])){
	$date = mysql_real_escape_string($_GET['date']);
	$event= mysql_real_escape_string($_GET['event']);
	del_mom($event, $date);
}


elseif (empty($_POST['new-mom-event']) or empty($_POST['new-mom-date']) or empty($_POST['new-mom']) ){
	$message = "Event or Date or Minute of meeting couldn't be blank";
}

elseif (isset($_POST['new-mom-event']) and isset($_POST['new-mom-date']) and isset($_POST['new-mom']) ){
	
	include 'dbconnect.php';
	$db_name = 'forum';
	$tbl_name = 'mom';
	
	$new_event = $_POST['new-mom-event'];
	$new_date = $_POST['new-mom-date'];
	$new_mom = $_POST['new-mom'];

	//cleaning post parameters
	$new_event = stripslashes($new_event);
	$new_event = mysql_real_escape_string($new_event);
	$new_date = stripslashes($new_date);
	$new_date = mysql_real_escape_string($new_date);
	$new_mom = stripslashes($new_mom);
	$new_mom = mysql_real_escape_string($new_mom);
	

	$sql = "CREATE TABLE IF NOT EXISTS ".$tbl_name."( ".
	       "mom_id INT(5) NOT NULL AUTO_INCREMENT, ".
	       "event VARCHAR(40) NOT NULL, ".
	       "date_of_meeting VARCHAR(30) , ".
	       "mom  TEXT, ".
	       "date_added timestamp, ".
	       "primary key ( mom_id ))";

	mysql_select_db("$db_name")or die("cannot select DB");
	$retval = mysql_query( $sql, $conn );
	if(! $retval )
	{
	  die('Could not create table: ' . mysql_error());
	}

	$sql="SELECT * FROM $tbl_name WHERE date_of_meeting='$new_date' AND event='$new_event'";
	$result=mysql_query($sql, $conn);

	// Mysql_num_row is counting table row
	$count=mysql_num_rows($result);

	// If result matched $myusername and $mypassword, table row must be 1 row
	if($count!=0){
		$message = "Failure: Cannot add this minute of meeting because a MoM dated '".$new_date."'' of event '$new_event' is already present in db.";
	}
	else{

		$sql = "INSERT INTO $tbl_name ".
		       "(event,date_of_meeting, mom, date_added) ".
		       "VALUES('$new_event','$new_date','$new_mom', (now()))";
		
		$retval = mysql_query( $sql, $conn );
		if(! $retval )
		{
		  $message = "Failure: Couldn't add to db due to db error";
		}
		else{
			$message = "Success: mom dated ".$new_date." of event '$new_event' added to database.";
			mysql_close($conn);
		}

	}

	
echo $message;
}

else{
echo "No parameters were specified.";
 }


  // F    U   N    C    T    I    O    N    S

 function view_all_moms($event){
 	include 'dbconnect.php';
 	$db_name = 'forum';
 	$tbl_name = 'mom';
 	mysql_select_db("$db_name")or die("cannot select DB");
 	$view_sql = "SELECT * FROM ".$tbl_name." WHERE event = '".$event."'";
 	$result = mysql_query($view_sql,$conn);
 	echo "<table class='table table-striped'>
 	<tr>
 	<th>Date of Meeting</th>
 	<th>Minutes of Meeting</th>
 	<th>Date added</th>
 	<th>Operation</th>
 	</tr>";

 	while($row = mysql_fetch_array($result))
 	  {
 	  echo "<tr>";
 	  echo "<td>" . $row['date_of_meeting'] . "</td>";
 	  echo "<td>" . $row['mom'] . "</td>";
 	  echo "<td>" . $row['date_added'] . "</td>";
 	  echo "<td> <a style='cursor:pointer;' alt='Delete this MoM' onclick='javascript:del_mom(\"" 
 	  	    .$row['event'].
 	  	    "\",\"".
 	  	    $row['date_of_meeting']. 
 	  	    "\")'><span class='glyphicon glyphicon-remove'></span> Delete </a></td>";
 	  echo "</tr>";
 	  }
 	echo "</table>";

 	mysql_close($conn);
 }

 function del_mom($event, $date){
 	include 'dbconnect.php';
 	$db_name = 'forum';
 	$tbl_name = 'mom';
 	$sql = "DELETE FROM $tbl_name WHERE event='".$event."' AND date_of_meeting='".$date."'";
 	mysql_select_db("$db_name")or die("cannot select DB");
 	$result = mysql_query($sql,$conn);	
 	if(!$result){
 		echo "Error: Cannot Delete the MoM dated '$date' of event '$event'";

 	}
 	else{
 	echo "Success: Minutes of meeting dated  '$date' of event '$event' is successfully deleted from the database.";
 	}
 	mysql_close($conn);
 }
?>
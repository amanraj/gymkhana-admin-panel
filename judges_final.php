<?php 

session_start();

if(!isset( $_SESSION['user'] ))
{
	header("location:admin-login.php");
}

if (isset($_GET['view'])){
	$event= mysql_real_escape_string($_GET['view']);
	view_all_judges($event);
}

elseif (isset($_GET['del'])){
	$judge = mysql_real_escape_string($_GET['judge']);
	$event= mysql_real_escape_string($_GET['event']);
	del_judge_final($event, $judge);
}

elseif (isset($_GET['add'])){
	$judge = mysql_real_escape_string($_GET['judge']);
	$event= mysql_real_escape_string($_GET['event']);
	add_judge_final($event, $judge);
}



else{
echo "No parameters were specified.";
 }


  // F    U   N    C    T    I    O    N    S

 function view_all_judges($event){
 	include 'dbconnect.php';
 	$db_name = 'forum';
 	$tbl_name = 'judges_final';
 	mysql_select_db("$db_name")or die("cannot select DB");
 	$view_sql = "SELECT * FROM ".$tbl_name." WHERE event = '".$event."'";
 	$result = mysql_query($view_sql,$conn);
 	echo "<table class='table table-striped'>
 	<tr>
 	<th>Event Name</th>
 	<th>Judge Name</th>
 	<th>Operation</th>
 	</tr>";

 	while($row = mysql_fetch_array($result))
 	  {
 	  echo "<tr>";
 	  echo "<td>" . $row['event'] . "</td>";
 	  echo "<td>" . $row['judge_name'] . "</td>";
 	  echo "<td> <a style='cursor:pointer;' alt='Delete this Judge' onclick='javascript:del_judge_final(\"" 
 	  	    .$row['event'].
 	  	    "\",\"".
 	  	    $row['judge_name']. 
 	  	    "\")'><span class='glyphicon glyphicon-remove'></span> Delete </a></td>";
 	  echo "</tr>";
 	  }
 	echo "</table>";

 	mysql_close($conn);
 }

 function del_judge_final($event, $judge){
 	include 'dbconnect.php';
 	$db_name = 'forum';
 	$tbl_name = 'judges_final';
 	$sql = "DELETE FROM $tbl_name WHERE event='".$event."' AND judge_name='".$judge."'";

 	mysql_select_db("$db_name")or die("cannot select DB");
 	$result = mysql_query($sql,$conn);	
 	if(!$result){
 		echo "Error: Cannot Delete the judge '$judge' for the event '$event'";

 	}
 	else{
 	echo "Success: Judge '$judge' for the event '$event' is successfully deleted from the FINAL list.";
 	}
 	mysql_close($conn);
 }

 function add_judge_final($event, $judge){
 	include 'dbconnect.php';
 	$db_name = 'forum';
 	$tbl_name = 'judges_final';
 	mysql_select_db("$db_name")or die("cannot select DB");
 	$ck_sql = "SELECT * FROM $tbl_name WHERE event='$event'";
 	
 	$r=mysql_query($ck_sql, $conn) or die (mysql_error());

 	// Mysql_num_row is counting table row
 	$cnt=mysql_num_rows($r);
 	// If result matched $myusername and $mypassword, table row must be 1 row
 	if($cnt>=3){
 		echo "Error: A maximum of 3 judges can only be added in the final list. Try deleting few and then adding.";
 	}
 	else{
	 	$sql = "INSERT INTO $tbl_name ".
	 	       "(event,judge_name, date_added) ".
	 	       "VALUES('$event','$judge',(now()))";
	 	

	 	mysql_select_db("$db_name")or die("cannot select DB");
	 	$result = mysql_query($sql,$conn);	
	 	if(!$result){
	 		echo "Error: Cannot Insert the judge '$judge' for the event '$event' in the final list.";

	 	}
	 	else{
	 	echo "Success: Judge '$judge' for the event '$event' is successfully inserted into the FINAL list database.";
	 	}
	}
 	mysql_close($conn);
 }
?>
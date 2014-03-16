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
	del_judge($event, $judge);
}


elseif (empty($_POST['new-judge-event']) or empty($_POST['new-judge']) or empty($_POST['new-judge-status']) ){
	$message = "Event or Judge name or status couldn't be blank";
	echo $message;
}

elseif (isset($_POST['new-judge-event']) and isset($_POST['new-judge']) and isset($_POST['new-judge-status']) ){
	
	include 'dbconnect.php';
	$db_name = 'forum';
	$tbl_name = 'judges';
	
	$new_event = $_POST['new-judge-event'];
	$new_judge = $_POST['new-judge'];
	$new_judge_status = $_POST['new-judge-status'];

	//cleaning post parameters
	$new_event = stripslashes($new_event);
	$new_event = mysql_real_escape_string($new_event);
	$new_judge = stripslashes($new_judge);
	$new_judge = mysql_real_escape_string($new_judge);
	$new_judge_status = stripslashes($new_judge_status);
	$new_judge_status = mysql_real_escape_string($new_judge_status);
	

	$sql = "CREATE TABLE IF NOT EXISTS ".$tbl_name."( ".
	       "judge_id INT(5) NOT NULL AUTO_INCREMENT, ".
	       "event VARCHAR(40) NOT NULL, ".
	       "judge_name VARCHAR(80) , ".
	       "judge_status  VARCHAR(50), ".
	       "date_added timestamp, ".
	       "primary key ( judge_id ))";

	mysql_select_db("$db_name")or die("cannot select DB");
	$retval = mysql_query( $sql, $conn );
	if(! $retval )
	{
	  die('Could not create table: ' . mysql_error());
	}

	$sql="SELECT * FROM $tbl_name WHERE judge_name='$new_judge' AND event='$new_event'";
	$result=mysql_query($sql, $conn);

	// Mysql_num_row is counting table row
	$count=mysql_num_rows($result);

	// If result matched $myusername and $mypassword, table row must be 1 row
	if($count!=0){
		$message = "Failure: Cannot add the judge '$new_judge' because it is already present in db.";
	}
	else{

		$sql = "INSERT INTO $tbl_name ".
		       "(event,judge_name, judge_status, date_added) ".
		       "VALUES('$new_event','$new_judge','$new_judge_status', (now()))";
		
		$retval = mysql_query( $sql, $conn );
		if(! $retval )
		{
		  $message = "Failure: Couldn't add to db due to db error";
		}
		else{
			$message = "Success: Judge ".$new_judge." for event '$new_event' added to database.";
			mysql_close($conn);
		}

	}

	
echo $message;
}

else{
echo "No parameters were specified.";
 }


  // F    U   N    C    T    I    O    N    S

 function view_all_judges($event){
 	include 'dbconnect.php';
 	$db_name = 'forum';
 	$tbl_name = 'judges';
 	mysql_select_db("$db_name")or die("cannot select DB");
 	$view_sql = "SELECT * FROM ".$tbl_name." WHERE event = '".$event."'";
 	$result = mysql_query($view_sql,$conn);
 	echo "<table class='table table-striped'>
 	<tr>
 	<th>Judge Name</th>
 	<th>Judge Status</th>
 	<th>Date Added</th>
 	<th>Operation</th>
 	</tr>";

 	while($row = mysql_fetch_array($result))
 	  {
 	  echo "<tr>";
 	  echo "<td>" . $row['judge_name'] . "</td>";
 	  echo "<td>" . $row['judge_status'] . "</td>";
 	  echo "<td>" . $row['date_added'] . "</td>";
 	  $add_remove_str = 
 	  $sql_chk="SELECT * FROM judges_final WHERE judge_name='".$row['judge_name']."' and event='".$row['event']."'";
 	  $res=mysql_query($sql_chk);

 	  // Mysql_num_row is counting table row
 	  $count=mysql_num_rows($res);

 	  // If result matched $myusername and $mypassword, table row must be 1 row
	 	  if($count==0){
	 	  	$add_remove_str = "Add to FINAL list";
	 	  	$onclick_str = "'javascript:add_judge_final(\"".
	 	  		$row['event'].
	 	  		"\",\"".
	 	  		$row['judge_name'].
	 	  		"\")'";
			$gly = "plus";
	 	  }
	 	  else{
	 	  	$add_remove_str = "Remove from FINAL list";
	 	  	$onclick_str = "'javascript:remove_judge_final(\"".
	 	  		$row['event'].
	 	  		"\",\"".
	 	  		$row['judge_name'].
	 	  		"\")'";
				$gly = "minus";
	 	  }
 	  echo "<td> <a style='cursor:pointer;' alt='Delete this Judge' onclick='javascript:del_judge(\"" 
 	  	    .$row['event'].
 	  	    "\",\"".
 	  	    $row['judge_name']. 
 	  	    "\")'><span class='glyphicon glyphicon-remove'></span> Delete </a>".
			"<a style='cursor:pointer;' onclick=".$onclick_str."> , <span class='glyphicon glyphicon-$gly'></span> $add_remove_str </a></td>";
 	  echo "</tr>";
 	  }
 	echo "</table>";

 	mysql_close($conn);
 }

 function del_judge($event, $judge){
 	include 'dbconnect.php';
 	$db_name = 'forum';
 	$tbl_name = 'judges';
 	$sql = "DELETE FROM $tbl_name WHERE event='".$event."' AND judge_name='".$judge."'";
 	mysql_select_db("$db_name")or die("cannot select DB");
 	$result = mysql_query($sql,$conn);	
 	if(!$result){
 		echo "Error: Cannot Delete the judge '$judge' for the event '$event'";

 	}
 	else{
 	echo "Success: Judge '$judge' for the event '$event' is successfully deleted from the database.";
 	}
 	mysql_close($conn);
 }
?>
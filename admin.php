<?php 
	session_start();
	if(!isset( $_SESSION['user'] ))
	{
    	header("location:admin-login.php");
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
		<script type="text/javascript" src="admin_script.js"></script>

	</head>
	<body>
	<header>
		<nav class="navbar navbar-default">
			<div class="container">

				<a class="navbar-brand" href="#">SiteName</a>
				<div class="collapse navbar-collapse navHeaderCollapse">
					<ul class="nav navbar-nav navbar-right">
						
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> My Account <strong class="caret"></strong></a>
							
							<ul class="dropdown-menu">
								<li>
									<a href="#"><span class="glyphicon glyphicon-wrench"></span> Change password</a>
								</li>

								<li class="divider"></li>
								
								<li>
									<a href="admin-logout.php"><span class="glyphicon glyphicon-off"></span> Sign out</a>
								</li>
							</ul>
						</li>
					</ul>
			
				</div>
			</div>
		</nav>
	</header>

	<div class="container">
		You are logged in.
		<div class="panel panel-default" id="panel-newusers">
			<div class="panel-heading">Add/View Users</div>
			<div class="panel-body">
			
				<div class="row">
					<!--<div class="col-xs-10 col-xs-offset-1">-->
					<div class="col-xs-12">
					<form class="form-inline" role="form" name="add_users" id="add-user-form" method="POST" action="add_users.php">
					  <div class="form-group">
					    <label class="sr-only" for="forum-new-user">Username</label>
					    <input type="text" class="form-control" id="forum-new-user" name="new-user" placeholder="Enter new username">
					  </div>
					  <div class="form-group">
					    <label class="sr-only" for="forum-new-user-pass">Password</label>
					    <input type="password" class="form-control" id="forum-new-user-pass" name="new-user-pass" placeholder="Password">
					  </div>
					  <div class="form-group">
					    <label class="sr-only" for="forum-new-user-desg">Password</label>
					    <input type="password" class="form-control" id="forum-new-user-desg" name="new-user-designation" placeholder="Designation">
					  </div>
					  
					  <button type="submit" class="btn btn-default">Add user</button>
					</form>
					<br/>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
					<div class="alert alert-info" id="add-user-msg" style="display:none;"></div>
					</div>
				</div>
					---OR---<br/><br/>
				<div class="row">
					<div class="col-xs-12">
					<button type="button" class="btn btn-primary" id="view-users-btn" >View All Users</button>
					
					</div><!--col-->
				</div><!--row--><br/>
				<div class="row">
					<div class="col-xs-12">
					<div class="alert alert-danger" style="display:none;" id="del-user-msg"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12" id="view-users-msg"></div>
				</div>
			</div><!--panel-body-->
		</div><!-- panel-->

				<!-- C   A   L   E   N   D   A   R   -->

		<div class="panel panel-default" id="panel-calendar">
			<div class="panel-heading">Add/View Tentative Calendar</div>
			<div class="panel-body">
				<div class="row">
					<!--<div class="col-xs-10 col-xs-offset-1">-->
					<div class="container">
					<form class="form-inline" role="form" enctype="multipart/form-data" id="calendar-form" name="calendar-form" action="calendar.php" method="POST">
					  <div class="form-group">
					    <label class="sr-only" for="tentative-calendar">Tentative Calendar</label>
					    <input type="File" class="form-control" id="tentative-calendar" name="new-tentative-calendar" placeholder="Upload the tentative calendar">
					  </div>
					  <button type="submit" class="btn btn-default">Upload File</button>
					</form>
					<br/>---OR---<br/><br/>
					<button type="button" class="btn btn-primary" id="view-calendar-btn">View all Calendars</button>

					</div><!--container-->
				</div><!--row-->
			</div><!--panel-body-->
		</div><!-- panel-->

				<!-- MINUTES    OF     THE    MEETING -->

		<div class="panel panel-default" id="panel-calendar">
			<div class="panel-heading">Minutes of the Meeting</div>
			<div class="panel-body">
				<div class="row">
					<!--<div class="col-xs-10 col-xs-offset-1">-->
					<div class="col-xs-12">

					<form class="form-horizontal" role="form" name="mom-form" id="mom-form" method="POST" action="mom.php">
					  <div class="form-group">
					    <label for="new-mom-event-name" class="col-sm-2 control-label">Event:</label>
					    <div class="col-sm-2">
					      <select class="form-control" name="new-mom-event" id="new-mom-event-name" placeholder="Select an event">
					      	<optgroup label="Fine Arts Cup">
					    	    <option value="sketching">Sketching</option>
					    	    <option value="postering">Postering</option>
					    	    <option value="cartooning">Cartooning</option>
					    	    <option value="collaging">Collaging</option>
					    	    <option value="thermocol_and_clay_modelling">Thermocol & Clay Modelling</option>
					    	</optgroup>
					    	<optgroup label="Dramatics Cup">
					    	    <option value="hindi_dramatics">Hindi Dramatics</option>
					    	    <option value="englsh_dramatics">English Dramatics</option>
					    	    <option value="bengali_dramatics">Bengali Dramatics</option>
					    	    <option value="chreography">Chreography</option>
					    	    <option value="dumb_charades">Dumb Charades</option>
					    	</optgroup>
					    	<optgroup label="Entertainment Shield">
					    	    <option value="western_instrumentals">Western Instrumentals</option>
					    	    <option value="eastern_instrumentals">Eastern Instrumentals</option>
					    	    <option value="western_vocals">Western Vocals</option>
					    	    <option value="eastern_vocals">Eastern Vocals</option>
					    	    <option value="western_groups">Western Groups</option>
					    	    <option value="eastern_groups">Easter Groups</option>
					    	</optgroup>
					    	<optgroup label="Literary Cup">
					    	    <option value="hindi_elocution">Hindi Elocution</option>
					    	    <option value="englsh_elocution">English Elocution</option>
					    	    <option value="bengali_elocution">Bengali Elocution</option>
					    	    <option value="debate">Debate</option>
					    	    <option value="whats_the_good_word">What's the Good Word</option>
					    	</optgroup>
						  </select>
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="new-mom-date" class="col-sm-2 control-label">Date of Meeting:</label>
					    <div class="col-sm-2">
					      <input type="date" class="form-control" id="new-mom-date" name="new-mom-date">
					    </div>
					  </div>
					  
					  <div class="form-group">
					    <label for="new-mom" class="col-sm-2 control-label">Minutes of Meeting:</label>
					    <div class="col-sm-9">
					      <textarea class="form-control" id="new-mom" name="new-mom" rows="8"></textarea>
					    </div>
					  </div>

					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-7">
					      <button type="submit" class="btn btn-default">View Minutes of Meetings</button>
					    </div>
					  </div>
					</form>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
					<div class="alert alert-info" id="add-mom-msg" style="display:none;"></div>
					</div>
				</div>
				---OR---<br/><br/>
				<div class="row">
					<div class="col-xs-12">
					<form class="form-horizontal" role="form" name="view-mom-form" id="view-mom-form" method="GET" action="mom.php">
					  <div class="form-group">
					    <label for="new-mom-event-name" class="col-sm-2 control-label">Event:</label>
					    <div class="col-sm-3">
					      <select class="form-control" name="view" placeholder="Select an event">
					      	<optgroup label="Fine Arts Cup">
					    	    <option value="sketching">Sketching</option>
					    	    <option value="postering">Postering</option>
					    	    <option value="cartooning">Cartooning</option>
					    	    <option value="collaging">Collaging</option>
					    	    <option value="thermocol_and_clay_modelling">Thermocol & Clay Modelling</option>
					    	</optgroup>
					    	<optgroup label="Dramatics Cup">
					    	    <option value="hindi_dramatics">Hindi Dramatics</option>
					    	    <option value="englsh_dramatics">English Dramatics</option>
					    	    <option value="bengali_dramatics">Bengali Dramatics</option>
					    	    <option value="chreography">Chreography</option>
					    	    <option value="dumb_charades">Dumb Charades</option>
					    	</optgroup>
					    	<optgroup label="Entertainment Shield">
					    	    <option value="western_instrumentals">Western Instrumentals</option>
					    	    <option value="eastern_instrumentals">Eastern Instrumentals</option>
					    	    <option value="western_vocals">Western Vocals</option>
					    	    <option value="eastern_vocals">Eastern Vocals</option>
					    	    <option value="western_groups">Western Groups</option>
					    	    <option value="eastern_groups">Easter Groups</option>
					    	</optgroup>
					    	<optgroup label="Literary Cup">
					    	    <option value="hindi_elocution">Hindi Elocution</option>
					    	    <option value="englsh_elocution">English Elocution</option>
					    	    <option value="bengali_elocution">Bengali Elocution</option>
					    	    <option value="debate">Debate</option>
					    	    <option value="whats_the_good_word">What's the Good Word</option>
					    	</optgroup>
						  </select>
						 </div>
					   </div>
					   <div class="form-group">
						    <div class="col-sm-offset-2 col-sm-7">
						        <button type="submit" class="btn btn-default">Submit</button>
						    </div>
					   </div>
				    </form>
				    </div>
				</div>
					<!--<button type="button" class="btn btn-primary" id="view-mom-btn" >View All Minutes of Meetings</button>-->
				
				
				<div class="row">
					<div class="col-xs-12">
					<div class="alert alert-danger" style="display:none;" id="del-mom-msg"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12" id="view-mom-msg"></div>
				</div>

			</div><!--panel-body-->
		</div><!-- panel-->


				<!-- JUDGES LIST   -->

		<div class="panel panel-default" id="panel-judges-list">
			<div class="panel-heading">Judges List</div>
			<div class="panel-body">
				<div class="row">
				
					<div class="col-xs-12">
					<form class="form-inline" role="form" action="judge.php" method="POST" name="add-judge-form" id="add-judge-form">
					  <div class="form-group">
					    <label class="sr-only" for="">Name of the event</label>
					    
				        <select class="form-control" name="new-judge-event" id="new-judge-list-event-name" placeholder="Select an event">
				    	    <optgroup label="Fine Arts Cup">
					    	    <option value="sketching">Sketching</option>
					    	    <option value="postering">Postering</option>
					    	    <option value="cartooning">Cartooning</option>
					    	    <option value="collaging">Collaging</option>
					    	    <option value="thermocol_and_clay_modelling">Thermocol & Clay Modelling</option>
					    	</optgroup>
					    	<optgroup label="Dramatics Cup">
					    	    <option value="hindi_dramatics">Hindi Dramatics</option>
					    	    <option value="englsh_dramatics">English Dramatics</option>
					    	    <option value="bengali_dramatics">Bengali Dramatics</option>
					    	    <option value="chreography">Chreography</option>
					    	    <option value="dumb_charades">Dumb Charades</option>
					    	</optgroup>
					    	<optgroup label="Entertainment Shield">
					    	    <option value="western_instrumentals">Western Instrumentals</option>
					    	    <option value="eastern_instrumentals">Eastern Instrumentals</option>
					    	    <option value="western_vocals">Western Vocals</option>
					    	    <option value="eastern_vocals">Eastern Vocals</option>
					    	    <option value="western_groups">Western Groups</option>
					    	    <option value="eastern_groups">Easter Groups</option>
					    	</optgroup>
					    	<optgroup label="Literary Cup">
					    	    <option value="hindi_elocution">Hindi Elocution</option>
					    	    <option value="englsh_elocution">English Elocution</option>
					    	    <option value="bengali_elocution">Bengali Elocution</option>
					    	    <option value="debate">Debate</option>
					    	    <option value="whats_the_good_word">What's the Good Word</option>
					    	</optgroup>
				    	</select>
					  </div>
					  <input type="text" class="form-control" id="judge-name" name="new-judge" placeholder="Judge Name">
					  <input type="text" class="form-control" id="judge-status" name="new-judge-status" placeholder="Status of the judge">
					  <button type="submit" class="btn btn-default">Add the Judge</button>
					</form>
					</div>
				</div>
				<br/>
				<div class="row">
					<div class="col-xs-12">
					<div class="alert alert-info" id="add-judge-msg" style="display:none;"></div>
					</div>
				</div>

				---OR---<br/><br/>

				<div class="row">
					<div class="col-xs-12">
					<form class="form-horizontal" role="form" name="view-judge-form" id="view-judge-form" method="GET" action="judge.php">
					  <div class="form-group">
					    <label for="new-judge-event-name" class="col-sm-2 control-label">Event:</label>
					    <div class="col-sm-3">
					      <select class="form-control" name="view" placeholder="Select an event">
					      	<optgroup label="Fine Arts Cup">
					    	    <option value="sketching">Sketching</option>
					    	    <option value="postering">Postering</option>
					    	    <option value="cartooning">Cartooning</option>
					    	    <option value="collaging">Collaging</option>
					    	    <option value="thermocol_and_clay_modelling">Thermocol & Clay Modelling</option>
					    	</optgroup>
					    	<optgroup label="Dramatics Cup">
					    	    <option value="hindi_dramatics">Hindi Dramatics</option>
					    	    <option value="englsh_dramatics">English Dramatics</option>
					    	    <option value="bengali_dramatics">Bengali Dramatics</option>
					    	    <option value="chreography">Chreography</option>
					    	    <option value="dumb_charades">Dumb Charades</option>
					    	</optgroup>
					    	<optgroup label="Entertainment Shield">
					    	    <option value="western_instrumentals">Western Instrumentals</option>
					    	    <option value="eastern_instrumentals">Eastern Instrumentals</option>
					    	    <option value="western_vocals">Western Vocals</option>
					    	    <option value="eastern_vocals">Eastern Vocals</option>
					    	    <option value="western_groups">Western Groups</option>
					    	    <option value="eastern_groups">Easter Groups</option>
					    	</optgroup>
					    	<optgroup label="Literary Cup">
					    	    <option value="hindi_elocution">Hindi Elocution</option>
					    	    <option value="englsh_elocution">English Elocution</option>
					    	    <option value="bengali_elocution">Bengali Elocution</option>
					    	    <option value="debate">Debate</option>
					    	    <option value="whats_the_good_word">What's the Good Word</option>
					    	</optgroup>
						  </select>
						 </div>
					   </div>
					   <div class="form-group">
						    <div class="col-sm-offset-2 col-sm-7">
						        <button type="submit" class="btn btn-default">View Judges</button>
						    </div>
					   </div>
				    </form>
				    </div>
				</div>
					<!--<button type="button" class="btn btn-primary" id="view-mom-btn" >View All Minutes of Meetings</button>-->
				
				<br/>
				<div class="row">
					<div class="col-xs-12">
					<div class="alert alert-danger" style="display:none;" id="del-judge-msg"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12" id="view-judge-msg"></div>
				</div>


				

			</div><!--panel-body-->
		</div><!-- panel-->

<!-- FINAL JUDGES -->

		<div class="panel panel-default" id="panel-judges-final-list">
			<div class="panel-heading">Judges FINAL List</div>
			<div class="panel-body">
				<div class="row">
				
					<div class="col-xs-12">
					<form class="form-inline" role="form" method="GET" action="judges_final.php" name="view-judge-final-form" id="view-judge-final-form">
					  <div class="form-group">
					    <label class="sr-only" for="">Name of the event</label>
					    
				        <select class="form-control" name="view" id="judge-final-list-event-name" placeholder="Select an event">
				    	    <optgroup label="Fine Arts Cup">
					    	    <option value="sketching">Sketching</option>
					    	    <option value="postering">Postering</option>
					    	    <option value="cartooning">Cartooning</option>
					    	    <option value="collaging">Collaging</option>
					    	    <option value="thermocol_and_clay_modelling">Thermocol & Clay Modelling</option>
					    	</optgroup>
					    	<optgroup label="Dramatics Cup">
					    	    <option value="hindi_dramatics">Hindi Dramatics</option>
					    	    <option value="englsh_dramatics">English Dramatics</option>
					    	    <option value="bengali_dramatics">Bengali Dramatics</option>
					    	    <option value="chreography">Chreography</option>
					    	    <option value="dumb_charades">Dumb Charades</option>
					    	</optgroup>
					    	<optgroup label="Entertainment Shield">
					    	    <option value="western_instrumentals">Western Instrumentals</option>
					    	    <option value="eastern_instrumentals">Eastern Instrumentals</option>
					    	    <option value="western_vocals">Western Vocals</option>
					    	    <option value="eastern_vocals">Eastern Vocals</option>
					    	    <option value="western_groups">Western Groups</option>
					    	    <option value="eastern_groups">Easter Groups</option>
					    	</optgroup>
					    	<optgroup label="Literary Cup">
					    	    <option value="hindi_elocution">Hindi Elocution</option>
					    	    <option value="englsh_elocution">English Elocution</option>
					    	    <option value="bengali_elocution">Bengali Elocution</option>
					    	    <option value="debate">Debate</option>
					    	    <option value="whats_the_good_word">What's the Good Word</option>
					    	</optgroup>
				    	</select>
					  </div>
					  
					  <button type="submit" class="btn btn-default">Go</button>
					</form>
					

					</div><!--container-->
				</div><!--row-->
				<br/>
				<div class="row">
					<div class="col-xs-12">
					<div class="alert alert-danger" style="display:none;" id="del-judge-final-msg"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12" id="view-judge-final-msg"></div>
				</div>
			</div><!--panel-body-->
		</div><!-- panel-->


	</div><!--container-->
	</body>
</html>
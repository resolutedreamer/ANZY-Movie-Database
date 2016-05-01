<!DOCTYPE html>
<html>
<head>
    <title>ANZY Movie Database - Add Actor/Director</title>
    <meta charset="utf-8" />
    <link href="Content/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
		<nav class="navbar navbar-default">
		  <div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			  <a class="navbar-brand" href="index.php">ANZY Movie Database</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			  <ul class="nav navbar-nav">
				<li><a href="actor_info.php">Actor List <span class="sr-only">(current)</span></a></li>
				<li><a href="movie_info.php">Movie List </a></li>
				
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Add Info<span class="caret"></span></a>
				  <ul class="dropdown-menu">
					<li><a href="add_actor_director.php">Add Actor/Director</a></li>
					<li><a href="add_movie.php">Add Movie</a></li>
					<li><a href="add_comments.php">Add Movie Comment</a></li>
					<li role="separator" class="divider"></li>
					<li><a href="add_actor_to_movie.php">Add Actors to Movie</a></li>
					<li><a href="add_director_to_movie.php">Add Directors to Movie</a></li>
				  </ul>
				</li>

			  </ul>
			  
			  <form class="navbar-form navbar-right" role="form" action="search.php">
				<div class="form-group">
				  <input type="text" name="query" class="form-control" placeholder="Search for Actor or Movie">
				</div>
				<button type="submit" class="btn btn-default">Search</button>
			  </form>
			  
			</div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>

        <div class="jumbotron">
            <h1>
                ANZY Movie Database
            </h1>
            <h2>
                Add Actor/Director
            </h2>
        </div>
        
		
		<form method = "GET" action = "add_actor_director.php">
			<p> * are required items</p>
			<p> Please use "yyyymmdd" or "yyyy/mm/dd"</p>
			<p>Identity: <input type="radio" name = "identity" value = "Actor" checked>Actor
			<input type="radio" name = "identity" value = "Director">Director
			<input type="radio" name = "identity" value = "Actor-Director">Actor and Director </p>
			<p>First Name: <input type="text" name="first"></p>
			<p>Last Name: <input type="text" name="last"></p>
			<p>Sex: <input type="radio" name = "sex" value = "'Male'" checked>Male 
			<input type="radio" name = "sex" value = "'Female'">Female</p>
			<p>Date of Birth: <input type="text" name="dob" required>*</p>
			<p>Date of Death: <input type="text" name="dod"></p>
			<p><input type="submit" value = "Add"></p>
		</form>


		<?php
			if($_GET['dob']){
				$db_connection = mysql_connect("localhost", "cs143", "");
				mysql_select_db("CS143", $db_connection);
				$identity = $_GET['identity'];
				$firstname = $_GET['first'];
				$firstname = !empty($firstname) ? "'$firstname'" : "NULL";
				$lastname = $_GET['last'];
				$lastname = !empty($lastname) ? "'$lastname'" : "NULL";
				$sex = $_GET['sex'];
				$dob = $_GET['dob'];
				$dod = $_GET['dod'];
				$dod = !empty($dod) ? "$dod" : "NULL";
				$query_max = 'SELECT * FROM MaxPersonID';
				$rs = mysql_query($query_max, $db_connection);
				$error = mysql_error();
				$maxPID = mysql_fetch_row($rs);
				
				if ($identity == "Actor-Director"){
					$query_insert_actor = 'INSERT INTO Actor VALUES ('.($maxPID[0]+1).','.$lastname.','.$firstname.',"'.$sex.'",'.$dob.','.$dod. ')';
					$query_insert_director = 'INSERT INTO Director VALUES ('.($maxPID[0]+1).','.$lastname.','.$firstname.','.$dob.','.$dod. ')';
					mysql_query($query_insert_actor, $db_connection);
					$error = mysql_error();
					if ($error != '' ) {
						print '<strong>An error occurred!</strong> ' . $error;
						mysql_close($db_connection);
						exit();
					}
					mysql_query($query_insert_director, $db_connection);
					$error = mysql_error();
					if ($error != '' ) {
						print '<strong>An error occurred!</strong> ' . $error;
						mysql_close($db_connection);
						exit();
					}
				}

				else if ($identity == "Director") {
					$query_insert = 'INSERT INTO Director VALUES ('.($maxPID[0]+1).','.$lastname.','.$firstname.','.$dob.','.$dod. ')';
					mysql_query($query_insert, $db_connection);
					$error = mysql_error();
					if ($error != '' ) {
						print '<strong>An error occurred!</strong> ' . $error;
						mysql_close($db_connection);
						exit();
					}
				}

				else{
					$query_insert = 'INSERT INTO Actor VALUES ('.($maxPID[0]+1).','.$lastname.','.$firstname.','.$sex.','.$dob.','.$dod. ')';
					mysql_query($query_insert, $db_connection);
					$error = mysql_error();
					if ($error != '' ) {
						print '<strong>An error occurred!</strong> ' . $error;
						mysql_close($db_connection);
						exit();
					}
				}
				$query_max = 'UPDATE MaxPersonID SET id = '.($maxPID[0]+1);
				mysql_query($query_max, $db_connection);
				mysql_close($db_connection);
				echo "Add successful!";
			}
		?>

    </div> 
</body>

<footer class="navbar-default navbar-fixed-bottom">
  <div class="container">
    <span>Copyright 2016 Anthony Nguyen and Yuyin Zhou</span>
  </div>
</footer>

<script src="Scripts/jquery-2.2.2.min.js"></script>
<script src="Scripts/bootstrap.min.js"></script> 
</html>
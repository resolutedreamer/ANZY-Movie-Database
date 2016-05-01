<!DOCTYPE html>
<html>
<head>
    <title>ANZY Movie Database - Add Movie</title>
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
                Add Movie
            </h2>
        </div>
        
		<form method="GET" action="add_movie.php" name = "input">
			Movie Title: <input type="text" name="movie" required>
			Actor Name: <input type="text" name="actor" required>
			<input type="submit" value = "search">
		</form>
		
		<?php
			if($_GET['actor'] AND $_GET['movie']){
				$db_connection = mysql_connect("localhost", "cs143", "");
				mysql_select_db("CS143", $db_connection);

				$actor_name = $_GET['actor'];
				$keywords = explode(" ", $actor_name);
				foreach ($keywords as $word) {
					$sql_actor[] = ' CONCAT(first, " ", last) LIKE "%'. $word. '%"';
				}
				$query_actor = 'SELECT * FROM Actor WHERE'. implode(' AND ', $sql_actor);
				$rs_actor = mysql_query($query_actor, $db_connection);
				$error = mysql_error();
				if ($error != '' ) {
					print '<strong>An error occurred!</strong> ' . $error;
					mysql_close($db_connection);
					exit();
				}
				
				if (mysql_num_rows($rs_actor) != 0){
					echo "Searching results in Actor database";
					echo "<table>";
					echo "<tr>";
					$num = mysql_num_fields($rs_actor);
					for ($i = 1; $i < $num; $i ++){
						echo "<th>".mysql_field_name($rs_actor, $i)."</th>";
					}
					echo "</tr>";
					echo '<form method="GET" action="addMovieActor.php" name = "selection">';
					while($row = mysql_fetch_row($rs_actor)) {
						echo "<tr>";
						for ($x = 1; $x < sizeof($row); $x ++){
							if ($row[$x]===NULL){
								echo "<td> NULL </td>";
							}else{
								echo "<td>". $row[$x]. "</td>";
							}
						}
						echo '<td><input type="radio" name="check_actor" value="'.$row[0].'"> Choose this actor</td>';
						echo "</tr>";
					}
					echo "</table>";
					
				}else{
					echo "No matching results in Actor database";
				}

				$movie_name = $_GET['movie'];
				$keywords = explode(" ", $movie_name);
				foreach ($keywords as $word) {
					$sql_movie[] = ' title LIKE "%'. $word. '%"';
				}
				$query_movie = 'SELECT * FROM Movie WHERE'. implode(' AND ', $sql_movie);
				$rs_movie = mysql_query($query_movie, $db_connection);
				$error = mysql_error();
				if ($error != '' ) {
					print '<strong>An error occurred!</strong> ' . $error;
					mysql_close($db_connection);
					exit();
				}
				if (mysql_num_rows($rs_movie) != 0){
					echo "Searching results in Movie database";
					echo "<table>";
					echo "<tr>";
					$num = mysql_num_fields($rs_movie);
					for ($i = 1; $i < $num; $i ++){
						echo "<th>".mysql_field_name($rs_movie, $i)."</th>";
					}
					echo "</tr>";

					
					while($row = mysql_fetch_row($rs_movie)) {
						echo "<tr>";
						for ($x = 1; $x < sizeof($row); $x ++){
							if ($row[$x]===NULL){
								echo "<td> NULL </td>";
							}else{
								echo "<td>". $row[$x]. "</td>";
							}
						}
						echo '<td><input type="radio" name="check_movie" value="'.$row[0].'"> Choose this actor</td>';
						echo "</tr>";
					}
					echo "</table>";
				}else{
					echo 'No matching results in Movie database';
				}
				if (mysql_num_rows($rs_actor) != 0 AND mysql_num_rows($rs_movie) != 0){
					echo 'Role of the actor: <input type="text" name = "role"><br>';
					echo '<input type="submit" value = "submit"></form>';
				}
				mysql_close($db_connection);
			}
		?>
		<?php
			if ($_GET['check_actor'] AND $_GET['check_movie']){
				$db_connection = mysql_connect("localhost", "cs143", "");
				mysql_select_db("CS143", $db_connection);

				$role =$_GET['role'];
				$role = !empty($role)?"'$role'":"NULL";
				$query_insert = 'INSERT INTO MovieActor VALUES ('.$_GET['check_movie'].', '.$_GET['check_actor'].','.$role.')';
				mysql_query($query_insert, $db_connection);
				$error = mysql_error();
				if ($error != '' ) {
					print '<strong>An error occurred!</strong> ' . $error;
					mysql_close($db_connection);
					exit();
				}
			}
			mysql_close($db_connection);
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
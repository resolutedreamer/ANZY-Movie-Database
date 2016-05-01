<!DOCTYPE html>
<html>
<head>
    <title>ANZY Movie Database - Add Director to Movie</title>
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
                Add Director to Movie
            </h2>
        </div>

		<form method="GET" action="add_director_to_movie.php" name = "input">
			Movie Title: <input type="text" name="movie" required>
			Director Name: <input type="text" name="dir" required>
			<input type="submit" value = "search">
		</form>
		<?php
			if($_GET['dir'] AND $_GET['movie']){
				$db_connection = mysql_connect("localhost", "cs143", "");
				mysql_select_db("CS143", $db_connection);

				$dir_name = $_GET['dir'];
				$keywords = explode(" ", $dir_name);
				foreach ($keywords as $word) {
					$sql_dir[] = ' CONCAT(first, " ", last) LIKE "%'. $word. '%"';
				}
				$query_dir = 'SELECT * FROM Director WHERE'. implode(' AND ', $sql_dir);
				$rs_dir = mysql_query($query_dir, $db_connection);
				$error = mysql_error();
				if ($error != '' ) {
					print '<strong>An error occurred!</strong> ' . $error;
					mysql_close($db_connection);
					exit();
				}
				
				if (mysql_num_rows($rs_dir) != 0){
					echo "Searching results in Director database";
					echo "<table>";
					echo "<tr>";
					$num = mysql_num_fields($rs_dir);
					for ($i = 1; $i < $num; $i ++){
						echo "<th>".mysql_field_name($rs_dir, $i)."</th>";
					}
					echo "</tr>";
					echo '<form method="GET" action="AddDirectorToMovie.php" name = "selection">';
					while($row = mysql_fetch_row($rs_dir)) {
						echo "<tr>";
						for ($x = 1; $x < sizeof($row); $x ++){
							if ($row[$x]===NULL){
								echo "<td> NULL </td>";
							}else{
								echo "<td>". $row[$x]. "</td>";
							}
						}
						echo '<td><input type="radio" name="check_dir" value="'.$row[0].'"> Choose this director</td>';
						echo "</tr>";
					}
					echo "</table>";
					
				}else{
					echo "No matching results!";
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
						echo '<td><input type="radio" name="check_movie" value="'.$row[0].'"> Choose this movie</td>';
						echo "</tr>";
					}
					echo "</table>";
				}else{
					echo 'No matching results in Movie database';
				}
				if (mysql_num_rows($rs_dir) != 0 AND mysql_num_rows($rs_movie) != 0){
					echo '<input type="submit" value = "submit"></form>';
				}
				mysql_close($db_connection);
			}
		?>
		<?php
			if ($_GET['check_dir'] AND $_GET['check_movie']){
				$db_connection = mysql_connect("localhost", "cs143", "");
				mysql_select_db("CS143", $db_connection);
				
				$query_insert = 'INSERT INTO MovieDirector VALUES ('.$_GET['check_movie'].', '.$_GET['check_dir'].')';
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
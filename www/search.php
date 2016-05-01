<!DOCTYPE html>
<html>
<head>
    <title>ANZY Movie Database - Search Results</title>
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
				<li><a href="full_list.php?type=actor">Actor List <span class="sr-only">(current)</span></a></li>
				<li><a href="full_list.php?type=movie">Movie List </a></li>
				<li><a href="full_list.php?type=director">Director List </a></li>
				
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Add Info<span class="caret"></span></a>
				  <ul class="dropdown-menu">
					<li><a href="add_info.php?add=actor_director">Add Actor/Director</a></li>
					<li><a href="add_info.php?add=movie">Add Movie</a></li>
					<li><a href="add_info.php?add=comment">Add Movie Comment</a></li>
					<li role="separator" class="divider"></li>
					<li><a href="add_info.php?add=actor_to_movie">Add Actors to Movie</a></li>
					<li><a href="add_info.php?add=director_to_movie">Add Directors to Movie</a></li>
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
                Search Results
            </h2>
        </div>

            <?php
			
			function print_table_from_query($query)
			{
				// now we gotta parse the query for different words
				$db_connection = mysql_connect("localhost", "cs143", "");
				if(!$db_connection) {
					$errmsg = mysql_error($db_connection);
					print "Connection failed: $errmsg <br />";
					echo "Connection failed: $errmsg <br />";
					exit(1);
				}
				mysql_select_db("CS143", $db_connection);
				$result = mysql_query($query, $db_connection);
				//$result = mysql_query($my_SQL_query, $db_connection);
				if (!$result) {
					die('Query failed: ' . mysql_error());
				}
				
				
				/* get column metadata */
				$i = 0;
				echo "<table class='table table-striped'>"; // start a table tag in the HTML
				echo "<tr>"; 
				while ($i < mysql_num_fields($result)) {
					//echo "Information for column $i:<br />\n";
					$meta = mysql_fetch_field($result, $i);
					if (!$meta) {
						echo "No information available<br />\n";
					}
					echo "<td>" . $meta->name . "</td>";
					/*
					echo "<pre>
					blob:         $meta->blob
					max_length:   $meta->max_length
					multiple_key: $meta->multiple_key
					name:         $meta->name
					not_null:     $meta->not_null
					numeric:      $meta->numeric
					primary_key:  $meta->primary_key
					table:        $meta->table
					type:         $meta->type
					unique_key:   $meta->unique_key
					unsigned:     $meta->unsigned
					zerofill:     $meta->zerofill
					</pre>";
					*/
					$i++;
				}
				echo "</tr>";

				// now i is equal to the number of columns
				$num_columns = $i;
				$i = 0;
				//echo "The result has: " . $num_columns . " columns.";

				while($row = mysql_fetch_row($result)){   //Creates a loop to loop through results
					echo "<tr>";
					while ($i < $num_columns ) {
						echo "<td>" . $row[$i] . "</td>";
						$i++;
					}
					echo "</tr>";
					$i = 0;
				}

				echo "</table>"; //Close the table in HTML
			}
			
			$actor_query = "SELECT first, last FROM Actor WHERE";
			$movie_query = "SELECT title FROM Movie WHERE";
			
			$user_search = $_GET['query'];
			$distinct_words_in_search = explode(" ", $user_search);
			
			foreach ($distinct_words_in_search as $word_in_search) {
				echo $word_in_search . " ";
				// the .= is the string concatination operator
				$actor_query .= " first LIKE'%" . $word_in_search . "%' OR last LIKE '%" . $word_in_search . "%' OR";
				$movie_query .= " title LIKE '%" . $user_search . "%' OR";
			}
			
			$actor_query = substr($actor_query, 0, -2);
			$movie_query = substr($movie_query, 0, -2);
				
			echo $actor_query . " ";
			echo $movie_query . " ";

			echo "<h2>" . "Actor Search Results" . "</h2>";
			echo "<p><u>" . "Searching for</u>: <b>" . $user_search . "</b></p>";
			
			$query = $actor_query;
			//echo $query;
			print_table_from_query($query);
			
			echo "<h2>" . "Movie Search Results" . "</h2>";
			echo "<p><u>" . "Searching for</u>: <b>" . $user_search . "</b></p>";
			
			$query = $movie_querry;
			//echo $query;
			print_table_from_query($query);
			
			
			
			//echo "The End!";
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
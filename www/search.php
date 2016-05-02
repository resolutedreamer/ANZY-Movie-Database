<!DOCTYPE html>
<html>
<?php 
	include 'subpages/functions.php';
?>
<head>
    <title>ANZY Movie Database - Search Results</title>
    <meta charset="utf-8" />
    <link href="Content/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
		
	<?php
		include 'subpages/nav_bar.php';
	?>
        <div class="jumbotron">
            <h1>
                ANZY Movie Database
            </h1>
            <h2>
                Search Results
            </h2>
        </div>

            <?php
			
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
			$result = result_from_query($query);
			print_result($result);
			
			echo "<h2>" . "Movie Search Results" . "</h2>";
			echo "<p><u>" . "Searching for</u>: <b>" . $user_search . "</b></p>";
			
			$query = $movie_query;
			//echo $query;
			$result = result_from_query($query);
			print_result($result);
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
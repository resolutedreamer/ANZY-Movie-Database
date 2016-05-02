<!DOCTYPE html>
<html>
<script src="Scripts/jquery-2.2.2.min.js"></script>
<script src="Scripts/bootstrap.min.js"></script>
<?php 
	include 'subpages/functions.php';
?>
<?php
	$page_type = $_GET['type'];
	$id = $_GET['id'];
	$movie_title = $_GET['title'];
	$title = "Detailed Actor Information";
	
	switch ($page_type) {
		case "actor":
			$title = "Detailed Actor Information: $movie_title";
			break;
		case "movie":
			$title = "Detailed Movie Information: $movie_title";
			break;
		case "director":
			$title = "Detailed Director Information: $movie_title";
			break;
		default:
			$title = "Detailed Actor Information: $movie_title";
	}
	
?>
<head>
    <title>ANZY Movie Database - <?php echo $title; ?></title>
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
                <?php echo $title; ?>
            </h2>
        </div>
		
		<?php
			$query = "select * from Actor where id=$id";
			
			switch ($page_type) {
				case "actor":
					// first print our actor information
					
					$query = "select * from Actor where id=$id";
					$table_type = "actor";
					$result = result_from_query($query);
					print_result($result, $table_type);
					
					// then using actor id (aid), get the ids of the movies they were in
					$query = "select mid from MovieActor where aid=$id";
					$result = result_from_query($query);
					$ids = get_ids_from_result($result);
					// using the ids, construct a new query
					$query "select id, title from Movie where id in $ids";
					// now print that table out
					$result = result_from_query($query);
					print_result($result, $table_type);
					
					echo "I am an actor.";
					break;
				case "movie":
					// first print our movie information
					$query = "select * from Movie where id=$id";
					$table_type = "movie";
					$result = result_from_query($query);
					print_result($result, $table_type);
					
					// then using movie id (mid), get the ids of the actors that were in this movie
					$query = "select aid from MovieActor where mid=$id";
					$result = result_from_query($query);
					$ids = get_ids_from_result($result);
					// using the ids, construct a new query
					$query "select id, first, last from Actor where id in $ids";
					// now print that table out
					$result = result_from_query($query);
					print_result($result, $table_type);
					
					// then get all the user comments
					
					// then get the average of the scores
					
					
					// button to add comments
					echo "I am a movie.";
					
					break;
				case "director":
					$query = "select * from Director where id=$id";
					$table_type = "director";
					$result = result_from_query($query);
					print_result($result, $table_type);
					echo "I am a director.";
					break;
				default:
					echo "qq";
			}
			
		
		?>
		
    </div> 
</body>

<footer class="navbar-default navbar-fixed-bottom">
  <div class="container">
    <span>Copyright 2016 Anthony Nguyen and Yuyin Zhou</span>
  </div>
</footer>

</html>
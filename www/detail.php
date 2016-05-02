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
					$query = "select * from Actor where id=$id";
					$table_type = "actor";
					$result = result_from_query($query);
					echo "I am an actor.";
					print_result($result, $table_type);

					// then using actor id (aid), get the ids of the movies they were in
					$query = "select mid from MovieActor where aid=$id";
					$result = result_from_query($query);
					print_result($result, $table_type);
					
					$ids = get_ids_from_result($result);
					
					// using the ids of the movies, get the movies info
					$query = "select * from Movie where mid=$ids";
					
					
					break;
				case "movie":
					$query = "select * from Movie where id=$id";
					$table_type = "movie";
					$result = result_from_query($query);
					echo "I am a movie.";
					print_result($result, $table_type);
					
					// then using actor id (aid), get the ids of the movies they were in
					$query = "select aid from MovieActor where mid=$id";
					$result = result_from_query($query);
					print_result($result, $table_type);
					
					// then get all the user comments
					$query = "select * from Review where mid=$id";
					$result = result_from_query($query);
					print_result($result, $table_type);
					
					// then get the average of the scores
					$query = "select avg(rating) from Review where mid=$id";
					$result = result_from_query($query);
					print_result($result, $table_type);
					
					// button to add comments
					echo "<a href='add_info.php?add=comment&mid=$id'><button type='button' class='btn btn-default'>Add Comment</button></a>";
					
					break;
				case "director":
					$query = "select * from Director where id=$id";
					$table_type = "director";
					$result = result_from_query($query);
					echo "I am a director.";
					print_result($result, $table_type);
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
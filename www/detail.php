<!DOCTYPE html>
<html>
<?php 
	include 'functions.php';
?>
<?php
	$page_type = $_GET['type'];
	$id = $_GET['id'];
	$title = "Detailed Actor Information";
	
	switch ($page_type) {
		case "actor":
			$title = "Detailed Actor Information";
			break;
		case "movie":
			$title = "Detailed Movie Information";
			break;
		case "director":
			$title = "Detailed Director Information";
			break;
		default:
			$title = "Detailed Actor Information";
	}
?>
<head>
    <title>ANZY Movie Database - <?php echo $title; ?></title>
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
                <?php echo $title; ?>
            </h2>
        </div>
		
		<?php
			$query = "select * from Actor where id=$id";
			switch ($page_type) {
				case "actor":
					// first print our actor information
					/*
					$query = "select * from Actor where id=$id";
					$table_type = "actor";
					$result = result_from_query($query, $table_type);
					print_result($result);
					
					// then using actor id (aid), get the ids of the movies they were in
					$query = "select mid from MovieActor where aid=$id";
					$result = result_from_query($query, $table_type);
					ids = get_ids_from_result($result);
					// using the ids, construct a new query
					$query "select id, title from Movie where id in $ids";
					// now print that table out
					$result = result_from_query($query, $table_type);
					print_result($result);
					*/
					break;
				case "movie":
					// first print our movie information
					$query = "select * from Movie where id=$id";
					$table_type = "movie";
					$result = result_from_query($query, $table_type);
					print_result($result);
					
					// then using movie id (mid), get the ids of the actors that were in this movie
					$query = "select aid from MovieActor where mid=$id";
					$result = result_from_query($query, $table_type);
					ids = get_ids_from_result($result);
					// using the ids, construct a new query
					$query "select id, first, last from Actor where id in $ids";
					// now print that table out
					$result = result_from_query($query, $table_type);
					print_result($result);
					
					// then get all the user comments
					
					// then get the average of the scores
					
					
					// button to add comments
					echo 
					
					break;
				case "director":
					$query = "select * from Director where id=$id";
					$table_type = "director";
					$result = result_from_query($query, $table_type);
					print_result($result);
					
					break;
				default:
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
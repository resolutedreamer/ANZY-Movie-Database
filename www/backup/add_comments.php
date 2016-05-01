<!DOCTYPE html>
<html>
<head>
    <title>ANZY Movie Database - Add Movie Comments</title>
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
                Add Movie Comments
            </h2>
        </div>

		
		<?php
			$mid = $_GET['mid'];
		?>
		<form method="GET" action = "add_comments.php">
			<p> * are required items</p>
			Reviewer name: <input type="text" name="name"><br>
			Movie ID: <input type="text" name="mid" required value = "<?php echo $mid; ?>">* <br>
			Movie Rating (out of 5): <select name="rating" id = "rating">
				<option value=1>1</option>
				<option value=2>2</option>
				<option value=3>3</option>
				<option value=4>4</option>
				<option value=5>5</option>
			</select><br>
			Movie Comment: <br>
			<textarea NAME="comment" ROWS=10 COLS=30></textarea>	
			<input type="submit" name="subject" value="Add">
		</form>

		<?php
		if($_GET['mid'] AND $_GET['subject']){
			$db_connection = mysql_connect("localhost", "cs143", "");
			mysql_select_db("CS143", $db_connection);
			$mid = $_GET['mid'];
			$name = $_GET['name'];
			$name = !empty($name) ? "'$name'" : "NULL";
			$rating = $_GET['rating'];
			$comment = $_GET['comment'];
			$comment = !empty($comment) ? "'$comment'" : "NULL";
			$query_insert_comment = 'INSERT INTO Review VALUES ('.$name.',NOW(),'.$mid.','.$rating.','.$comment.')';
			mysql_query($query_insert_comment, $db_connection);
			$error = mysql_error();
			if ($error != '' ) {
				print '<strong>An error occurred!</strong> ' . $error;
				mysql_close($db_connection);
				exit();
			}
			mysql_close($db_connection);
			echo "Data submitted!";
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
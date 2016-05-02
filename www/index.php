<!DOCTYPE html>
<html>
<?php 
	include 'subpages/functions.php';
?>
<head>
    <title>ANZY Movie Database - Homepage</title>
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
                Homepage
            </h2>
        </div>
		<?php 
		$rand_actor_id = rand (  0 ,  10 );
		$rand_movie_id = rand (  0 ,  10 );
		$rand_director_id = rand (  0 ,  10 );
		?>
		Random Actor of the Day:
		Random Movie of the Day:
		Random Director of the Day:
		
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
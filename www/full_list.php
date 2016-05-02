<!DOCTYPE html>
<html>
<script src="Scripts/jquery-2.2.2.min.js"></script>
<script src="Scripts/bootstrap.min.js"></script>
<?php 
	include 'subpages/functions.php';
?>
<?php 
	$page_type = $_GET['type'];
	$title = "All Actors";
	
	switch ($page_type) {
		case "actor":
			$title = "All Actors";
			break;
		case "movie":
			$title = "All Movies";
			break;
		case "director":
			$title = "All Directors";
			break;
		default:
			$title = "All Actors";
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
			$query = "select * from Actor";
			$table_type = "actor";
			switch ($page_type) {
				case "actor":
					$query = "select id, first, last from Actor";
					$table_type = "actor";
					break;
				case "movie":
					$query = "select id, title from Movie";
					$table_type = "movie";
					break;
				case "director":
					$query = "select id, first, last from Director";
					$table_type = "director";
					break;
				default:
					$query = "select * from Actor";
			}			
			$result = result_from_query($query);
			print_result($result, $table_type);
		?>
    </div> 
</body>


<footer class="navbar-default navbar-fixed-bottom">
  <div class="container">
    <span>Copyright 2016 Anthony Nguyen and Yuyin Zhou</span>
  </div>
</footer>

</html>
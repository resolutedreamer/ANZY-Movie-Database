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

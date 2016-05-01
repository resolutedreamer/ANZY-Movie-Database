<?php
	$mid = $_GET['mid'];
?>
<form method="GET" action = "add_info.php?add=comment">
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

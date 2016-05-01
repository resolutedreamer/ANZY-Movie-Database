<form method = "GET" action = "add_info.php?add=movie">
	<p> * are required items</p>
	<p> Please use "yyyymmdd" or "yyyy/mm/dd"</p>
	<p>Identity: <input type="radio" name = "identity" value = "Actor" checked>Actor
	<input type="radio" name = "identity" value = "Director">Director
	<input type="radio" name = "identity" value = "Actor-Director">Actor and Director </p>
	<p>First Name: <input type="text" name="first"></p>
	<p>Last Name: <input type="text" name="last"></p>
	<p>Sex: <input type="radio" name = "sex" value = "'Male'" checked>Male 
	<input type="radio" name = "sex" value = "'Female'">Female</p>
	<p>Date of Birth: <input type="text" name="dob" required>*</p>
	<p>Date of Death: <input type="text" name="dod"></p>
	<p><input type="submit" value = "Add"></p>
</form>

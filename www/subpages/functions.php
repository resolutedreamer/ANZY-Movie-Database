<?php
function result_from_query($query)
{
	// now we gotta parse the query for different words
	$db_connection = mysql_connect("localhost", "cs143", "");
	if(!$db_connection) {
		$errmsg = mysql_error($db_connection);
		print "Connection failed: $errmsg <br />";
		echo "Connection failed: $errmsg <br />";
		exit(1);
	}
	mysql_select_db("CS143", $db_connection);
	
	
	$result = mysql_query($query, $db_connection);
	if (!$result) {
		die('Query failed: ' . mysql_error());
	}
	mysql_close($db_connection);
	return $result;
}

function print_result($result, $table_type = "actor")
{
	/* get column metadata */
	$i = 0;
	echo "<table class='table table-striped'>"; // start a table tag in the HTML
	echo "<tr>"; 
	while ($i < mysql_num_fields($result)) {
		//echo "Information for column $i:<br />\n";
		$meta = mysql_fetch_field($result, $i);
		if (!$meta) {
			echo "No information available<br />\n";
		}
		// this line is used to print the title of each column of the table
		echo "<td>" . $meta->name . "</td>";
		/*
		echo "<pre>
		blob:         $meta->blob
		max_length:   $meta->max_length
		multiple_key: $meta->multiple_key
		name:         $meta->name
		not_null:     $meta->not_null
		numeric:      $meta->numeric
		primary_key:  $meta->primary_key
		table:        $meta->table
		type:         $meta->type
		unique_key:   $meta->unique_key
		unsigned:     $meta->unsigned
		zerofill:     $meta->zerofill
		</pre>";
		*/
		$i++;
	}
	echo "</tr>";

	// now i is equal to the number of columns
	$num_columns = $i;
	$i = 0;
	//echo "The result has: " . $num_columns . " columns.";
	
	while($row = mysql_fetch_row($result)){
		//Creates a loop to loop through results
		echo "<tr>";
		
		while ($i < $num_columns ) {
			echo "<td><a href=\"detail.php?type=$table_type&id=$row[0]\">" . $row[$i] . "</a></td>";
			$i++;
		}
		echo "</tr>";
		$i = 0;
	}

	echo "</table>"; //Close the table in HTML
}

function get_ids_from_result($result) {
	//array ids = array();
	return $result;
}


?>
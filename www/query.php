<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8" />
    <link href="Content/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <script src="Scripts/jquery-2.2.2.min.js"></script>
    <script src="Scripts/bootstrap.min.js"></script>
    <div class="container">
        <div class="jumbotron">
            <h1>
                CS 143 Project 1A
            </h1>
            <h2>
                Anthony Nguyen and Yuyin Zhou
            </h2>
        </div>

        <!--<form role="form" method="post" action="index.html">-->
            <form role="form" action="query.php">
                <div class="form-group">
                    <label for="query" class="control-label">Query:</label>
                    <textarea class="form-control" name="query" id="query" rows="5" cols="20"></textarea>
                    <button type="submit" class="btn btn-default">Submit Query</button>
                </div>
            </form>
        
            <?php
			$my_SQL_query =$_GET['query'];
			echo "<p><u>" . "Executing Query</u>: <b>" . $my_SQL_query . "</b></p>";
			$db_connection = mysql_connect("localhost", "cs143", "");
			if(!$db_connection) {
				$errmsg = mysql_error($db_connection);
				print "Connection failed: $errmsg <br />";
				echo "Connection failed: $errmsg <br />";
				exit(1);
			}
			mysql_select_db("CS143", $db_connection);
			$query = "select * from Student";
			//$rs = mysql_query($query, $db_connection);
			$result = mysql_query($my_SQL_query, $db_connection);
			if (!$result) {
				die('Query failed: ' . mysql_error());
			}
			
			
			/* get column metadata */
			$i = 0;
			echo "<table>"; // start a table tag in the HTML
			echo "<tr>"; 
			while ($i < mysql_num_fields($result)) {
				//echo "Information for column $i:<br />\n";
				$meta = mysql_fetch_field($result, $i);
				if (!$meta) {
					echo "No information available<br />\n";
				}
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

			while($row = mysql_fetch_row($result)){   //Creates a loop to loop through results
				echo "<tr>";
				while ($i < $num_columns ) {
					echo "<td>" . $row[$i] . "</td>";
					$i++;
				}
				echo "</tr>";
				$i = 0;
			}

			echo "</table>"; //Close the table in HTML
			//echo "The End!";
			mysql_close($db_connection);
		?>
    </div> 
</body>
</html>
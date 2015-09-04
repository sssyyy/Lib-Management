<!--
file Name: music_category.php
purpose: connects to database 
Gets the music of certain category number and/name. 
-->


<?php
$db = mysql_connect("localhost", "yusaf", "yusaf")
if(!$db)
{
die('Could not connect: ' . mysql_error()); 
}
$er = mysql_select_db("yusaf");

$result = mysql_query("select M_title AS Title, M_author As Author, C_name AS Category, M_id As ID from music, category  where (M_cId=$Cat_Num) And (M_cId=C_id)");

// Get the number of rows in the result, as well as the first row
//  and the number of fields in the rows
$num_rows = mysql_num_rows($result);
$row = mysql_fetch_array($result);
$num_fields = mysql_num_fields($result);

	if (empty($num_rows))
	{
		echo "There are currently no music on this category";
	}
	else
	{	
	 print "<table class='categorytable' align='center' border=1 bgcolor='#a5c0b8'><caption> <h2> Music found on $Cat_Name</h2> </caption>";
		print "<tr align = 'center'>";

		// Produce the column labels
		$keys = array_keys($row);
		for ($index = 0; $index < $num_fields; $index++)
			print "<th class='th$index'>" . $keys[2 * $index + 1] . "</th>";

		print "</tr>";

		// Output the values of the fields in the rows

		for ($row_num = 0; $row_num < $num_rows; $row_num++) {
			print "<tr align = 'left'>";
			$values = array_values($row);
			for ($index = 0; $index < $num_fields; $index++) {
				$value = htmlspecialchars($values[2 * $index + 1]);
				print "<th class='th$index'> " . $value . "\t" . "</th> ";
			}

			print "</tr>";
			$row = mysql_fetch_array($result);
		}
		print "</table>";
	}
	?>


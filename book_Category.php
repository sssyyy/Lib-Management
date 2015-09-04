<html lang="en">
<!--
purpose: Shows list of books under the category agriculture.
-->
<head>
	<title>agriculture</title>
	<meta charset="UTF-8">
   <link rel="stylesheet" type="text/css"
   href="books_Category.css"/>
	</head>

	<body>

<?php		
		$db = mysql_connect("localhost", "yusaf", "yusaf") or die ('I cannot connect to the database  because: ' . mysql_error());  
		$mydb=mysql_select_db("yusaf");
		
		$query = "select B_title as Title, B_author as Author, B_ISBN as ISBN  from books WHERE (B_cId=$Cat_Num) And (B_cId=C_id)");


		$result = mysql_query($query);	
		
		$num_rows = mysql_num_rows($result);
		$row = mysql_fetch_array($result);
		$num_fields = mysql_num_fields($result);
		
		if (empty($num_rows))
		{
			echo "This book is not available";
		}
		else
		{	
			
			print "<table border=1 align = 'center', bgcolor= '#a5c0b8', width = '80%'> <caption> <h2> Books found on Agriculture</h2> </caption>";
			print "<tr align = 'center'>";
			
			// Produce the column labels

			$keys = array_keys($row);
			for ($index = 0; $index < $num_fields; $index++)
			print "<th class='th$index'>" . $keys[2 * $index + 1] . "</th>";

			print "</tr>";
		
			for ($row_num = 0; $row_num < $num_rows; $row_num++)
			{
				print "<tr align = 'left'>";
				$values = array_values($row);
				for ($index = 0; $index < $num_fields; $index++) 
				{
					$value = htmlspecialchars($values[2 * $index + 1]);
					print "<th class='th$index' > " . $value . "\t" . "</th> ";
				}
		
				print "</tr>";
				$row = mysql_fetch_array($result);
			}
			print "</table>"		
		}	
  ?>
  </body>
  </html>

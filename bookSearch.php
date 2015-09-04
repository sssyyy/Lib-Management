<html>

<!--
File Name: bookSearch.php
-->
<body>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css"
	href="books_Category.css"/>
</head>

<head>
<style>
	div 
	{
		background-color: #D0E6E5;
		width: 400px;
		padding: 25px;
		border: 5px solid black;
		margin: 25px;
		align: center;
	}
</style>
</head>

<body>

 <!-- Book search form -->
<h1 color :' '#3C74C2'> Search Books Details</h1> 
<div float = "center">
<table border="0" align = "center" > 
	<form action="" method="post" align = "center"> 
	<tr>
		<td>Search by Title:</td> 
		<td> <input type="text" name="title"> </td>
	</tr>
	<tr>
		<td> Search by Author:</td> 
		<td> <input type="text" name="author"></td>
	</tr>
	
	<tr>
		<td> Search by ISBN:</td> 
		<td> <input type="text" name="isbn"></td>
	</tr>
	
	<tr>
		<td> &nbsp; </td>
		<td> <input type="submit" name="submit" value="Search"> </td>
	</tr>
	</form>
	</table>
</div>

<?php

if(isset($_POST['submit']))
{
	if(empty($_POST['author']) && empty($_POST['title']) && empty($_POST['isbn']))
	{
		echo "Enter a search term";
		break;
	}
	
	
		// create  variable names
		$author = $_POST['author'];
		$title = $_POST['title'];
		$isbn = $_POST['isbn'];
		
		// Database connection
		$db = mysql_connect("localhost", "yusaf", "yusaf") or die ('I cannot connect to the database  because: ' . mysql_error());  
		$mydb=mysql_select_db("yusaf");
		
		//Book search by author
		if(!empty($author) && empty($title) && empty($isbn))
			$query = "select B_title as Title, B_author as Author,C_name as Category,  B_ISBN as ISBN from books, category  where   B_author LIKE '%$author%'";
		//Book search by title
		if(!empty($title) && empty($author) && empty($isbn))
			$query = "select B_title as Title, B_author as Author, C_name as Category,  B_ISBN as ISBN from books, category  where  B_title LIKE '%$title%'";
		//Book search by isbn
		if(!empty($isbn) && empty($author)  && empty($title))
			$query = "select B_title as Title, B_author as Author, C_name as Category,  B_ISBN as ISBN from books, category  where B_ISBN = '$isbn'";
		
		if(!empty($title) && !empty($author) && !empty($isbn))
			$query = "select B_title as Title, B_author as Author, B_ISBN as ISBN from books where B_author LIKE '%$author%' OR B_title LIKE '%$title%' OR B_ISBN = '$isbn'";
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
			print "<table border=1 width = '80%'  bgcolor= '#a5c0b8'> <caption> <h2> Book Search Results </h2> </caption>";
			print "<tr align = 'center'>";
			
			// Produce the column labels

			$keys = array_keys($row);
			for ($index = 0; $index < $num_fields; $index++)
			print "<th class = 'th$index'>" . $keys[2 * $index + 1] . "</th>";

			print "</tr>";
		
			for ($row_num = 0; $row_num < $num_rows; $row_num++)
			{
				print "<tr align = 'left'>";
				$values = array_values($row);
				for ($index = 0; $index < $num_fields; $index++) 
				{
					$value = htmlspecialchars($values[2 * $index + 1]);
					print "<th class ='th$index' > " . $value . "\t" . "</th> ";
				}
		
				print "</tr>";
				$row = mysql_fetch_array($result);
			}
			print "</table>";
		
		
		}
	
}

  ?>
  
</body>
</html>


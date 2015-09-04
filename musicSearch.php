<html>
<!--
File Name: musicSearch.php
-->
<head>
  <title>Music Search Results</title>
 <link rel="stylesheet" type="text/css"
   href="../MusicCategory/musicCategory.css"/>
</head>
<head>
<style>
div {
   background-color:#D0E6E5;
   width: 400px;
   padding: 25px;
   border: 5px solid #020204;
   margin: 25px;
 }
   th{
     text-align:Left;
   }
</style>
</head>
<body>
<h1>Search Music Details</h1>
<div align = "center">
<table border="0" align = "center"> 
     <form action="" method="post" align = "center"> 
     <tr>
<th>Search by Title:</th> 
<td> <input type="text" name="title"> </td>
</tr>
<tr>
<th> Search by Author:</th> 
<td> <input type="text" name="author"></td>
</tr>
<tr>
<th>Search by Id:</th>
    <td><input type='number' name='id'></td>
</tr>
<tr>
<td> &nbsp; </td>
<td> <input type="submit" name="submit" value="Search"> </td>
</tr>
</form>
</table>
</div>

<?php
if(isset($_POST['submit'])){
  //  if(empty($_POST['author'])||empty($_POST['title'])||empty($_POST['id'])){ }

  // create short variable names

  $author = $_POST['author'];
  $title = $_POST['title'];
  $id=$_POST['id'];


  $db = mysql_connect("localhost", "yusaf", "yusaf") or die ('I cannot connect to the database  because: ' . mysql_error());
  $mydb=mysql_select_db("yusaf");

  if(empty($title) && empty($author)&& empty($id))
    {/*
       $query = "select M_title AS Title, M_author As Author, C_name AS Category, M_id As ID
                 from music, category
                 where M_cId=C_id ";*/
      echo "Enter a search term " ; break;  
    }
  else{
    if(!empty($title) && !empty($author)&& !empty($id))
      {
       $query = "select M_title AS Title, M_author As Author, C_name AS Category, M_id As ID
                 from music, category
                 where (M_author LIKE '%$author%' OR M_title LIKE '%$title%' OR M_id LIKE '%$id%')
                 AND M_cId=C_id ";
      }
    else{
      if(!empty($title) )
	{
	  $query = "select M_title AS Title, M_author As Author, C_name AS Category, M_id As ID
                from music, category
                where (M_title LIKE '%$title%')
                AND M_cId=C_id ";}
      else if(!empty($author))
        { 
	  $query = "select M_title AS Title, M_author As Author, C_name AS Category, M_id As ID
                 from music, category
                 where (M_author LIKE '%$author%' )
                 AND M_cId=C_id "; }
      else if(!empty($id))
	{
	  $query = "select M_title AS Title, M_author As Author, C_name AS Category, M_id As ID
                 from music, category
                 where (M_id  LIKE '%$id%')
                 AND M_cId=C_id "; }

      if(!empty($title) && !empty($author))
	{
	  $query = "select M_title AS Title, M_author As Author, C_name AS Category, M_id As ID
                 from music, category
                 where (M_title LIKE '%$title%' OR  M_author LIKE '%$author%')
                 AND M_cId=C_id "; }
      else if(!empty($title) && !empty($id))
	{
	  $query = "select M_title AS Title, M_author As Author, C_name AS Category, M_id As ID
                 from music, category
                 where (M_title LIKE '%$title%' OR M_id  LIKE '%$id%')
                 AND M_cId=C_id "; }
      else if(!empty($author) && !empty($id))
	{
	  $query = "select M_title AS Title, M_author As Author, C_name AS Category, M_id As ID
                 from music, category
                 where ((M_author LIKE '%$author%' OR M_id  LIKE '%$id%')
                 AND M_cId=C_id "; }
    }}
  $result = mysql_query($query);
  $num_rows = mysql_num_rows($result);
  $row = mysql_fetch_array($result);
  $num_fields = mysql_num_fields($result);

  if (empty($num_rows))
    {
      echo "This music is not available";
    }
  else
    {

      print "<table border=1 bgcolor= '#a5c0b8'><caption> <h2> Music List  Results </h2> </caption>";
      print "<tr align = 'center'>";

      // Produce the column labels
      $keys = array_keys($row);
      for ($index = 0; $index < $num_fields; $index++)
	print "<th class='th$index'>" . $keys[2 * $index + 1] . "</th>";

      print "</tr>";

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

}
  ?>
</body>
</html>
 

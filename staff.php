<!DOCTYPE html>
<!--
File Name: staff.php
-->
<html lang="en">
	<head>
		<title>Staff</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css"
			href="staff.css"/>
	</head>
	<body>	<div class='title'>
		<h1> Library Staff </h1>
		</div> 

<?php
$db = mysql_connect("localhost", "yusaf", "yusaf");
$er = mysql_select_db(‘yusaf’);

$result = mysql_query("SELECT S_name AS 'Name', S_designation AS 'Job Title', S_empNumber FROM staff ORDER BY S_name");

$num_rows = mysql_num_rows($result);
$row = mysql_fetch_array($result);
$num_fields = mysql_num_fields($result);
$empId; 
// Output the values of the fields in the rows
for ($row_num = 0; $row_num < $num_rows; $row_num++) {
   
  if ($row_num %2==0){	print "<div class='notify0'>";} ///odd rows
  else{	print "<div class='notify1'>";} //even rows
    print "<span class='notification'>";
    //print "<div class='title'><h1> picture to R: </h1></div>";
    print"<div class='lefttb'><div class='tablespan'><table class='emp'>";

	$values = array_values($row);
	 for ($index = 0; $index < $num_fields; $index++) {
	   print "<tr>";
	   //print"<th>next line</th> <td>example</td>";
	    $value = htmlspecialchars($values[2 * $index + 1]);
	    if($index==0)
	      {
		print "<th class='name'>Name:</th> <td class='namevalue'>" . $value . "</td>\t";}
	    else if($index==1){
	      print "<th class='job'>Job Title:</th> <td class='jobvalue'>" . $value . "</td>\t" ;}
	    else if($index==2)
	      {
		$empId=$value;
	      }
	    print "</tr>";
	 }
	 //print "<span class='rightpic'><p> picture to R: </p></>";

    print "</table></div> </div>"; 
     print "<div id='pic' class='rightpic'><img class='staffpic' src='pictures/staff".$empId.".jpg'alt='staff'> </div>";
    print "</span>";
    print "</div>";
    $row = mysql_fetch_array($result);
}
?>
	</body>
</html>

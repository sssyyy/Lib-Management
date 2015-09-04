 <html>
<!--
file Name: sign_up.php
purpose: registration form
-->
 <head>
 <center>
 <title>Sign-Up</title>
 <!-- <legend>Registration Form</legend> -->
 <style>
	div 
	{
		background-color: #D0E6E5;
		width: 500px;
		padding: 25px;
		border: 5px solid black;
		margin: 25px;
		text-align : left
	}
 </style>
 </head> 
 
 <body> 
 <div> 
 
 <table border="0" align = 'center'> 
	<!-- br: line break : nbsp - one space: -->
	
	<form action="" method="post">	
	<tr>
		<td colspan="2" align = 'center'> Registration Form </td>
	</tr>
	
	<tr>
		<td> First Name:</td>
		<td> <input type="text" name="fname" /> </td>
	</tr>
	
	<tr>
		<td> Last Name: </td>
		<td> <input type="text" name="lname" /> </td>
	</tr>
	
	<tr>
		<td>  Email: </td> 
		<td> <input type="text" name="email" /> </td>
	</tr>
	
	<tr>
		<td> UserName: </td>
		<td> <input type="text" name="user" /> </td>
	</tr>
	
	<tr>
		<td> Password: </td>
		<td> <input type="password" name="pass" /> </td> 
	</tr>
	
	<tr>
	   <td> Retype Password: </td> 
	   <td> <input type="password" name="rpass" /> </td>
	</tr>
	
	<tr>
		<td>&nbsp;</td>
		<td> <input type="submit" name="submit" value="Sign-Up" /> </td>
	</tr>
	</form> 
 </table> 
 
 </div>  
 </center>
 <?php
 
 if(isset($_POST['submit']))
 {
	if(empty($_POST['fname']) || empty($_POST['lname'])||empty($_POST['email'])||empty($_POST['user'])||empty($_POST['pass']))
	{
		echo "Enter a search term";
	}
	else
	{  
		$FirstName = $_POST['fname'];
		$LastName = $_POST['lname'];
		$email = $_POST['email'];
		$UserName = $_POST['user'];
		$Password = $_POST['pass'];
		$Rpassword = $_POST['rpass'];
		if ($Password <> $Rpassword)
			print "Password mismatch";
		else
		{
			  //Database connection 
			
			$db = mysql_connect("localhost", "yusaf", "yusaf") or die ('I cannot connect to the database  because: ' . mysql_error());  
			$mydb=mysql_select_db("yusaf");	
			
			
			$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';
			if(preg_match($regex, $email))
			{
				//$Password=md5($Password); // encrypted password
				$activation=md5($email.time()); // encrypted email+timestamp
				$count=mysql_query("SELECT Mr_email FROM members WHERE Mr_email='$email'");
				$numResults = mysql_num_rows($count);
				
				//print $numRow[0];
			
				if($numResults < 1)				
				
				{  					
					$query = "INSERT INTO members (Mr_fname,Mr_lname,Mr_userName,Mr_pwd, Mr_email) VALUES ('$FirstName','$LastName','$UserName', '$Password','$email'  )";
					$result = mysql_query($query);
						
					if (!$result)
					{
						die ('I cannot connect to the database : ' . mysql_error());
					}
					else 
					{
						echo "<span style ='font:16px/21px Arial,tahoma,sans-serif;color:#3C74C2'> YOU ARE SUCCESSFULLY REGISTERED !!! </span>";
						echo "<br><span style ='font:16px/21px Arial,tahoma,sans-serif;color:#3C74C2'> If you want to go back to the login page </span>";
						echo ('<a href =http://cs643.cs.csusm.edu/yusaf001/loginpage_session.html> click here</a>');
					}
				}
				else
				{
					$numRow = mysql_fetch_array ($count)or die(mysql_error());
					print "Email " .$numRow[0]. "  already exist!!";
				}
				
			}
			
			else
			{
				echo "<span style ='font:16px/21px Arial,tahoma,sans-serif;color:#ff0000'> The email you have entered is invalid, please try again!!! </span>"; 
			}
		}
	}
 }
 
 ?>  
 
 </body> 
 </html>

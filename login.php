<html>
<!--
file Name: loginpage_session.html
purpose: create a login form
-->
 <head>
 <center>
 <?php
 session_start();
 ?>
 <title>LoginPage</title>
 
 <style>
	div 
	{
		background-color: #D0E6E5;
		width: 400px;
		padding: 25px;
		border: 5px solid black;
		margin: 25px;
		align: center;
		text-align : left
	}
</style>

 </head> 
 
 <body id="body-color"> 
 
 <div id = “memLogin”>  
 <table border="0" align = "center" > 
 
	<form method="POST" name =login> 
	<tr>
		<td colspan="2" align = 'center'>Login Form</td>
	</tr>
	
	<tr>	
		<td> UserName:</td> 
		<td> <input type="text" name="user" /> </td>
	</tr>
	
	<tr>
		<td> Password: </td>
		<td> <input type="password" name="pass"  /> </td>
	</tr>
	
	<tr>
		<td> &nbsp; </td>
		<td> <input type="submit" onClick = “return member_login()” name="login" value="Login" /></td>
	</tr>
	</table> 
	<tr>
		If you are not a member,  <a href = "http://cs643.cs.csusm.edu/yusaf/sign_up.php"> Sign Up </a> here.
	</tr>
	
	</form> 

<script language = “javascript” type = “text/javascript”>
function member_login()
{

document.getElmentById(“memLogin”).src = “login_session.php”


}
</script>

</div>
 </center>
 </body>
 </html>
 

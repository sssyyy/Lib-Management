<!--
file Name: login_session.php
purpose: Shows list of borrowed books and music with fine due.
-->

<?php 
$db = mysql_connect("localhost", "yusaf", "yusaf") or die ('I cannot connect to the database  because: ' . mysql_error());  
$mydb=mysql_select_db("yusaf");

session_start();
{
    $user=mysql_real_escape_string($_POST['user']);
    $password=mysql_real_escape_string($_POST['pass']);
    $fetch=mysql_query("SELECT Mr_id FROM members where Mr_userName='$user' and Mr_pwd='$password'");
    $count=mysql_num_rows($fetch);
    if($count!="")
    {
    #session_register("sessionuser");
    $_SESSION['login_username']=$user;
    header("Location:welcome_session.php"); 
    }
    else
    {
	header('Location:loginpage_session.html');
	header("<span style ='font:16px/21px Arial,tahoma,sans-serif;color:#ff0000;float:center'>  SORRY, YOU ENTERD WRONG ID OR PASSWORD!!PLEASE RETRY!!!</span>");
		
		echo "<span style ='font:16px/21px Arial,tahoma,sans-serif;color:#ff0000;float:center'>  SORRY, YOU ENTERD WRONG ID OR PASSWORD!!PLEASE RETRY!!!</span>";     
	   
    }

}
?>




 

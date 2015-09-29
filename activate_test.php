<?php
session_start();
ob_start();
include("connect_test.php");

if(isset($_GET['email']) && preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_GET['email'])){
	$email=mysql_real_escape_string($_GET['email']);
}

if(isset($_GET['key']) && (strlen($_GET['key'])==32)){
	
	$key=mysql_real_escape_string($_GET['key']);
	
}

if(isset($email) && isset($key)){
	
	$result=mysql_query("SELECT * FROM tempusers WHERE (email='$email' AND activation='$key')LIMIT 1") or die(mysql_error());
	   
	while($row=mysql_fetch_array($result)){
		if(!empty($row['user_name'])){
			$a=$row['user_name'];
		$user_id=mysql_real_escape_string($row['user_id']);
		$username=mysql_real_escape_string($row['user_name']);
		$email=mysql_real_escape_string($row['email']);
		$password=mysql_real_escape_string($row['password']);
		}
	}

	
	
	if(!empty($a)){
	$result1=mysql_query("INSERT INTO users(user_id,user_name,user_pass,user_email,user_date,user_level,user_points,user_status,education,employment,first_name,last_name,user_image) VALUES('','$username','$password','$email',Now(),0,0,'','','','','','profilephoto/default.jpg')") or die(mysql_error());
	
	$result2=mysql_query("DELETE FROM tempusers WHERE user_id='$user_id'");
	
	if(!$result1){
		echo "Oops your account could not activated";
	}
	else{
		header('Location:prompt_test.php?x=0');
	}
	}
	
	else{
		echo 'your account is already activated you may now <a href="signin_test.php">Login</a>';
	}
}
else{
	echo "error";
	
}


?>

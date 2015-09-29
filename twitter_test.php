<?php  
session_start();
include("connect_test.php");
include("codes_test.php");
 $name=$_GET['n'];
  $id=$_GET['id'];

$s=mysql_query("SELECT * FROM users WHERE user_id='".$id."'");
 $res=mysql_num_rows($s);

 if($res==0){
	 $sql=mysql_query("INSERT INTO users(user_id,user_name,user_image) VALUES('".$id."','".$name."','profilephoto/default.PNG')");
	
 }
 
 $_SESSION['signed_in'] = true;
		  $_SESSION['user_id']=$id;
			$_SESSION['user_name']  = $name;
	header('Location:forum_main.php');
 



?>

<?php
require 'connect_test.php';
function checkuser($fuid,$ffname,$femail){
    	$check = mysql_query("select * from users where user_id='$fuid'");
	$check = mysql_num_rows($check);
	if (empty($check)) { // if new user . Insert a new record		
	$query = "INSERT INTO users (user_id,user_name,user_email) VALUES ('$fuid','$ffname','$femail')";
	mysql_query($query);	
	} else {   // If Returned user . update the user record		
	$query = "UPDATE users SET user_name='$ffname', user_email='$femail' where user_id='$fuid'";
	mysql_query($query);
	}
}?>

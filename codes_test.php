<?php
session_start();
include("connect_test.php");
//Code for Header and Search Bar
function headerAndSearchCode(){
	$defaultText='Search';
	$defaultText = htmlentities($_GET['keywords']);
	echo '
		<header id="main_header">
			<div id="rightAlign">
	';
	topRightLinks();
	echo "
			</div>
			<h1> CHANDAN A V  </h1>
			</header>";
	
}

//Top Right Links
function topRightLinks(){
	if( !isset($_SESSION['user_id']) ){
		echo '<a href="register_test.php">Register</a> &nbsp <a href="signin_test.php">Log In</a>';
	}else{
		$x = $_SESSION['user_id'];
		
		echo "<span class=\"usernames\"><a href=\"messages_inbox.php\">Messages(5)</a></span> |";
		
		echo '<a href="additem.php">Add Item</a> | <a href="account.php">My Account</a> | <a href="signout.php">Log Out</a>';
	}
}


?>

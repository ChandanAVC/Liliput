<?php
session_start();
ob_start();
include 'connect_test.php';

unset ($_SESSION['signed_in']);
				 mysql_query("UPDATE users SET login='0' WHERE user_id='".$_SESSION['user_id']."'")or die("error");

session_destroy();
echo "you successfully logged out";
header ('Location:index.php' );

?>

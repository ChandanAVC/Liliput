<?php
  ob_start();

	include 'connect_test.php';
	include("codes_test.php");
	$pageID=mysql_real_escape_string($_GET['id']);
	$k=mysql_real_escape_string($_GET['k']);
	
	$user_ip = mysql_real_escape_string($_SESSION['user_id']);

	// check if the user has already clicked on the unlike (rate = 2) or the like (rate = 1)
		$dislike_sql = mysql_query('SELECT COUNT(*) FROM blog_like WHERE bloglike_by = "'.$user_ip.'" and bloglike_id = "'.$pageID.'" and rate = 2 ');
		$dislike_count = mysql_result($dislike_sql, 0); 

		$like_sql = mysql_query('SELECT COUNT(*) FROM blog_like WHERE bloglike_by = "'.$user_ip.'" and bloglike_id = "'.$pageID.'" and rate = 1 ');
		$like_count = mysql_result($like_sql, 0); 

	if($k==1): //if the user click on "like"
		if(($like_count == 0) && ($dislike_count == 0)){
			mysql_query('INSERT INTO blog_like (bloglike_id,bloglike_by, rate )VALUES("'.$pageID.'", "'.$user_ip.'", "1")');
			header('Location:blog.php');
		}
		if($dislike_count == 1){
			mysql_query('UPDATE blog_like SET rate = 1 WHERE bloglike_id = '.$pageID.' and bloglike_by ="'.$user_ip.'"');
						header('Location:blog.php');

		}
			if($like_count == 1)
											header('Location:blog.php');

	endif;
	if($k==0): //if the user click on "like"
		if(($like_count == 0) && ($dislike_count == 0)){
			mysql_query('INSERT INTO  blog_like(bloglike_id, bloglike_by, rate )VALUES("'.$pageID.'", "'.$user_ip.'", "2")');
						header('Location:blog.php');

		}
		if($like_count == 1){
			mysql_query('UPDATE blog_like SET rate = 2 WHERE bloglike_id = '.$pageID.' and bloglike_by="'.$user_ip.'"');
						header('Location:blog.php');

		}
					if($dislike_count == 1)

								header('Location:blog.php');

	endif;
?>

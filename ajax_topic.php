<?php
ob_start();
	include 'connect_test.php';
	include("codes_test.php");
	$pageID=mysql_real_escape_string($_GET['id']);
	$k=mysql_real_escape_string($_GET['k']);
	$cat=mysql_real_escape_string($_GET['p']);
	$user_ip = mysql_real_escape_string($_SESSION['user_id']);

	// check if the user has already clicked on the unlike (rate = 2) or the like (rate = 1)
	
		$dislike_sql = mysql_query('SELECT COUNT(*) FROM post_like WHERE postlike_by = "'.$user_ip.'" and postlike_id = "'.$pageID.'" and rate = 2 ');
		$dislike_count = mysql_result($dislike_sql,0); 
				
		$like_sql = mysql_query('SELECT COUNT(*) FROM post_like WHERE postlike_by = "'.$user_ip.'" and postlike_id = "'.$pageID.'" and rate = 1 ');
		$like_count = mysql_result($like_sql, 0); 

	if($k==1){//if the user click on "like"
		if(($like_count == 0) && ($dislike_count == 0)){
			mysql_query('INSERT INTO post_like (postlike_id,postlike_by, rate )VALUES("'.$pageID.'", "'.$user_ip.'", "1")');
			header('Location:topic.php?id='.$cat.'');
		}
		if($dislike_count == 1){
			mysql_query('UPDATE post_like SET rate = 1 WHERE postlike_id = '.$pageID.' and postlike_by ="'.$user_ip.'"');
						header('Location:topic.php?id='.$cat.'');

		}
		if($like_count == 1)
		header('Location:topic.php?id='.$cat.'');

	}
	if($k==0){ //if the user click on "like"
		if(($like_count == 0) && ($dislike_count == 0)){
			mysql_query('INSERT INTO  post_like(postlike_id, postlike_by, rate )VALUES("'.$pageID.'", "'.$user_ip.'", "2")');
						header('Location:topic.php?id='.$cat.'');

		}
		if($like_count == 1){
			mysql_query('UPDATE post_like SET rate = 2 WHERE postlike_id = '.$pageID.' and postlike_by="'.$user_ip.'"');
						header('Location:topic.php?id='.$cat.'');

		}
		if($dislike_count == 1)
		header('Location:topic.php?id='.$cat.'');
		
	}
?>

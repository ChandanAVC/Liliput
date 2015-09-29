<?php
 ob_start();
	include 'connect_test.php';
	include("codes_test.php");
	$pageID=mysql_real_escape_string($_GET['id']);
	$k=mysql_real_escape_string($_GET['k']);
	$by=mysql_real_escape_string($_GET['by']);
	$user_ip =mysql_real_escape_string($_SESSION['user_id']);

	// check if the user has already clicked on the unlike (rate = 2) or the like (rate = 1)
		$dislike_sql = mysql_query('SELECT COUNT(*) FROM topic_like WHERE topic_by = "'.$user_ip.'" and topic_id = "'.$pageID.'" and rate = 2 ');
		$dislike_count = mysql_result($dislike_sql, 0); 

		$like_sql = mysql_query('SELECT COUNT(*) FROM topic_like WHERE topic_by = "'.$user_ip.'" and topic_id = "'.$pageID.'" and rate = 1 ');
		$like_count = mysql_result($like_sql, 0); 

	if($k==1): //if the user click on "like"
		if(($like_count == 0) && ($dislike_count == 0)){
			mysql_query('INSERT INTO topic_like (topic_id,topic_by, rate )VALUES("'.$pageID.'", "'.$user_ip.'", "1")');
			$res=mysql_query("SELECT * FROM users WHERE user_id='".$by."'") or die();
		    $points=mysql_fetch_array($res);
			$p=$points['user_points'];
			$p=$p+1;
			$s="UPDATE users SET user_points='".$p."' WHERE user_id='".$by."'";
			$res=mysql_query($s) or die();
			header('Location:forum_main.php');
		}
		if($dislike_count == 1){
			mysql_query('UPDATE topic_like SET rate = 1 WHERE topic_id = '.$pageID.' and topic_by ="'.$user_ip.'"');
						$res=mysql_query("SELECT * FROM users WHERE user_id='".$by."'") or die();
		    $points=mysql_fetch_array($res);
			$p=$points['user_points'];
			$p=$p+1;
			$s="UPDATE users SET user_points='".$p."' WHERE user_id='".$by."'";
			$res=mysql_query($s) or die();
						header('Location:forum_main.php');

		}
		if($like_count == 1)
									header('Location:forum_main.php');

	endif;
	if($k==0): //if the user click on "like"
		if(($like_count == 0) && ($dislike_count == 0)){
			mysql_query('INSERT INTO  topic_like(topic_id, topic_by, rate )VALUES("'.$pageID.'", "'.$user_ip.'", "2")');
			$res=mysql_query("SELECT * FROM users WHERE user_id='".$by."'") or die();
		    $points=mysql_fetch_array($res);
			$p=$points['user_points'];
			$p=$p-1;
			$s="UPDATE users SET user_points='".$p."' WHERE user_id='".$by."'";
			$res=mysql_query($s) or die();
						header('Location:forum_main.php');

		}
		if($like_count == 1){
			mysql_query('UPDATE topic_like SET rate = 2 WHERE topic_id = '.$pageID.' and topic_by="'.$user_ip.'"');
			$res=mysql_query("SELECT * FROM users WHERE user_id='".$by."'") or die();
		    $points=mysql_fetch_array($res);
			$p=$points['user_points'];
			$p=$p-1;
			$s="UPDATE users SET user_points='".$p."' WHERE user_id='".$by."'";
			$res=mysql_query($s) or die();
						header('Location:forum_main.php');

		}
						if($dislike_count == 1)
															header('Location:forum_main.php');

	endif;
?>

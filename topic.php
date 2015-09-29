<?php
ob_start();
     date_default_timezone_set("Asia/Kolkata"); 
    $time=date('d-m-Y H:i:s'); //Returns IST 
	
	include 'connect_test.php';
include  'codes_test.php';
include 'topic_header.php';
function percent($num_amount, $num_total) {
		if($num_total==0){$num_total=1;}
        $count1 = $num_amount / $num_total;
        $count2 = $count1 * 100;
        $count = number_format($count2, 0);
        return $count;
    }
	$user_ip = $_SESSION['user_id'];
?>

<?php
//create_cat.php
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
	
}
else
{
	//check for sign in status
	if(!$_SESSION['signed_in'])
	{
		echo 'You must be signed in to post a reply.';
	}
	else
	{     
		$b=$_GET['id'];
		if(empty($_POST['reply_content'])){header("Location:prompt_test.php?x=4"."&id=$b");}
	else{
	
   
		//a real user posted a real reply
		$sql = "INSERT INTO 
					posts(post_content,
						  post_date,
						  post_topic,
						  post_by) 
				VALUES ('" . $_POST['reply_content'] . "',
						 '".$time."',
						" . mysql_real_escape_string($_GET['id']) . ",
						" . $_SESSION['user_id'] . ")";
						
		$result = mysql_query($sql);
						
		if(!$result)
		{
			echo 'Your reply has not been saved, please try again later.';
		}
		else
		{
			$a=mysql_real_escape_string($_GET['id']);
			header("Location:topic.php?id=$a");
		}
	}
	}

}


?>

<?php

$sql = "SELECT
			topic_id,
			topic_subject
		FROM
			topics
		WHERE
			topics.topic_id = '" . mysql_real_escape_string($_GET['id']) ."'";
			
$result = mysql_query($sql);

if(!$result)
{
	echo 'The topic could not be displayed, please try again later.';
}
else
{
	if(mysql_num_rows($result) == 0)
	{
		echo 'This topic doesn\'t exist.';
	}
	else
	{
		
		while($row = mysql_fetch_assoc($result))
		{	$topic=$row['topic_id'];
			//display post data
			echo '<h2 class="text-left" style="text-indent:10px;"> * ' . $row['topic_subject'] . '</h2>';
		      echo  '<div class="col-sm-9">';
			//fetch the posts from the database
			$posts_sql = "SELECT
						posts.post_id,
						posts.post_topic,
						posts.post_content,
						posts.post_date,
						posts.post_by,
						users.user_id,
						users.user_name,
						users.user_image
					
					FROM
						posts
					LEFT JOIN
						users
					ON
						posts.post_by = users.user_id
					WHERE
						posts.post_topic = '" . mysql_real_escape_string($_GET['id']) . "' ORDER BY posts.post_id ASC";
						
			$posts_result = mysql_query( $posts_sql);
			
			if(!$posts_result)
			{
				echo 'The posts could not be displayed, please try again later.';
			}
			else
			{  
			
				while($posts_row = mysql_fetch_assoc($posts_result))
				{ 
				
			$pageID =$posts_row['post_id']; // The ID of the page, the article or the video ...

    //function to calculate the percent
   

    // check if the user has already clicked on the unlike (rate = 2) or the like (rate = 1)
                         $dislike_sql = mysql_query('SELECT COUNT(*) FROM  post_like WHERE postlike_by = "'.$user_ip.'" and postlike_id = "'.$pageID.'" and rate = 2 ');
                         $dislike_count = mysql_result($dislike_sql, 0); 

                         $like_sql = mysql_query('SELECT COUNT(*) FROM  post_like WHERE postlike_by = "'.$user_ip.'" and postlike_id = "'.$pageID.'" and rate = 1 ');
                         $like_count = mysql_result($like_sql, 0);  

        // count all the rate 
                           $rate_all_count = mysql_query('SELECT COUNT(*) FROM  post_like WHERE postlike_id= "'.$pageID.'"');
                             $rate_all_count = mysql_result($rate_all_count, 0);  

        $rate_like_count = mysql_query('SELECT COUNT(*) FROM  post_like WHERE postlike_id = "'.$pageID.'" and rate = 1');
        $rate_like_count = mysql_result($rate_like_count, 0);  
        $rate_like_percent = percent($rate_like_count, $rate_all_count);

        $rate_dislike_count = mysql_query('SELECT COUNT(*) FROM post_like WHERE postlike_id = "'.$pageID.'" and rate = 2');
        $rate_dislike_count = mysql_result($rate_dislike_count, 0);  
        $rate_dislike_percent = percent($rate_dislike_count, $rate_all_count);
					 
				
							$l='like-h'.$posts_row['post_id'];
									     $d='dislike-h'.$posts_row['post_id'];
					 
					echo ' 
                    <div class="row" style="">
                        <div class="col-xs-12" style="margin:-10px; text-indent:10px;">';
						//echo '<img src="'.$posts_row['user_image'].'" class="img-circle" width="40" height="40">';
						echo	'<h3 style="font-family: \'Bree Serif\', serif;"><img src="'.$posts_row['user_image'].'" class="img-circle" width="40" height="40"> <a href="user_profile.php?id='.$posts_row['user_id'] .' "> ' . $posts_row['user_name'] . '</a></h3>';
						
						echo '<p style="text-indent:50px;color:#cccccc;font-family: \'Pacifico\', cursive;">' 
							 . $posts_row['post_content'] . '</p>
						  
						  
						  <div class="text-right" style="font-size:10px;">
                              <span style="color:#d3d3d3;font-size:12px;">'.date('d-m-Y H:i', strtotime($posts_row['post_date'])).'
                               </span>
                            </div>';?>
							
							<?php if($_SESSION['signed_in'])	{?>
							<a href="ajax_topic.php?id=<?php echo $posts_row['post_id']?> &k=1 &p=<?php echo $topic?>"><div  style="background-color:#cccccc;"       class="like-btn <?php if($like_count == 1){ echo 'like-h';} ?>">Like</div></a>
            <a href="ajax_topic.php?id=<?php echo $posts_row['post_id']?>  &k=0 &p=<?php echo $topic?>"><div style="background-color:#cccccc;" class="dislike-btn <?php if($dislike_count == 1){ echo 'dislike-h';} ?>"></div></a>

						<?php }?>
            <div class="stat-cnt">
                <div class="rate-count"><?php echo $rate_all_count; ?></div>
                <div class="stat-bar">
                    <div class="bg-green" style="width:<?php echo $rate_like_percent; ?>%;"></div>
                    <div class="bg-red" style="width:<?php echo $rate_dislike_percent; ?>%"></div>
                </div><!-- stat-bar -->
                <div class="dislike-count"><?php echo $rate_dislike_count; ?></div>
                <div class="like-count"><?php echo $rate_like_count; ?></div>
							</div>
							
				         </div>
    				</div>
						
					<hr/>
							
							
				     
					<?php
						  
				}
			
			}
			
			
			if(!$_SESSION['signed_in'])
			{
				echo 'You must be <span style="font-size:16px;color:#99FFCC;">Logged in</span> to reply. You can also <span style="font-size:16px;color:#99ffcc;">sign up</span> for an account.';
			}
			
			else
			{   echo '<div class="well">
                        <h4><i class="fa fa-reply-all"></i>  Reply..</h4>';
						
				echo '<!-- the comment box -->
                    
                        <form role="form" method="post"  action="topic.php?id='.$row['topic_id'].'">
                            <div class="form-group cool">
                                <textarea name="reply_content" id="compose-textarea" class="form-control" width="200px;" style="color:black;"></textarea>
                            </div>
                            <input  type="submit" name="submit" class="btn btn-primary">
                        </form>
                 ';
				
				
				echo '</div>';
			}
			
			//finish the table
			echo '</div>';
		}
	}
}

include 'topic_footer.php';
?>

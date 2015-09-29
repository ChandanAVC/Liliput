<?php

include 'connect_test.php';
include 'createtopic_header.php';
 


if($_SESSION['signed_in'] == false)
{
	//the user is not signed in
	echo "<p style=\"color:white;\">sorry you have to  sign in to create a topic</p>";
}
else
{
	//the user is signed in
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{	
		//the form hasn't been posted yet, display it
		//retrieve the categories from the database for use in the dropdown
		$sql = "SELECT
					cat_id,
					cat_name,
					cat_description
				FROM
					categories";
		
		$result = mysql_query($sql);
		
		if(!$result)
		{
			//the query failed
			echo "Error while selecting from database. Please try again later.";
		}
		else
		{
			if(mysql_num_rows($result) == 0)
			{
				//there are no categories, so a topic can't be posted
				if($_SESSION['user_level'] == 1)
				{
					echo 'You have not created categories yet.';
				}
				else
				{
					echo 'Before you can post a topic, you must wait for an admin to create some categories.';
				}
			}
			else
			{
			echo	 '<div class="form-bottom">
			                  <form role="form" action="" method="post" class="login-form">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-subject">Subject</label>
			                        	<input type="text" name="topic_subject" placeholder="Topic / Query" class="form-username form-control" id="form-username">
			                        </div>';
			                       
				
					
				echo '<div class="form-group">Choose Category:
			               <label class="sr-only" for="form-subject">Subject</label>
			                
			                 ';	
				
				echo '<select name="topic_cat" >';
					while($row = mysql_fetch_array($result))
					{
						echo "<option value=\"" . $row['cat_id'] . "\">" . $row['cat_name'] . "</option>";
					}
				echo '</select> </div>';	
					
			 echo '<div class="form-group">
			 <p>Description about your topic / query :</p>
			           <label class="sr-only" for="form-textarea">Textarea</label>
			               <textarea name="post_content" id="compose-textarea"> </textarea>         
			         </div>
			         <button type="submit" class="btn">Create Topic</button>
			        </form>
					</div>';		
					
			
			}
		}
	}
	else
	{
		//start the transaction
		$query  = "BEGIN WORK;";
		$result = mysql_query($query);
		
		if(!$result)
		{
			//Damn! the query failed, quit
			echo 'An error occured while creating your topic. Please try again later.';
		}
		else
		{
		
	            $s=mysql_real_escape_string($_POST['topic_subject']);
			   $text=strip_tags($s);

				   $e="incorrect post";
				   			   if($text==$s){
			   $t=explode("%",$text);
			   $c=implode(" ",$t);
			
			//the form has been posted, so save it
			//insert the topic into the topics table first, then we'll save the post into the posts table
			$sql = "INSERT INTO 
                        topics(topic_subject,
                               topic_date,
                               topic_cat,
                               topic_by)
                   VALUES('" .$c. "',
                               'NOW()',
                               '" . mysql_real_escape_string($_POST['topic_cat']) . "',
                               '" . mysql_real_escape_string($_SESSION['user_id']) . "'
                               )";
					 
			$result = mysql_query($sql);
			   
			if(!$result)
			{
				//something went wrong, display the error
				echo "An error occured while inserting your data. Please try again later." ;
				$sql = "ROLLBACK;";
				$result = mysql_query($sql);
			}
			else
			{
				//the first query worked, now start the second, posts query
				//retrieve the id of the freshly created topic for usage in the posts query
				$topicid = mysql_insert_id();
				        $s=mysql_real_escape_string($_POST['post_content']);
			   $text=strip_tags($s);

				   $e="incorrect post";
				   			   if($text==$s){
			   $t=explode("%",$text);
			   $c=implode(" ",$t);
				$sql = "INSERT INTO
							posts(post_content,
								  post_date,
								  post_topic,
								  post_by)
						 VALUES('" . $c. "',
								  NOW(),
								  '" . $topicid . "',
								  '" . $_SESSION['user_id'] . "')";
				$result = mysql_query($sql);
				
				if(!$result)
				{
					//something went wrong, display the error
					echo "An error occured while inserting your post. Please try again later." . mysql_error();
					$sql = "ROLLBACK;";
					$result = mysql_query($sql);
				}
				else
				{
					$res=mysql_query("SELECT * FROM users WHERE user_id='".$_SESSION['user_id']."'") or die();
		    $points=mysql_fetch_array($res);
			$p=$points['user_points'];
			$p=$p+1;
			$s="UPDATE users SET user_points='".$p."' WHERE user_id='".$_SESSION['user_id']."'";
			$res=mysql_query($s) or die();
					$sql = "COMMIT;";
					$result = mysql_query($sql);
						
					//after a lot of work, the query succeeded!
					echo "<span style=\"font-family: 'Kaushan Script', cursive; color:white;\" >You have successfully created your new topic</span>";
				
				}
							   }
							   else{
								   echo 'incorrect post';
							   }
				
			}	}
			else{
				echo $e;
			}
		}
	}
}

include 'createtopic_footer.php';
?>

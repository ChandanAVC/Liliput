
<?php
//create_cat.php
ob_start();
include 'connect_test.php';
include 'codes_test.php';


if($_SERVER['REQUEST_METHOD'] != 'POST')
{
	//someone is calling the file directly, which we don't want
	echo 'This file cannot be called directly.';
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
		$b=mysql_real_escape_string($_GET['id']);
		if(empty($_POST['reply_content'])){header("Location:prompt_test.php?x=4"."&id=$b");}
	else{
		
		//a real user posted a real reply
		$sql = "INSERT INTO 
					posts(post_content,
						  post_date,
						  post_topic,
						  post_by) 
				VALUES ('" . $_POST['reply_content'] . "',
						NOW(),
						" . mysql_real_escape_string($_GET['id']) . ",
						" . $_SESSION['user_id'] . ")";
						
		$result = mysql_query($sql);
						
		if(!$result)
		{
			echo 'Your reply has not been saved, please try again later.';
		}
		else
		{
			header("Location:topic.php?id=$b");
		}
	}
	}

}


?>

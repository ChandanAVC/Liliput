<?php
ob_start();


include("connect_test.php");
include("codes_test.php");
$id=mysql_real_escape_string($_GET['id']);

if($_SESSION['signed_in']){
	
	if(isset($_POST['submit'])){

     $content=mysql_real_escape_string($_POST['content']);
     
	            $s=mysql_real_escape_string($content);
				
			   $text=strip_tags($s);
	if($text==$s){
			   $t=explode("%",$text);
			   $content=implode(" ",$t);
			
     //checking if message is empty
    if(!empty($content)){
		$sql="INSERT INTO messages(m_from,m_to,m_content,m_sender) VALUES(".mysql_real_escape_string($_SESSION['user_id']).",".$id.",'".$content."','".$_SESSION['user_name']."')";
		$result=mysql_query($sql);
		
		if(!$result){echo 'error with database please try again later';}
		else{ header('Location:prompt_test.php?x=5');}
		
	}	 
	
	else{
		header('Location:prompt_test.php?x=6');
	}
	}
	else{
		echo $e="incorrect post";
	}
	 	
	}
}
else{
	echo 'must sign in';
	
}



?>

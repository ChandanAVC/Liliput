<?php
include("connect_test.php");
if(isset($_POST['submit'])){
	  $error[]=array();
	$url=mysql_real_escape_string($_POST['url']);
	  $text=strip_tags($url);
 
    if($text==$url)
		{   
	   $t=explode("%",$text);
			   $url=implode(" ",$t);
	 $result=mysql_query("INSERT INTO video(video_url) VALUES('".$url."') ");
	if($result){
		echo "";
	}
	else{
		echo "Sorry video  not uploaded";
	}
	
			}
			else{
				echo 'error';
			}
}
$result=mysql_query("SELECT * FROM video ORDER BY video_id DESC ") or die(mysql_error());

	
	echo '
	          <div class="container-fluid work" id="work">
	<div class="container">
		<div class="row" id="starts">
			<div class="col-md-12 col-sm-12 col-xs-12 work-list">
				<h2 class="text-center portfolio-text" style="font-family: \'Kaushan Script\', cursive;color:#cccccc;">Share your fav video here!<br>Cherish Memories</h2>';
				
			while($row=mysql_fetch_array($result)){	
			echo '	<div class="col-md-3 col-sm-6 col-xs-12 work-space">
					<iframe width="250" height="250"
                               src="'.$row['video_url'].'">
                          </iframe>
			</div>';}
				
       echo '    </div>                         
		   </div>
		 </div>  
	   </div>
	';
	

                    
?>

<?php 
ob_start();
include("connect_test.php");
include("codes_test.php");
function percent($num_amount, $num_total) {
		if($num_total==0){$num_total=1;}
        $count1 = $num_amount / $num_total;
        $count2 = $count1 * 100;
        $count = number_format($count2, 0);
        return $count;
    }
	$user_ip = mysql_real_escape_string($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>LILIPUT-Contact</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<meta name="author" content="" />
<!-- css -->
<link href="index/css/bootstrap.min.css" rel="stylesheet" />
<link href="index/css/fancybox/jquery.fancybox.css" rel="stylesheet">
<link href="index/css/jcarousel.css" rel="stylesheet" />
<link href="index/css/flexslider.css" rel="stylesheet" />
<link href="index/css/style.css" rel="stylesheet" />

	 <link type="text/css" rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<!-- Theme skin -->
<link href="index/skins/default.css" rel="stylesheet" />

</head>
<body>
<div id="wrapper">
	<!-- start header -->
	<header>

      <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><span>LILI</span>PUT</a>
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>  
						                 

						<li class="dropdown">
                            <a href="#" class="dropdown-toggle " data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false">Gallery<b class=" icon-angle-down"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="general_gallery.php">image gallery</a></li>
                                <li><a href="video.php">video gallery</a></li>
                            </ul>
                        </li>
                        <li><a href="forum_main.php">Forum</a></li>
						
                        <li class="active"><a href="blog.php">Blog</a></li>
                        <li><a href="contact.php" >Contact</a></li>
						<li><?php if(!$_SESSION['signed_in']){

                     echo ' <a class href="register.php">Sign Up</i>
										</a>';}?>
                            </li>   
						<li>
				    <?php if($_SESSION['signed_in']){
						$sql="SELECT * FROM users WHERE user_id='".$_SESSION['user_id']."'";
						$result=mysql_query($sql)or die();
						$row=mysql_fetch_array($result);
						
						echo '<li class="dropdown">
                      <a class="dropdown-toggle" data-close-others="false" data-delay="0" data-hover=
                      "dropdown" data-toggle="dropdown" href="#"><img src="'.$row['user_image'].'" width="40" height="40" class="img-circle"> '.$row['user_name'].' <i class="fa fa-angle-down"></i>
                      </a>
                      <ul class="dropdown-menu">
                          <li>
                              <a href="myaccount.php">My profile</a>
                          </li>
                          <li>
							<a href="signout.php">Log out</a>
                          </li>
						</ul>
                  </li>';
						
					
					
					}
					else{
					echo '<a href="signin_test.php">Login </a>';}
                      
					  ?>
                  </li>
                    </ul>
                </div>
            </div>
        </div>
				
                  

        
    </header>
	
	<!-- end header -->
	<section id="inner-headline">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="#"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
					<li class="active">Blog</li>
				</ul>
			</div>
		</div>
	</div>
	</section>
	<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">



			
			
<?php

$sql="SELECT blog.b_id,blog.b_short,blog.b_from,blog.b_img,blog.b_content,blog.b_date,blog.b_subject,users.user_id,users.user_name,users.user_image FROM blog 
            LEFT JOIN users ON blog.b_from=users.user_id ORDER BY b_id DESC";
$result=mysql_query($sql);
if(!$result){
	echo 'error';
	
}	

else{
	while($row=mysql_fetch_array($result)){
		$pageID =$row['b_id']; // The ID of the page, the article or the video ...

    //function to calculate the percent
   

    // check if the user has already clicked on the unlike (rate = 2) or the like (rate = 1)
                         $dislike_sql = mysql_query('SELECT COUNT(*) FROM  blog_like WHERE bloglike_by = "'.$user_ip.'" and bloglike_id = "'.$pageID.'" and rate = 2 ');
                         $dislike_count = mysql_result($dislike_sql, 0); 

                         $like_sql = mysql_query('SELECT COUNT(*) FROM  blog_like WHERE bloglike_by = "'.$user_ip.'" and bloglike_id = "'.$pageID.'" and rate = 1 ');
                         $like_count = mysql_result($like_sql, 0);  

        // count all the rate 
                           $rate_all_count = mysql_query('SELECT COUNT(*) FROM  blog_like WHERE bloglike_id= "'.$pageID.'"');
                             $rate_all_count = mysql_result($rate_all_count, 0);  

        $rate_like_count = mysql_query('SELECT COUNT(*) FROM  blog_like WHERE bloglike_id = "'.$pageID.'" and rate = 1');
        $rate_like_count = mysql_result($rate_like_count, 0);  
        $rate_like_percent = percent($rate_like_count, $rate_all_count);

        $rate_dislike_count = mysql_query('SELECT COUNT(*) FROM blog_like WHERE bloglike_id = "'.$pageID.'" and rate = 2');
        $rate_dislike_count = mysql_result($rate_dislike_count, 0);  
        $rate_dislike_percent = percent($rate_dislike_count, $rate_all_count);
		$l='like-h'.$row['b_id'];
	    $d='dislike-h'.$row['b_id'];
		
		echo '<article>
						<div class="post-image">
							<div class="post-heading">
							               <img src="'.$row['user_image'].'" width="60" height="60" class="img-circle">
 <span class="month">
                    <span style="font-size:20px;"> <a href="user_profile.php?id='.$row['user_id'] .' "> ' . $row['user_name'] . '</a></span>
                  </span>
								<h3> <a href="#">
                   '.$row['b_subject'].'</h3>
							</div>
<span class="blog">
							<img src="'.$row['b_img'].'"  width="450" />
						
						</span></div>
						<p>
						'.$row['b_content'].'
						</p>
						
				';
	
	


			?>
					<?php if($_SESSION['signed_in']){?>
					<a href="ajax_blog.php?id=<?php echo $row['b_id']?> &k=1"><div class="like-btn <?php if($like_count == 1){ echo 'like-h';} ?>">Like</div></a>
            <a href="ajax_blog.php?id=<?php echo $row['b_id']?>  &k=0 "><div class="dislike-btn <?php if($dislike_count == 1){ echo 'dislike-h';} ?>"></div></a>

					<?php }?>
            <div class="stat-cnt">
                <div class="rate-count"><?php echo $rate_all_count; ?></div>
                <div class="stat-bar">
                    <div class="bg-green" style="width:<?php echo $rate_like_percent; ?>%;"></div>
                    <div class="bg-red" style="width:<?php echo $rate_dislike_percent; ?>%"></div>
                </div><!-- stat-bar -->
                <div class="dislike-count"><?php echo $rate_dislike_count; ?></div>
                <div class="like-count"><?php echo $rate_like_count; ?></div>
                <?php echo '      
                
				  </div>
				  </article>';
					
		
		
		
		
	}
	
}		
			
			

?>
</div>
            
       <div class="col-lg-4">
				<aside class="right-sidebar">
				
				<div class="widget">
					<h5 class="widgetheading">Categories</h5>
					<ul class="cat">
                 <?php
			  
$sql = "SELECT
			categories.cat_id,
			categories.cat_name,
			categories.cat_description,
			categories.faicon,
			COUNT(topics.topic_id) AS topics
		FROM
			categories
		LEFT JOIN
			topics
		ON
			topics.topic_id = categories.cat_id
		GROUP BY
			categories.cat_name, categories.cat_description, categories.cat_id ORDER BY categories.cat_id ASC";        


$result = mysql_query($sql);

if(!$result)
{
	echo 'The categories could not be displayed, please try again later.';
}
else
{
	if(mysql_num_rows($result) == 0)
	{
		echo 'No categories defined yet.';
	}
	else
	{
		        
		
		  
		  while($row = mysql_fetch_array($result))
		
		{				
				
					
		
					echo "<br><li><a href='category.php?id=$row[cat_id]'><span class=\"menu-title\">" . $row["cat_name"] . "</span></a></li>";
			
		}	
		  
		
	}
}
?>	
               </ul>
				</div>
				
				
				</aside>
			</div>
		</div>
	</div>
	</section>
	<footer>
	
	<div id="sub-footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="copyright">
						<p><a target="_blank">LILIPUT</a><br>
							
						</p>
					</div>
				</div>
				<div class="col-lg-6">
					<ul class="social-network">
						<li><a href="#" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#" data-placement="top" title="Google plus"><i class="fa fa-google-plus"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	</footer>
</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
<!-- javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="index/js/jquery.js"></script>
<script src="index/js/jquery.easing.1.3.js"></script>
<script src="index/js/bootstrap.min.js"></script>
<script src="index/js/jquery.fancybox.pack.js"></script>
<script src="index/js/jquery.fancybox-media.js"></script>
<script src="index/js/google-code-prettify/prettify.js"></script>
<script src="index/js/portfolio/jquery.quicksand.js"></script>
<script src="index/js/portfolio/setting.js"></script>
<script src="index/js/jquery.flexslider.js"></script>
<script src="index/js/animate.js"></script>
<script src="index/js/custom.js"></script>
</body>
</html>

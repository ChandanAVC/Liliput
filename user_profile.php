
<?php

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
    <title>User profile</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="account/images/icons/favicon.ico">
    <link rel="apple-touch-icon" href="account/images/icons/favicon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="account/images/icons/favicon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="account/images/icons/favicon-114x114.png">
    <!--Loading bootstrap css-->
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <link type="text/css" rel="stylesheet" href="account/styles/jquery-ui-1.10.4.custom.min.css">
    <link type="text/css" rel="stylesheet" href="account/styles/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="account/styles/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="account/styles/animate.css">
    <link type="text/css" rel="stylesheet" href="account/styles/all.css">
    <link type="text/css" rel="stylesheet" href="account/styles/main.css">
    <link type="text/css" rel="stylesheet" href="account/styles/style-responsive.css">
    <link type="text/css" rel="stylesheet" href="account/styles/zabuto_calendar.min.css">
    <link type="text/css" rel="stylesheet" href="account/styles/pace.css">
    <link type="text/css" rel="stylesheet" href="account/styles/jquery.news-ticker.css">
	
		  	 <link type="text/css" rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
				<link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
		
</head>
<body>
    <div>
        <!--BEGIN THEME SETTING-->
        
        <!--END THEME SETTING-->
        <!--BEGIN BACK TO TOP-->
        <a id="totop" href="#"><i class="fa fa-angle-up"></i></a>
        <!--END BACK TO TOP-->
        <!--BEGIN TOPBAR-->
        <div id="header-topbar-option-demo" class="page-header-topbar">
            <nav id="topbar" role="navigation" style="margin-bottom: 0;" data-step="3" class="navbar navbar-default navbar-static-top">
            <div class="navbar-header">
                <button type="button" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                <a id="logo" href="forum_main.php" class="navbar-brand"><span class="fa fa-rocket"></span><span class="logo-text">F<span style="color:#48cfad;">orum</span></span><span style="display: none" class="logo-text-icon">µ</span></a></div>
            <div class="topbar-main"><a id="menu-toggle" href="#" class="hidden-xs"><i class="fa fa-bars"></i></a>
                
              
                
                <ul class="nav navbar navbar-top-links navbar-right mbn">
				<li><a href="blog.php"><i class="fa fa-btc"></i>log</a></li>
				
			
                            <li><a href="people.php"><i class="fa fa-user"></i> people</a></li>
                                    <li><a href="create_topic.php"><i class="fa fa-file-text"></i> Add topic</a></li>
										  <li><a href="forum_main.php">Forum</a></li>	

											<li class="dropdown topbar-user"><a data-hover="dropdown" href="#" class="dropdown-toggle">&nbsp;<span class="hidden-xs"><i class="fa fa-film"></i> Gallery</span>&nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="general_gallery.php"><i class="fa fa-picture-o"></i>Image Gallery</a></li>
                            <li><a href="video.php"><i class="fa fa-video-camera"></i>Video Gallery</a></li>
                        </ul>
				   </li>
                    
                   <?php 
				     if($_SESSION['signed_in']){
						 
						 $sql="SELECT * FROM users WHERE user_id='".mysql_real_escape_string($_SESSION['user_id'])."'";
						 $result=mysql_query($sql)or die();
						 $row=mysql_fetch_array($result);
						 
					 
				   echo
                             '<li class="dropdown topbar-user"><a data-hover="dropdown" href="#" class="dropdown-toggle"><img src="'.$row['user_image'].'" alt="" class="img-responsive img-circle"/>&nbsp;<span class="hidden-xs">'.$row['user_name'].'</span>&nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-user pull-right">
                            <li><a href="myaccount.php"><i class="fa fa-user"></i> My Profile</a></li>
                            <li><a href="signout.php"><i class="fa fa-power-off"></i> Log Out</a></li>
                        </ul>
				   </li>';
					 } ?> 
                    </li>
                </ul>
            </div>
        </nav>
           
			
            <!--END MODAL CONFIG PORTLET-->
        </div>
        <!--END TOPBAR-->
        <div id="wrapper">
            <!--BEGIN SIDEBAR MENU-->
            <nav id="sidebar" role="navigation" data-step="2" data-intro="Template has &lt;b&gt;many navigation styles&lt;/b&gt;"
                data-position="right" class="navbar-default navbar-static-side">
            <div class="sidebar-collapse menu-scroll">
                <ul id="side-menu" class="nav">
                    
                      <div class="clearfix"></div>
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
		    		                  
		$i=0;
		$k=0;
		$l=0;              
		
		  
		  while($row = mysql_fetch_array($result))
		
		{
		   
					echo "<li><a href='category.php?id=$row[cat_id]'><i class=\"$row[faicon]\"><div class=\"icon-bg bg-red\"></div> </i><span class=\"menu-title\" style=\"font-family: 'Poiret One', cursive; font-size:16px;font-weight:700;color:white;\">" . $row["cat_name"] . "</span></a></li>";
			
		}	
		  
		
	}
}
?>	
                </ul>
            </div>
        </nav>
		
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">
                            Profile</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="index.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Profile..</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Profile..</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <!--END TITLE & BREADCRUMB PAGE-->
                <!--BEGIN CONTENT-->
                <div class="page-content" style="padding:20px 20px 50px 20px;">
                    <div id="tab-general">
                        <div class="row mbl">
                            <div class="col-lg-12">

                                            <div class="col-md-12">
                                                <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                                                </div>
                                            </div>
                                
                            </div>

                            <div class="col-lg-12">
                              
                                    
                              <div class="row">
							  <?php if($_SESSION['signed_in']){
	 $a=mysql_real_escape_string($_GET['id']);
	 $sql="SELECT * FROM users WHERE user_id='".$a."'";
	$result=mysql_query($sql);
	  if(!$result){
		echo 'sorry,error connecting to database';
	  }
	   else{ 
	          $row=mysql_fetch_array($result);
			  echo '
			  <div class="col-md-12"><h2>'.$row['user_name'].'</h2>
						 <div class="row mtl">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="text-center mbl"><img src="'.$row['user_image'].'" alt="" class="img-responsive"/></div>
                                    
                                </div>
								 <table class="table table-striped table-hover">
                                    <tbody>
                                    <tr>
                                        <td>User Name</td>
                                        <td>'.$row['user_name'].'</td>
                                    </tr>
											<td>Full name</td>
											<td>'.$row['first_name'].'  '.$row['last_name'].'</td>
                                    <tr>
                                        <td>Education </td>
                                        <td>'.$row['education'].'</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td><span class="label label-success">'.$row['user_status'].'</span></td>
                                    </tr>
                                    <tr>
                                        <td>User points</td>';
										
											$points=$row['user_points'];
										if($points >= 500){$rank="LEVEL 5";}
										else if($points >= 400 && $points < 500){$rank="LEVEL 4";}
										else if($points >=300 && $points < 400){$rank="LEVEL 3";}
										else if($points >= 200 && $points < 300){$rank="LEVEL 2";}
									     else{$rank="LEVEL 1";}
										
										
										echo'
                                        <td><span class="label label-default">'.$rank.'</span></td>
                                    </tr>
                                    
                                    </tbody>
                                </table>
	   </div>';}
	   
	   
echo '
	<div class="col-md-9">
                                <ul class="nav nav-tabs">
                                   <li class="active"><a href="#tab-edit" data-toggle="tab">Compose</a></li>
                                      <li><a href="#tab-inbox" data-toggle="tab">Posts</a></li>
									
									   </ul>
									   <div id="generalTabContent" class="tab-content">
                                    <div id="tab-edit" class="tab-pane fade in active">';
							if($a!=$_SESSION['user_id']){

                                      echo  '<form  class="form-horizontal"  action="sending_message.php?id='.mysql_real_escape_string($a).'" method = "post">
									  <h3>Place to talk with me</h3><br><br><br>
									  <div class="form-group"><label class="col-sm-3 control-label"></label>

                                                <div class="col-sm-9 controls">
                                                    <div class="row">
                                                        <div class="col-xs-9"><textarea name="content" rows="5"  class="form-control" placeholder="Leave your message..." style="color:black;"></textarea></div>
                                                    </div>
                                                </div>
                                            </div>
                                        <hr/>
                                            <button type="submit" class="btn btn-grey " name="submit">Send message</button>
							  </form>';}
							  else{
								  echo '<a href="myaccount.php">My account</a>';
							  }
							  
							  }
							  
							  
							  else{
								  echo '<h3>You must me signed in to send a message to other person. <h3>';
							  }
										?>
										</div>
									                   <div id="tab-inbox" class="tab-pane fade in">
													    <div class="list-group" >
														
                                      <?php 
									  
									  $sql="SELECT * FROM blog WHERE b_from='".$a."'";
									  $result=mysql_query($sql);
									  if(!$result){echo 'error';}
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
										  
										  echo '<li><img src="'.$row['b_img'].'" class="img-responsive" ><br><br>';
										  
										  echo '<div > <h3 style="color:green;font-weight:700; ">'.$row['b_subject'].'</h3><br>';
										  echo '<p style="color:black;font-size:14px;">'.$row['b_content'].'<p><br><br></div>';?>
										  <a href="profile_blog.php?id=<?php echo $row['b_id']?> &k=1 &c=<?php echo $a?>"><div class="like-btn <?php if($like_count == 1){ echo 'like-h';} ?>">Like</div></a>
            <a href="profile_blog.php?id=<?php echo $row['b_id']?>  &k=0 &c=<?php echo $a?>"><div class="dislike-btn <?php if($dislike_count == 1){ echo 'dislike-h';} ?>"></div></a>


            <div class="stat-cnt">
                <div class="rate-count"><?php echo $rate_all_count; ?></div>
                <div class="stat-bar">
                    <div class="bg-green" style="width:<?php echo $rate_like_percent; ?>%;"></div>
                    <div class="bg-red" style="width:<?php echo $rate_dislike_percent; ?>%"></div>
                </div><!-- stat-bar -->
                <div class="dislike-count"><?php echo $rate_dislike_count; ?></div>
                <div class="like-count"><?php echo $rate_like_count; ?></div></div>
				<?php echo '<hr>';
								echo '<br><br><br><br></li>';	  
									  }
									  }

									  ?>
                                  									 
										</div>
										   </div>
                    </div>
                </div>
                              
                                </div>
                                
                            
                     
                            
                        </div>
                    </div>
                </div>
                <!--END CONTENT-->
                <!--BEGIN FOOTER-->
                <div id="footer">
                    <div class="copyright">
                        <a href="#">Forum Guru 2015</a></div>
                </div>
                <!--END FOOTER-->
            </div>
            <!--END PAGE WRAPPER-->
        </div>
    </div>
    <script src="account/script/jquery-1.10.2.min.js"></script>
    <script src="account/script/jquery-migrate-1.2.1.min.js"></script>
    <script src="account/script/jquery-ui.js"></script>
    <script src="account/script/bootstrap.min.js"></script>
    <script src="account/script/bootstrap-hover-dropdown.js"></script>
    <script src="account/script/html5shiv.js"></script>
    <script src="account/script/respond.min.js"></script>
    <script src="account/script/jquery.metisMenu.js"></script>
    <script src="account/script/jquery.slimscroll.js"></script>
    <script src="account/script/jquery.cookie.js"></script>
    <script src="account/script/icheck.min.js"></script>
    <script src="account/script/custom.min.js"></script>
    <script src="account/script/jquery.news-ticker.js"></script>
    <script src="account/script/jquery.menu.js"></script>
    <script src="account/script/pace.min.js"></script>
    <script src="account/script/holder.js"></script>
    <script src="account/script/responsive-tabs.js"></script>
    <script src="account/script/jquery.flot.js"></script>
    <script src="account/script/jquery.flot.categories.js"></script>
    <script src="account/script/jquery.flot.pie.js"></script>
    <script src="account/script/jquery.flot.tooltip.js"></script>
    <script src="account/script/jquery.flot.resize.js"></script>
    <script src="account/script/jquery.flot.fillbetween.js"></script>
    <script src="account/script/jquery.flot.stack.js"></script>
    <script src="account/script/jquery.flot.spline.js"></script>
    <script src="account/script/zabuto_calendar.min.js"></script>

    <script src="account/script/index.js"></script>
    <!--LOADING SCRIPTS FOR CHARTS-->
    <script src="account/script/highcharts.js"></script>
    <script src="account/script/data.js"></script>
    <script src="account/script/drilldown.js"></script>
    <script src="account/script/exporting.js"></script>
    <script src="account/script/highcharts-more.js"></script>
    <script src="account/script/charts-highchart-pie.js"></script>
    <script src="account/script/charts-highchart-more.js"></script>
    <!--CORE JAVASCRIPT-->
    <script src="account/script/main.js"></script>
    <script>        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-145464-12', 'auto');
        ga('send', 'pageview');


</script>
</body>
</html>
										

									   
								
							  

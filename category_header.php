<?php include'connect_test.php';
 include 'codes_test.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> Category</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="forum/images/icons/favicon.ico">
    <link rel="apple-touch-icon" href="forum/images/icons/favicon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="forum/images/icons/favicon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="forum/images/icons/favicon-114x114.png">
    <!--Loading bootstrap css-->
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <link type="text/css" rel="stylesheet" href="forum/styles/jquery-ui-1.10.4.custom.min.css">
    <link type="text/css" rel="stylesheet" href="forum/styles/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="forum/styles/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="forum/styles/animate.css">
    <link type="text/css" rel="stylesheet" href="forum/styles/all.css">
    <link type="text/css" rel="stylesheet" href="forum/styles/main.css">
    <link type="text/css" rel="stylesheet" href="forum/styles/style-responsive.css">
    <link type="text/css" rel="stylesheet" href="forum/styles/zabuto_calendar.min.css">
    <link type="text/css" rel="stylesheet" href="forum/styles/pace.css">
    <link type="text/css" rel="stylesheet" href="forum/styles/jquery.news-ticker.css">
     <link type="text/css" rel="stylesheet" href="forum/styles/jplist-custom.css">
	      <link type="text/css" rel="stylesheet" href="forum/cool.css">
		  	 <link type="text/css" rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
				<link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>


</head>
<body>
    <div>
       
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
				      if(!$_SESSION['signed_in']){
						  echo '<li><a href="signin_test.php"><i class="fa fa-file-text"></i> Log in</a></li>';

					  }
				   if($_SESSION['signed_in'])    
				   {
					   $r=mysql_query("SELECT * FROM users WHERE user_id='".$_SESSION['user_id']."'") or die();
					   $row=mysql_fetch_array($r);
                   echo ' <li class="dropdown topbar-user"><a data-hover="dropdown" href="#" class="dropdown-toggle"><img src="'.$row['user_image'].'" alt="" class="img-responsive img-circle"/>&nbsp;<span class="hidden-xs">'.$row['user_name'].'</span>&nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-user pull-right">
                           <li><a href="myaccount.php"><i class="fa fa-user"></i>My Profile</a></li>
                            <li><a href="signout.php"><i class="fa fa-power-off"></i>Log Out</a></li>
                        </ul>
				   </li>'; }
				   else{
					 				   
				   }?>
                </ul>
            </div>
        </nav>
           
        </div>
		
		
		<div id="wrapper">
            <!--BEGIN SIDEBAR MENU-->
            <nav id="sidebar" role="navigation" data-step="2" data-intro="Template has &lt;b&gt;many navigation styles&lt;/b&gt;"
                data-position="right" class="navbar-default navbar-static-side">
            <div class="sidebar-collapse menu-scroll">
                <ul id="side-menu" class="nav">
                    
                     <div class="clearfix"></div>
	
          

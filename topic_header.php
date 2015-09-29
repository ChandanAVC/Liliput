<?php include'connect_test.php';?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>posts</title>

		  	 <link type="text/css" rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>	
    <link rel="stylesheet" type="text/css" href="topic/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="topic/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="topic/css/local.css" />

    <script type="text/javascript" src="topic/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="topic/bootstrap/js/bootstrap.min.js"></script>  
		  		
	<style type="text/css">
	 .cool li{
		 display:inline;
	 }
	</style>
</head>
<body>

    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="forum_main.php" style="font-size:30px;"> F<span style="color:#48cfad;">orum</span> </a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li><a href="forum_main.php"><i class="fa fa-weixin"></i> My Forum feed</a></li>
                    <li><a href="general_gallery.php"><i class="fa fa-picture-o"></i> Photo Gallery</a></li>
                    <li><a href="video.php"><i class="fa fa-film"></i> Video Gallery</a></li>
                    
					
                    <li style="color:white;"><a href="#" ><i class="fa fa-search"></i> Find us on  <i class="fa fa-arrow-down"></i></a> </li>
                    <li><a href="forms.html"><i class="fa fa-facebook-square"></i> Facebook </a></li>
                    <li><a href="typography.html"><i class="fa fa-google-plus-square"></i> Google plus</a></li>
                    <li><a href="bootstrap-elements.html"><i class="fa fa-twitter-square"></i> twitter</a></li>
					<li><a href="bootstrap-elements.html"><i class="fa fa-instagram"></i> Instagram</a></li>   
                     <li><a href="bootstrap-elements.html"><i class="fa fa-envelope"></i> Mail us</a></li>          
                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">
                   
					<?php	if($_SESSION['signed_in']){
							$a=mysql_real_escape_string($_SESSION['user_id']);
						 $b=mysql_query("SELECT * FROM users WHERE user_id= '".$a ."'");
						  if($row=mysql_fetch_array($b)){
					      
					
						 
						  
						  
                        echo '<li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="'.$row['user_image'].'" class="img-circle" width="30" height="30">
						  
						  <b class="caret"></b></a>
                           <ul class="dropdown-menu">
                            <li><a href="#"><i class="fa fa-user"></i>  '.$row['user_name'].'</a></li>
                            <li><a href="myaccount.php"><i class="fa fa-gear"></i> My account</a></li>
                            <li class="divider"></li>
						
						  <li><a href="signout.php"><i class="fa fa-power-off"></i> Log Out</a></li>';}}
					    else{echo ' <li><a href="signin_test.php"><i class="fa fa-power-off"></i> Log in</a></li>';}
                        ?></ul>
                    </li>
                </ul>
            </div>
        </nav>
		
		
		<div class="container" style="foat:right;position:relative;">
            <div class="row">

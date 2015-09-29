<?php

include("connect_test.php");
include("codes_test.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>LILIPUT -Image Gallery</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<meta name="author" content="" />
<!-- css -->
<link href="index/css/bootstrap.min.css" rel="stylesheet" />
<link href="index/css/fancybox/jquery.fancybox.css" rel="stylesheet">
<link href="index/css/jcarousel.css" rel="stylesheet" />
<link href="index/css/flexslider.css" rel="stylesheet" />
<link href="index/css/style.css" rel="stylesheet" />


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
                        <li ><a href="index.php">Home</a></li>  
						                 

						<li class="dropdown active">
                            <a href="#" class="dropdown-toggle " data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false">Gallery<b class=" icon-angle-down"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="general_gallery.php">image gallery</a></li>
                                <li><a href="video.php">video gallery</a></li>
                            </ul>
                        </li>
                        <li><a href="forum_main.php">Forum</a></li>
						
                        <li><a href="blog.php">Blog</a></li>
                        <li><a href="contact.php">Contact</a></li>
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
					<li class="active">Image Gallery</li>
				</ul>
			</div>
		</div>
	</div>
	</section>
	<section id="content">
	
			
			<ul>
				<li> <?php if($_SESSION['signed_in']){
echo  '<div class="container">
    <!-- data-toggle lets you display modal without any JavaScript -->
	<br>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#popUpWindow">Upload Image</button>

    <div class="modal fade" id="popUpWindow">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Upload image to gallery</h3>
                </div>

                <!-- body (form) -->
                <div class="modal-body">
                    <form role="form" action="general_gallery.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="file" name="file" class="form-control" placeholder="choose the image">
                        </div>
                     
						
						  <!-- button -->
                <div class="modal-footer">
                    <input type="submit"  name="submit">

            </div>
                    </form>
                </div>

              
        </div>
    </div>

</div>';
}
else{
	echo 'you must be signed in to upload the image';
	
}
?>    </li>
            </ul>
            </section>
			<div class="container">
		<div class="row">
			<div class="col-lg-12">
        
           <?php include("general_gallery_upload.php"); ?>
               
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
						<p>
						<a target="_blank">LILIPUT</a><br>
							<span>Developed By-CHANDAN A V </span>
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

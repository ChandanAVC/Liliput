<?php  
ob_start();
include("connect_test.php");
include("codes_test.php");
if(isset($_POST['submit'])){
	
	$error = array();
	$error_message='';
 
	 //message
	 
	 if(empty($_POST['cool'])){                              
		$error_m = 'Please enter your message. ';
	
	}else{
		$message = $_POST['cool'];
	
	}
	
    //name
	if(empty($_POST['name'])){                              
		$error[]= 'Please enter your Name. ';
	}else{
		$name=$_POST['name'] ;
	}
	
	 //email
	    if(empty($_POST['email'])){
        $error[] = 'Please enter your email. ';
    }else if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['email'])){
		$email = mysql_real_escape_string($_POST['email']);
    }else{
		$error[] = 'Your e-mail address is invalid. ';
    }
	
	 if(empty($error) && empty($error_m)){
				//sending email
				
			$email_l='forumguru2015@gmail.com';
				mail($email_l,$email,$message);
				header('Location:prompt_test.php?x=8' );
				
			}
				else{	$error_message='<span class="error">';
		foreach($error as $key=> $values){
			$error_message.="$values";
		}
				$error_message.='</span><br /><br/>';}
}


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
						
                        <li><a href="blog.php">Blog</a></li>
                        <li class="active"><a href="contact.php" >Contact</a></li>
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
					<li class="active">Contact</li>
				</ul>
			</div>
		</div>
	</div>
	</section>
	<section id="content">
	
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h4>Get in touch with us by filling <strong>contact form below</strong></h4>
				
          <div class="contact-form">
            <form role="form" action="" method="post">
			<?php if(!empty($error_message)){echo $error_message;}
			if(!empty($error_m)){echo $error_m;}?>
              <div class="form-group">
                <label for="name">
                  Name
                </label>
                <input type="text" placeholder="" name="name" id="name" class="form-control" style="color:black;" >
              </div>
              <div class="form-group">
                <label for="email">
                  Email
                </label>
                <input type="text" placeholder="" id="email" name="email" class="form-control" style="color:black;">
              </div>

              <div class="form-group">
                <label for="message">
                  Message
                </label>
                <textarea placeholder=""  rows="5" name="cool" class="form-control" style="color:black;">
                </textarea>
              </div>
              <button class="btn btn-info" type="submit" name="submit">
                Submit
              </button>
            </form>

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
<script src="index/js/validate.js"></script>
</body>
</html>

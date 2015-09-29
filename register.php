
<?php

ob_start();
include("connect_test.php");
include("codes_test.php");

if($_SESSION['signed_in']){
	header('Location:forum_main.php');
}


if(isset($_POST['submit'])){
	$error = array();
	$error_message='';
	
	//username check
	if(empty($_POST['username'])){                              
		$error[] = 'Please enter a username. ';
	}else if( ctype_alnum($_POST['username']) ){
		$username = $_POST['username'];
	}else{
		$error[] = 'Username must consist of letters and numbers only. ';
	}
	
	 //email check
    if(empty($_POST['email'])){
        $error[] = 'Please enter your email. ';
    }else if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['email'])){
		$email = mysql_real_escape_string($_POST['email']);
    }else{
		$error[] = 'Your e-mail address is invalid. ';
    }
	
	//password check
	if(empty($_POST['password']) || empty($_POST['cpassword'])){
		$error[] = 'Please enter a password. ';
	}else{
		if($_POST['password']==$_POST['cpassword'])
		$password = md5(mysql_real_escape_string($_POST['password']));
	     else
			 $error[]='password does not match';
	}
	
	
if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0){  
		$error[] = "<p>The captcha code does not match!</p>";// Captcha verification is incorrect.	
	}
	//error
	
	
	if(empty($error)){
		$result=mysql_query("SELECT * FROM users WHERE user_email='$email' OR user_name='$username'") OR die('error in registering');

		if(mysql_num_rows($result)==0){
			
			$activation=md5(uniqid(rand(),true ));
			$result2=mysql_query("INSERT INTO tempusers(user_id,user_name,email,password,activation) VALUES('','$username','$email','$password','$activation')") OR die("activation error");
			
		
			if(!result2){
				die('Could not insert into database'.mysql_error());
				
			}
			
			else{
				//sending email to the new user
				$message="To activate your account please click on this link\n\n";
				$message.="http://forumguru.in".'/activate_test.php?email='.urlencode($email)."&key=$activation";
				mail($email,"Registration confirmation",$message);
$message="Thank you for registering !! a confirmation email has been sent to your mail please click on the activation link to activate your account";

				
			}
		}
		else{
			$error_message='<span class="error">';
			$error_message.="Username or email already exist try other";
			$error_message.='</span><br /><br/>';
		   }
		
		
	}
	else{
		$error_message='<span class="error">';
		foreach($error as $key=> $values){
			$error_message.="$values";
		}
		$error_message.='</span><br /><br/>';
	}
	
	
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Sign Up Form </title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="register/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="register/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="register/css/form-elements.css">
        <link rel="stylesheet" href="register/css/style.css">
<script src='https://www.google.com/recaptcha/api.js'></script>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="register/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="register/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="register/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="register/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="register/ico/apple-touch-icon-57-precomposed.png">
		
		<link href='http://fonts.googleapis.com/css?family=Raleway:400,300,200,100,500,600,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Sigmar+One' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Architects+Daughter' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
	<script type='text/javascript'>
function refreshCaptcha(){
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>
		

    </head>
	
    <body >
	
		<!-- Top menu -->
		<nav class="navbar navbar-inverse navbar-no-bg" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="register.php">Sign Up Form </a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="top-navbar-1">
					<ul class="nav navbar-nav navbar-right">
						<li>
							<span class="li-text">
								Meet us here at
							 
							<span class="li-social">
								<a href="#"><i class="fa fa-facebook"></i></a> 
								<a href="#"><i class="fa fa-twitter"></i></a> 
								<a href="#"><i class="fa fa-envelope"></i></a> 
								<a href="#"><i class="fa fa-skype"></i></a>
							</span>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		
    <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong style="font-family: 'Chewy', cursive;">Sign Up</strong></h1>
                            <div class="description">
                            	<p>
	                            	
	                            	
                            	</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-sm-6 book">
                    		<img src="" alt="">
                    	</div>
                        <div class="col-sm-5 form-box" >
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Get your Account now !!</h3>
                            		<p>Fill in the form below to get instant access:</p>
								  
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-pencil"></i>
                        		</div>
                            </div>
                            <div class="form-bottom" > 
			                    <form role="form" method="post" class="registration-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" >
								
									  <?php 
									  if(!empty($message)){
										  echo '<span style="color:white;">'.$message.'</span>';
									  }
									  if(!empty($error_message))
									  
									  
									  
									  {echo 
									  
									  
								'<h5 style="color:#cccccc">'.$error_message .'</h5>';} ?>
								
			                    	<div class="form-group">
			                    		<label class="sr-only" for="Username">Username</label>
			                        	<input type="text" name="username"style="color:black;" placeholder="Username..." maxlength="20" class="form-first-name form-control" id="form-username" maxlength="20">
										
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="email">Email</label>
			                        	<input type="text" name="email" style="color:black;" placeholder="email..." class="form-last-name form-control" id="form-email" maxlength="80">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="password">Password</label>
			                        	<input type="password" style="padding:25px;" style="color:black;" name="password" placeholder="password..." maxlength="20" class="form-password form-control" id="form-email" maxlength="20">
											
			                        </div>
									<div class="form-group">
			                        	<label class="sr-only" for="password">Confirm Password</label>
			                        	<input type="password" style="padding:25px;" style="color:black;" name="cpassword" placeholder="confirm password..." maxlength="20" class="form-password form-control" id="form-email" maxlength="20">
											
			                        </div>
                                  <div class="form-group">
			                        	<label class="sr-only" for="email"></label>
			                     		
    <?php if(isset($msg)){?>
    <tr>
      <td colspan="2" align="center" valign="top"><?php echo $msg;?></td>
    </tr>
    <?php } ?>
	<tr style="color:#838181;">
      <td style="align:center;"><img src="captcha.php?rand=<?php echo rand();?>" id='captchaimg' /><br>
        <!--<label for='message'>Enter the code above here :</label>-->
        <br>
        <input style=" color:black;font-family: 'Architects Daughter', cursive;border-color:white;font-size:1.2em" id="captcha_code" name="captcha_code" type="text" placeholder="Enter captcha">
        <br>
        <span style="color:white;font-family: 'Architects Daughter', cursive;letter-spacing:1.2px;">Can't read the image? click <a href='javascript: refreshCaptcha();'><i class="fa fa-refresh fa-spin fa-2x"></i></a> to refresh.</span></td>
    </tr><span><?php echo "<p>".$captchamsg."</p>"; ?></span>
			</table></br></br>
								   </div>
			                        <button type="submit" name="submit" class="btn">Sign Up</button>
									
									
									<br>
									<br>
									
									<a href="signin_test.php" style="color:white;">Log In!</a>
			                    </form>
								
		                    </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="register/js/jquery-1.11.1.min.js"></script>
        <script src="register/bootstrap/js/bootstrap.min.js"></script>
        <script src="register/js/jquery.backstretch.min.js"></script>
        <script src="register/js/retina-1.1.0.min.js"></script>
        <script src="register/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

	
	
</body>
</html>

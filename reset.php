<?php 
session_start();
ob_start();

include("connect_test.php");

if(isset($_GET['email']) && preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_GET['email'])){
	$email=mysql_real_escape_string($_GET['email']);
}
else{
	$error="invalid email id";}

if(isset($_GET['key']) && (strlen($_GET['key'])==32)){
	
	$key=mysql_real_escape_string($_GET['key']);
}

	
			$sql="SELECT * FROM users WHERE (user_email='".$email."' AND activation='".$key."')";
			$result=mysql_query($sql);
			if(mysql_num_rows($result)==0){
				exit("Email id not registered  or invalid key or your key is expired");
				
			}

if(isset($_POST['submit'])){
	if(empty($error)){
		$password=md5(mysql_real_escape_string($_POST['password']));
		$cpassword=md5(mysql_real_escape_string($_POST['cpassword']));
		if($password==$cpassword){
			$s="UPDATE users SET user_pass='".$password."' WHERE user_email='".$email."'";
			$r=mysql_query($s);
			if($r){
				$m ='password has been changed successfully you may now<a href="signin_test.php">Login..</a> ';
				$key='123456';
				$k="UPDATE users SET activation='".$key."'";
				mysql_query($k) or die();
			}
			else{
				$m='password was not changed successfully please try afterwards';
			}
			
			
			
		}
		else{
			$m="password mismatch";
		}
		
	}
}
	?>
	
	
	
	
	<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Reset Password|ForumGuru</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="signin/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="signin/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="signin/css/form-elements.css">
        <link rel="stylesheet" href="signin/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="signin/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="signin/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="signin/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="signin/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="signin/ico/apple-touch-icon-57-precomposed.png">
		

    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1 style="font-family: 'Lobster', cursive;"><strong>Reset Password</strong></h1>
                            <div class="description">
                            	<p>
	                           
                            	</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Enter your new password</h3>
                            		<p></p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form"  method="post" class="login-form" action="">
								<?php if(!empty($error)){ echo $error;} 
								      if(!empty($m)){ echo $m;}
								?>
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">New Password</label>
			                        	<input type="password" name="password" placeholder="Password.." class=" form-control" id="form-username">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Confirm-password</label>
			                        	<input type="password" name="cpassword" placeholder="Confirm Password..." class=" form-control" id="form-password">
			                        </div>
			                        <button type="submit" name="submit" class="btn" style="font-family: 'Sigmar One', cursive;">Reset Password</button>
			                    </form>
								
		                    </div>
                        </div>
                    </div>
                    <div class="row">
                   
                    </div>
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="signin/js/jquery-1.11.1.min.js"></script>
        <script src="signin/bootstrap/js/bootstrap.min.js"></script>
        <script src="signin/js/jquery.backstretch.min.js"></script>
        <script src="signin/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>

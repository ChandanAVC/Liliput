<?php
session_start();
ob_start();
include("connect_test.php");


if(isset($_SESSION['user_id'])){
	header('Location:forum_main.php');
}


if(isset($_POST['submit'])){
	$error = array();
	
	//username
	if(empty($_POST['username'])){
		$error[] = 'Please enter a username. ';
	}else if( ctype_alnum($_POST['username']) ){
		$username = $_POST['username'];
	}else{
		$error[] = 'Username must consist of letters and numbers only. ';
	}
	
	
	
	//password
	if(empty($_POST['password'])){
		$error[] = 'Please enter a password.';
	}else{
		$password =md5(mysql_real_escape_string($_POST['password']));
	}
	
	//error
	
	
	if(empty($error)){
		$result=mysql_query("SELECT * FROM users WHERE user_name='$username' AND user_pass='$password'")or die(mysql_error());
		if(mysql_num_rows($result)==1){
			
			while($row=mysql_fetch_array($result)){
				
			
				$_SESSION['signed_in'] = true;
				$_SESSION['user_id']=$row['user_id'];
				 $_SESSION['user_name']  = $row['user_name'];
                 $_SESSION['user_level'] = $row['user_level'];
				 
				header('Location:forum_main.php');
				
				
				
			}
		}
		
		else{
			$error_message='<span class="error">Username or password is incorrect</span> <br /> <br/>';
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
<html lang="en"  xmlns:fb="http://www.facebook.com/2008/fbml">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>

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
                            <h1><strong>Login..</strong></h1>
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
                        			<h3>Login to our site</h3>
                            		<p>Enter your username and password to log on:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form"  method="post" class="login-form" action="">
								<?php if(!empty($error_message)){echo '<p style="color:white;">'.$error_message.'</p>';} ?>
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Username</label>
			                        	<input type="text" name="username" placeholder="Username..." class="form-username form-control" maxlength="20" id="form-username">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="password" placeholder="Password..." class="form-password form-control" maxlength="20" id="form-password">
			                        </div>
			                        <button type="submit" name="submit" class="btn">Log in!</button>
			                    </form>
								<p><a href="register.php" style="color:#cccccc;font-size:14px;">Create an account</a></p>

								<p><a href="forgotpassword.php" style="color:#cccccc;font-size:14px;">Forgot password?</a></p>
								
		                    </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 social-login">
                        	<h3>Login with..</h3>
                        	<div class="social-login-buttons">
	                        	<a class="btn btn-link-2" href="fbconfig.php">
	                        		<i class="fa fa-facebook"></i> Facebook
	                        	</a>
	                        	<a class="btn btn-link-2" href="process.php">
	                        		<i class="fa fa-twitter"></i> Twitter
	                        	</a>
	                      
                        	</div>
                        </div>
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

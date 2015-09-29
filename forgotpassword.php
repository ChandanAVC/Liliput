<?php
ob_start();

include("connect_test.php");
include("header.php");
if(isset($_SESSION['user_id'])){
	header('Location:forum_main.php');
}

if(isset($_POST['submit'])){
	$error = array();
     	  if(empty($_POST['email'])){
        $error[] = 'Please enter your email. ';
    }else if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['email'])){
		$email = mysql_real_escape_string($_POST['email']);
    }else{
		$error[] = 'Your e-mail address is invalid. ';
    }
	
	 
	    if(empty($error)){
	         $sql="SELECT * FROM users WHERE user_email='".$email."' LIMIT 1";
             $result=mysql_query($sql);
			 if(mysql_num_rows($result)==1){
				 $activation=md5(uniqid(rand(),true ));
				 $sql="UPDATE users SET activation='".$activation."' WHERE user_email='".$email."'";
				 
				 $result=mysql_query($sql) or die(mysql_error());
	            $message="To change the password of your account please click on this links\n\n";
				$message.="http://forumguru.in".'/reset.php?email='.urlencode($email)."&key=$activation";
				//header('Location:reset.php?email='.urlencode($email).'&key='.$activation.'');
				mail($email,"reset password",$message);
				header('Location:prompt_test.php?x=7');
		     }
			 else{
				 $email_error="this email is not registered";
				 
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
        <title>Forgot Password??</title>

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
		<style type="text/css">
            body{background-image:url("https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQeBZ_iJjUBwryTlTIgkU_2Ac22vnsn8Tmo4KqHNOg4QGNFkzFLcQ");
			     }	
	</style>

    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Forgot Password??</strong></h1>
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
                        			<h3>Reset your Password</h3>
                            		<p>Enter your Email to get verification link to reset your password</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form"  method="post" class="login-form" action="">
								<?php if(!empty($error_message)){echo '<p style="color:white;">'.$error_message.'</p><br>';}
								       if(!empty($email_error)) {echo $email_error;}  ?>
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Username</label>
			                        	<input type="text" name="email" placeholder="email..." class="form-username form-control" id="form-username">
			                        </div>
			                        
			                        <button type="submit" name="submit" class="btn">Submit</button>
			                    </form>
								<p><a href="index.php" style="color:#cccccc;font-size:14px;">Back to Home</a></p>
		                    </div>
                        </div>
                    </div>
                    <div class="row">
                       
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

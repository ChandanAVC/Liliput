
<?php
ob_start();

session_start();
include("connect_test.php");

$x=mysql_real_escape_string($_GET['x']);
function createmessage($x){
	if(is_numeric($x)){
		
		switch($x){
			case 0:
			$message="Your account is now activated you may now <a href=\"signin_test.php\">LOG In!</a>";
			break;
			case 1:
			$message="Thank you for registering !! a confirmation email has been sent to your mail please click on the activation link to activate your account";
			break;
			
			case 2:
			$message="That email address or Username has already been registered";
			break;
			case 3:
			header('Location:topic.php?id='.htmlentities($_GET['id']));
			break;
			case 4:
			$message='Can\'t submit empty reply fill something..<a href="topic.php?id=' . htmlentities($_GET['id']) . '">move back to topic</a>';
			 break;
			
			 case 5:
			 $message='Your message has been sent';
			 break;
			 case 6:
			 $message='Can\'t submit empty reply';
			 break;
			 
			 case 7:
			 $message='A confirmation email has been sent to your mail please click on it to reset your password';
			 break;
			 
			 case 8:
			 $message='Your message has been sent.';
			 break;
		}
		echo $message;
	}
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ForumGuru | prompt</title>

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
                            <h1><strong><?php createmessage($x);?></strong></h1>
                            <div class="description">
                            	<p>
	                           
                            	</p>
                            </div>
                        </div>
                    </div>
					<button style="border-radius:2px; color:white; background-color:black"><a href="forum_main.php"> <i class="fa fa-arrow-left"></i> Back to Forum</button></a>
                    
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 social-login">
                        	<h3>Find us on..</h3>
                        	<div class="social-login-buttons">
	                        	<a class="btn btn-link-2" href="#">
	                        		<i class="fa fa-facebook"></i> Facebook
	                        	</a>
	                        	<a class="btn btn-link-2" href="#">
	                        		<i class="fa fa-twitter"></i> Twitter
	                        	</a>
	                        	<a class="btn btn-link-2" href="#">
	                        		<i class="fa fa-google-plus"></i> Google Plus
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

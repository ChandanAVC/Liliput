<?php
include("connect_test.php");
include("codes_test.php");?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sent messages</title>

    <link rel="stylesheet" type="text/css" href="topic/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="topic/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="topic/css/local.css" />

    <script type="text/javascript" src="topic/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="topic/bootstrap/js/bootstrap.min.js"></script>        
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
                <a class="navbar-brand" href="forum.php">Back to Forum</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li><a href="forum.php"><i class="fa fa-weixin"></i> My Forum feed</a></li>
                    <li><a href="image.php"><i class="fa fa-picture-o"></i> Photo Gallery</a></li>
                    <li><a href="video.php"><i class="fa fa-film"></i> Video Gallery</a></li>
					<li><a href="account.php"><i class="fa fa-weixin"></i> My account</a></li>
					
                </ul>

              
            </div>
        </nav>
    <?php
if($_SESSION['signed_in']){
	
$sql="SELECT messages.m_from,messages.m_to,messages.m_content,messages.m_sender,users.user_id,users.user_name,users.user_image FROM messages
         LEFT JOIN users ON messages.m_from=users.user_id WHERE users.user_id='".$_SESSION['user_id']."' ORDER BY m_id DESC";
	
$result=mysql_query($sql);
	
	if(!$result){echo 'sorry error connecting to database';}
	else{
		if(mysql_num_rows($result)>=1){
			
       echo '<div class="container">
	     
            <div class="row">
              <h1 style="text-indent:25px;">  SENT  </h1>
                <div class="col-sm-6">
				<div class="row">
				<div class="col-xs-12">';
				
			while($row=mysql_fetch_array($result)){
				$sql="SELECT * FROM users WHERE user_id='".$row['m_to']."'";
				$r=mysql_query($sql);
				$info=mysql_fetch_array($r);
				echo	'<div class="panel panel-default">
                                <div class="panel-heading"><a href="profile.php?id='.$row['m_to'].'">'.$info['user_name'].'</a></div>
                                <div class="panel-body">'.$row['m_content'].'
                                </div>
                          </div>  
                    <hr/>
                 ';
			    }
			echo '<div class="col-sm-6">
                    <div class="row">
                        <div class="col-xs-12">
                            <h2></h2>
                            
                           
                        </div>
                    </div>
                </div>
				</div>
				</div>';
		}
		else{
			
			echo 'No sent messages';
		}
		
	}
}
?>



</div>
</body>
</html>

<?php
include("connect_test.php");
include("codes_test.php");?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>myaccount</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="account/images/icons/favicon.ico">
    <link rel="apple-touch-icon" href="account/images/icons/favicon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="account/images/icons/favicon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="account/images/icons/favicon-114x114.png">
    <!--Loading bootstrap css-->
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <link type="text/css" rel="stylesheet" href="account/styles/jquery-ui-1.10.4.custom.min.css">
    <link type="text/css" rel="stylesheet" href="account/styles/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="account/styles/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="account/styles/animate.css">
    <link type="text/css" rel="stylesheet" href="account/styles/all.css">
    <link type="text/css" rel="stylesheet" href="account/styles/main.css">
    <link type="text/css" rel="stylesheet" href="account/styles/style-responsive.css">
    <link type="text/css" rel="stylesheet" href="account/styles/zabuto_calendar.min.css">
    <link type="text/css" rel="stylesheet" href="account/styles/pace.css">
    <link type="text/css" rel="stylesheet" href="account/styles/jquery.news-ticker.css">
					<link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>

</head>
<body>
    <div>
        <!--BEGIN THEME SETTING-->
        
        <!--END THEME SETTING-->
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
				     if($_SESSION['signed_in']){
						 
						 $sql="SELECT * FROM users WHERE user_id='".$_SESSION['user_id']."'";
						 $result=mysql_query($sql)or die();
						 $row=mysql_fetch_array($result);
						 
					 
				   echo
                             '<li class="dropdown topbar-user"><a data-hover="dropdown" href="#" class="dropdown-toggle"><img src="'.$row['user_image'].'" alt="" class="img-responsive img-circle"/>&nbsp;<span class="hidden-xs">'.$row['user_name'].'</span>&nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-user pull-right">
                            <li><a href="myaccount.php"><i class="fa fa-user"></i> My Profile</a></li>
                            <li><a href="signout.php"><i class="fa fa-power-off"></i> Log Out</a></li>
                        </ul>
				   </li>';
					 } ?> 
                    </li>
                </ul>
            </div>
        </nav>
            <!--BEGIN MODAL CONFIG PORTLET-->
            <div id="modal-config" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                                &times;</button>
                            <h4 class="modal-title">
                                Modal title</h4>
                        </div>
                        <div class="modal-body">
                           
                        </div>
                       
                    </div>
                </div>
            </div>
			
            <!--END MODAL CONFIG PORTLET-->
        </div>
        <!--END TOPBAR-->
        <div id="wrapper">
            <!--BEGIN SIDEBAR MENU-->
            <nav id="sidebar" role="navigation" data-step="2" data-intro="Template has &lt;b&gt;many navigation styles&lt;/b&gt;"
                data-position="right" class="navbar-default navbar-static-side">
            <div class="sidebar-collapse menu-scroll">
                <ul id="side-menu" class="nav">
				<div class="clearfix"></div>
                    <?php
			  
$sql = "SELECT
			categories.cat_id,
			categories.cat_name,
			categories.cat_description,
			categories.faicon,
			COUNT(topics.topic_id) AS topics
		FROM
			categories
		LEFT JOIN
			topics
		ON
			topics.topic_id = categories.cat_id
		GROUP BY
			categories.cat_name, categories.cat_description, categories.cat_id ORDER BY categories.cat_id ASC ";        


$result = mysql_query($sql);

if(!$result)
{
	echo 'The categories could not be displayed, please try again later.';
}
else
{
	if(mysql_num_rows($result) == 0)
	{
		echo 'No categories defined yet.';
	}
	else
	{
	
		  
		  while($row = mysql_fetch_array($result))
		
		{			//$id=$row['cat_id'];
				
					
		 
		
					echo "<li><a href='category.php?id=$row[cat_id]'><i class=\"$row[faicon]\"><div class=\"icon-bg bg-red\"></div> </i><span class=\"menu-title\" style=\"font-family: 'Poiret One', cursive; font-size:16px;font-weight:700;color:white;\">" . $row["cat_name"] . "</span></a></li>";
			
		}	
		  
		
	}
}
?>	
                   
                </ul>
            </div>
        </nav>
		
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">
                           My account</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="index.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Account</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Account</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <!--END TITLE & BREADCRUMB PAGE-->
                <!--BEGIN CONTENT-->
                <div class="page-content" style="padding:20px 20px 50px 20px;">
                    <div id="tab-general">
                        <div class="row mbl">
                            <div class="col-lg-12">

                                            <div class="col-md-12">
                                                <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                                                </div>
                                            </div>
                                
                            </div>

                            <div class="col-lg-12">
                              
                                    
                              <div class="row">
							  

	
<?php
    if($_SESSION['signed_in']){
		
$sql="SELECT * FROM users where user_id='".$_SESSION['user_id']."'"; 
$result=mysql_query($sql);
if(!$result){
	echo 'sorry error occured try sometime later';
	
 }
 
else {
	if(isset($_POST['submit']))	
	{
	$subject=mysql_real_escape_string($_POST['subject']);

   $error[]=array();
   if(!empty($subject)){
	      $text1=strip_tags($subject);
 
			   $t1=explode("%",$text1);
   $subject=implode(" ",$t1);}
  
	 $content=mysql_real_escape_string($_POST['content']);
	  if(!empty($content)){
	   $text2=strip_tags($content);
	     
		
			   $t2=explode("%",$text2);
			   $content=implode(" ",$t2);
	  }
	  
	 $name=$_FILES['file1']['name'];
	 $short=mysql_real_escape_string($_POST['short']);
	 if(!empty($short)){
	    $text3=strip_tags($short);
		 
			   $t3=explode("%",$text3);
			   $short=implode(" ",$t3);
	 }
	 if(!empty($name) && !empty($content) && !empty($subject) && !empty($short)){
	 
	 
	$tmp_name=$_FILES['file1']['tmp_name'];
	$location='blog/';
	$target='blog/'.$name;
	
	if(move_uploaded_file($tmp_name,$location.$name)){
	     
		$query=mysql_query("INSERT INTO blog(b_img,b_short,b_content,b_from,b_date,b_subject) VALUES('".$target."','".$short."','".$content."','".$_SESSION['user_id']."',NOW(),'".$subject."')");
	
	 }}
	
		$f_name='';
		$l_name='';
		$pass='';
		$ed='';
		$s='';
		$emp='';
        $name=$_FILES['file']['name'];
		$first_name=$_POST['firstname'];
		$last_name=$_POST['lastname'];
		$password = $_POST['password'];
		$confirm_password = $_POST['cpassword'];
		$education = $_POST['education'];
		$employment = $_POST['employment'];
		$status = $_POST['status'];
		
		//first name 
		if(!empty($first_name)){
			$text=strip_tags($first_name);
			  
	
			   $t=explode("%",$text);
			   $f_name=implode(" ",$t);
			
		}
		else{
			$sql="SELECT * FROM users WHERE user_id='".$_SESSION['user_id']."'";
			$result=mysql_query($sql);
			if(!$result){echo 'edit profile error';}
			else{
				while($row=mysql_fetch_array($result)){
						
	            $f_name=mysql_real_escape_string($row['first_name']);
			   			
				
				}
			}
			
		}
		
		//last name
		 
		 if(!empty($last_name)){
			   $text=strip_tags($last_name);
			      
			   $t=explode("%",$text);
			   $l_name=implode(" ",$t);
		
		}
		else{
			$sql="SELECT * FROM users WHERE user_id='".$_SESSION['user_id']."'";
			$result=mysql_query($sql);
			if(!$result){echo 'edit profile error';}
			else{
				while($row=mysql_fetch_array($result)){
					
					$l_name=$row['last_name'];
					  
				}
			}
			
		}

		//password
		
		if(!empty($password) && !empty($confirm_password)){
			if($password==$confirm_password){
				$pass=md5($password);
			}
			else{
				echo 'password doesn\'t match';die();
			}
		}
		else{
			$sql="SELECT * FROM users WHERE user_id='".$_SESSION['user_id']."'";
			$result=mysql_query($sql);
			if(!$result){echo 'edit profile error';}
			else{
				while($row=mysql_fetch_array($result)){
					$pass=$row['user_pass'];
				}
			}
			
		}
		
		//education
		if(!empty($education)){
			   $text=strip_tags($education);
			    
			   $t=explode("%",$text);
			   $ed=implode(" ",$t);
		
		
		}
		else{
			$sql="SELECT * FROM users WHERE user_id='".$_SESSION['user_id']."'";
			$result=mysql_query($sql);
			if(!$result){echo 'edit profile error';}
			else{
				while($row=mysql_fetch_array($result)){
					$ed=$row['education'];
					   
		
				}
			}
			
		}
		
		//employment
		if(!empty($employment)){
			   $text=strip_tags($employment);
			      
			   $t=explode("%",$text);
			   $emp=implode(" ",$t);
		}
		else{
			$sql="SELECT * FROM users WHERE user_id='".$_SESSION['user_id']."'";
			$result=mysql_query($sql);
			if(!$result){echo 'edit profile error';}
			else{
				while($row=mysql_fetch_array($result)){
					$emp=$row['employment'];

				}
			}
			
		}
		
		//status
		
		if(!empty($status)){
			$text=strip_tags($status);
			  
			   $t=explode("%",$text);
			   $s=implode(" ",$t);
			
		}
		else{
			$sql="SELECT * FROM users WHERE user_id='".$_SESSION['user_id']."'";
			$result=mysql_query($sql);
			if(!$result){echo 'edit profile error';}
			else{
				while($row=mysql_fetch_array($result)){
					$s=$row['user_status'];
		
				}
			}
			
		}
		
		//profile photo 
		if(!empty($name)){

	        $tmp_name=$_FILES['file']['tmp_name'];
	        $location='profilephoto/';
	         $target='profilephoto/'.$name;
	
	       if(move_uploaded_file($tmp_name,$location.$name)){
		    
		     $query=mysql_query("UPDATE users SET user_image='".$target."' WHERE user_id='".$_SESSION['user_id']."'");
		    echo "file uploaded";
	      }
	     else{
	   	     echo "file not uploaded";
	        }
			
		}
	
		$sql="UPDATE users SET first_name='".$f_name."',last_name='".$l_name."',user_pass='".$pass."',education='".$ed."',employment='".$emp."',user_status='".$s."' where user_id='".$_SESSION['user_id']."'";
        $result=mysql_query($sql);
         
        if(!$result){
			echo 'error occured while inserting data';
		}		
		else{
			 echo 'your profile information has been saved successfully!';
		}
		
		
	}
}
	 $sql="SELECT * FROM users WHERE user_id='".$_SESSION['user_id']."'";
	$result=mysql_query($sql);
	  if(!$result){
		echo 'sorry,error connecting to database';
	  }
	   else{ 
	          $row=mysql_fetch_array($result);
			  
			  
	     echo  '<div class="col-md-12"><h2>'.$row['user_name'].'</h2>
						 <div class="row mtl">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="text-center mbl"><img src="'.$row['user_image'].'" alt="" class="img-responsive"/></div>
                                    
                                </div>
								 <table class="table table-striped table-hover">
                                    <tbody>
                                    <tr>
                                        <td>User Name</td>
                                        <td>'.$row['user_name'].'</td>
                                    </tr>
											<td>Full name</td>
											<td>'.$row['first_name'].'  '.$row['last_name'].'</td>
                                    <tr>
                                        <td>Education </td>
                                        <td>'.$row['education'].'</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td><span class="label label-success">'.$row['user_status'].'</span></td>
                                    </tr>
                                    <tr>
                                        <td>User Level</td>';
										
										$points=$row['user_points'];
										if($points > 500){$rank="LEVEL 5";}
										else if($points > 400 && $points < 500){$rank="LEVEL 4";}
										else if($points >300 && $points < 400){$rank="LEVEL 3";}
										else if($points > 200 && $points < 300){$rank="LEVEL 2";}
									     else{$rank="LEVEL 1";}
										echo'
                                        <td><span class="label label-default">'.$rank.'</span></td>
                                    </tr>
                                    
                                    </tbody>
                                </table>
								</div>
	';}

echo '
	<div class="col-md-9">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab-edit" data-toggle="tab">Edit Profile</a></li>
                                    <li><a href="#tab-inbox" data-toggle="tab">Inbox</a></li>
									<li><a href="#tab-sent" data-toggle="tab">Sent</a></li>
									
                                </ul>
                                <div id="generalTabContent" class="tab-content">
                                    <div id="tab-edit" class="tab-pane fade in active">';
									


                                      echo  '<form action="" class="form-horizontal"  action="myaccount.php" method = "POST" enctype="multipart/form-data">
									  <h3>Post into blog</h3>

                                           
                                            
                                            <div class="form-group"><label class="col-sm-3 control-label">Subject</label>

                                                <div class="col-sm-9 controls">
                                                    <div class="row">
                                                        <div class="col-xs-9"><input type="text" name="subject" maxlength="100" placeholder="Sub.." class="form-control"/></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-3 control-label">short description</label>

                                                <div class="col-sm-9 controls">
                                                    <div class="row">
                                                        <div class="col-xs-9"><input type="text" name="short" maxlength="150"placeholder="description.." class="form-control"/></div>
                                                    </div>
                                                </div>
                                            </div>
                                          <div class="form-group"><label class="col-sm-3 control-label">choose image</label>

                                                <div class="col-sm-9 controls">
                                                    <div class="row">
                                                        <div class="col-xs-9"><input type="file" name="file1" placeholder="choose pic.." class="form-control"/></div>
                                                    </div>
                                                </div>
                                            </div>
<div class="form-group"><label class="col-sm-3 control-label">content</label>

                                                <div class="col-sm-9 controls">
                                                    <div class="row">
                                                        <div class="col-xs-9"><textarea name="content" rows="10" class="form-control" style="color:black;"></textarea></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr/>
									  <h3>Account Setting</h3>

                                           
                                            
                                            <div class="form-group"><label class="col-sm-3 control-label">Password</label>

                                                <div class="col-sm-9 controls">
                                                    <div class="row">
                                                        <div class="col-xs-9"><input type="password" name="password" maxlength="20" placeholder="password" class="form-control"/></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-3 control-label">Confirm Password</label>

                                                <div class="col-sm-9 controls">
                                                    <div class="row">
                                                        <div class="col-xs-9"><input type="password" name="cpassword" maxlength="20" placeholder="password" class="form-control"/></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr/>
											
                                            <h3>Profile Setting</h3>

                                            <div class="form-group"><label class="col-sm-3 control-label">First Name</label>

                                                <div class="col-sm-9 controls">
                                                    <div class="row">
                                                        <div class="col-xs-9"><input type="text" name="firstname" maxlength="30"placeholder="first name" class="form-control"/></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-3 control-label">Last Name</label>

                                                <div class="col-sm-9 controls">
                                                    <div class="row">
                                                        <div class="col-xs-9"><input type="text" name="lastname" maxlength="20" placeholder="last name" class="form-control"/></div>
                                                    </div>
                                                </div>
                                            </div>
											 <div class="form-group"><label class="col-sm-3 control-label">Education</label>

                                                <div class="col-sm-9 controls">
                                                    <div class="row">
                                                        <div class="col-xs-9"><input type="text" name="education" maxlength="20" placeholder="Education.." class="form-control"/></div>
                                                    </div>
                                                </div>
                                            </div>
											 <div class="form-group"><label class="col-sm-3 control-label">Employment</label>

                                                <div class="col-sm-9 controls">
                                                    <div class="row">
                                                        <div class="col-xs-9"><input type="text" name="employment" maxlength="20" placeholder="employment.." class="form-control"/></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-3 control-label">Profile pic..</label>

                                                <div class="col-sm-9 controls">
                                                    <div class="row">
                                                        <div class="col-xs-9"><input type="file" name="file" placeholder="choose pic.." class="form-control"/></div>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                           	<div class="form-group"><label class="col-sm-3 control-label">Status</label>

                                                <div class="col-sm-9 controls">
                                                    <div class="row">
                                                        <div class="col-xs-9"><textarea name="status" rows="5" class="form-control" maxlength="20"style="color:black;"></textarea></div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            

                                            
                                            
                                            <hr/>
                                            <button type="submit" class="btn btn-green btn-block" name="submit">Finish</button>
                                        </form>';

	}	?>
                                    </div>
									                   <div id="tab-inbox" class="tab-pane fade in">
                                      
                                        <div class="list-group">
										<?php
											
$sql="SELECT messages.m_from,messages.m_to,messages.m_content,messages.m_sender,users.user_id,users.user_name,users.user_image FROM messages
         LEFT JOIN users ON messages.m_to=users.user_id WHERE users.user_id='".mysql_real_escape_string($_SESSION['user_id'])."' ORDER BY m_id DESC";
	
$result=mysql_query($sql);
	
	if(!$result){echo 'sorry error connecting to database';}
	else{
		if(mysql_num_rows($result)>=1){
			while($row=mysql_fetch_array($result)){
				
			    
			
										echo
										'<li class="list-group-item"><span style="min-width: 120px; display: inline-block;" class="name"><a href="user_profile.php?id='.$row['m_from'].'"><h4 style="color:purple;">'.$row['m_sender'].'</h4></a></span><br>'.$row['m_content'].'
                                                </li>';
                               
                                

			}
			
		}	
		else{
			
			echo 'inbox empty';
		}
		echo ' </div>
                            </div>';
	}
			?>
			    <?php
if($_SESSION['signed_in']){
	
$sql="SELECT messages.m_from,messages.m_to,messages.m_content,messages.m_sender,users.user_id,users.user_name,users.user_image FROM messages
         LEFT JOIN users ON messages.m_from=users.user_id WHERE users.user_id='".$_SESSION['user_id']."' ORDER BY m_id DESC";
	
$result=mysql_query($sql);
	
	if(!$result){echo 'sorry error connecting to database';}
	else{
		if(mysql_num_rows($result)>=1){
			
				echo '<div id="tab-sent" class="tab-pane fade in">
                                      
                                        <div class="list-group">';
				
			while($row=mysql_fetch_array($result)){
				$sql="SELECT * FROM users WHERE user_id='".$row['m_to']."'";
				$r=mysql_query($sql);
				$info=mysql_fetch_array($r);
				echo	'
									
										<li class="list-group-item"><span style="min-width: 120px; display: inline-block;" class="name"><a href="user_profile.php?id='.$row['m_to'].'"><h4 style="color:purple;">'.$info['user_name'].'</h4></a></span><br>'.$row['m_content'].'
                                                </li>
                    
                 ';
			    }
		
		}
		else{
			
			echo 'No sent messages';
		}
		echo'</div></div>';
	}
}
?>
			
							  
							
										
										
										
										
										
										
                        </div>
                    </div>
                </div>
                              
                                </div>
                                
                            
                     
                            
                        </div>
                    </div>
                </div>
                <!--END CONTENT-->
                <!--BEGIN FOOTER-->
                <div id="footer">
                    <div class="copyright">
                        <a href="#">Account</a></div>
                </div>
                <!--END FOOTER-->
            </div>
            <!--END PAGE WRAPPER-->
        </div>
    </div>
    <script src="account/script/jquery-1.10.2.min.js"></script>
    <script src="account/script/jquery-migrate-1.2.1.min.js"></script>
    <script src="account/script/jquery-ui.js"></script>
    <script src="account/script/bootstrap.min.js"></script>
    <script src="account/script/bootstrap-hover-dropdown.js"></script>
    <script src="account/script/html5shiv.js"></script>
    <script src="account/script/respond.min.js"></script>
    <script src="account/script/jquery.metisMenu.js"></script>
    <script src="account/script/jquery.slimscroll.js"></script>
    <script src="account/script/jquery.cookie.js"></script>
    <script src="account/script/icheck.min.js"></script>
    <script src="account/script/custom.min.js"></script>
    <script src="account/script/jquery.news-ticker.js"></script>
    <script src="account/script/jquery.menu.js"></script>
    <script src="account/script/pace.min.js"></script>
    <script src="account/script/holder.js"></script>
    <script src="account/script/responsive-tabs.js"></script>
    <script src="account/script/jquery.flot.js"></script>
    <script src="account/script/jquery.flot.categories.js"></script>
    <script src="account/script/jquery.flot.pie.js"></script>
    <script src="account/script/jquery.flot.tooltip.js"></script>
    <script src="account/script/jquery.flot.resize.js"></script>
    <script src="account/script/jquery.flot.fillbetween.js"></script>
    <script src="account/script/jquery.flot.stack.js"></script>
    <script src="account/script/jquery.flot.spline.js"></script>
    <script src="account/script/zabuto_calendar.min.js"></script>

    <script src="account/script/index.js"></script>
    <!--LOADING SCRIPTS FOR CHARTS-->
    <script src="account/script/highcharts.js"></script>
    <script src="account/script/data.js"></script>
    <script src="account/script/drilldown.js"></script>
    <script src="account/script/exporting.js"></script>
    <script src="account/script/highcharts-more.js"></script>
    <script src="account/script/charts-highchart-pie.js"></script>
    <script src="account/script/charts-highchart-more.js"></script>
    <!--CORE JAVASCRIPT-->
    <script src="account/script/main.js"></script>
    <script>        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-145464-12', 'auto');
        ga('send', 'pageview');


</script>
</body>
</html>
	
	

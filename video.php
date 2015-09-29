<?php include("connect_test.php");
        include("codes_test.php");?>
<html>
<head>
  <title>Video Gallery</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Video Gallery</title>


	<link href="gallery/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="gallery/style.css" type="text/css">
	<link href="gallery/css/lightbox.css" rel="stylesheet">
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Poppins:400,600,700,500,300' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,900italic,900,700italic,700,400italic,500,500italic,300,100italic,100,300italic' rel='stylesheet' type='text/css'>

	<style type="text/css">
	body {background-image: url("http://www.twitpaper.com/wp-content/uploads/2014/01/1389272533_Brick_Wall_Texture1.jpg");}
	</style>
	</head>
<body>
 
<?php if($_SESSION['signed_in']){
echo '<div class="container">

    <h3></h3>

    <!-- data-toggle lets you display modal without any JavaScript -->
    <div style="margin-left:75px;"> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#popUpWindow" >Upload Video</button></div>

    <div class="modal fade" id="popUpWindow">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Upload Video to Gallery</h3>
					<p>
					    * Use the youtube site to find the video you want.<br>
                        * Click the \'Share\' button below the video.<br>
                        * Click the \'Embed\' button next to the link they show you.<br>
						* Copy the iframe code given and takeout http link without double quotation marks ( " )<br>and paste it into the Dialog given below.
						
					</p>
                </div>

                <!-- body (form) -->
                <div class="modal-body">
                    <form role="form" action="video.php" method="POST" enctype="multipart/form-data">
                       
                        <div class="form-group">
                            <input type="text" name="url" class="form-control" placeholder="Insert your http iframe src code here .. "
                              >
                          
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
else {
	echo 'you must be logged in to upload the video';
}
?>
<br><br>
   <div style="margin-left:75px;"> <a href="index.php"><button type="button" class="btn btn-danger"  data-target="#popUpWindow">Home</button></a></div>
   <br><br>

   <div style="margin-left:75px;"> <a href="forum_main.php"><button type="button" class="btn btn-info"  data-target="#popUpWindow">Forum</button></a></div>

<?php include("video_upload.php")
  
 ?>
 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="gallery/js/bootstrap.min.js"></script>
    <script type="gallery/text/javascript" src="js/jquery.countTo.js"></script>
    <script type="text/javascript" src="gallery/js/jquery.waypoints.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script src="gallery/js/lightbox.min.js"></script>

</body>
</html>

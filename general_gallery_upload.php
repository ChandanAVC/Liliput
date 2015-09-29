<?php
include("connect_test.php");
if(isset($_POST['submit'])){
	$name=$_FILES['file']['name'];
	$tmp_name=$_FILES['file']['tmp_name'];
	$location='uploads/';
	$target='uploads/'.$name;
	
	if(move_uploaded_file($tmp_name,$location.$name)){
		//$name=$_POST['name'];
		$query=mysql_query("INSERT INTO image(p_img) VALUES('".$target."')");
	
	}
	else{
		echo "file not uploaded";
	}
	

}
$result=mysql_query("SELECT * FROM image ORDER BY p_id DESC") or die(mysql_error());
    
	echo '<div class="row">
					<section id="projects">
					<ul id="thumbs" class="portfolio">';
	
				
			while($row=mysql_fetch_array($result)){	
			echo   '<li class="item-thumbs col-lg-3 design" data-id="id-0" data-type="web">
						<!-- Fancybox - Gallery Enabled - Title - Full Image -->
						<a class="hover-wrap fancybox" data-fancybox-group="gallery" title="" href="'.$row['p_img'].'">
						<span class="overlay-img"></span>
						<span class="overlay-img-thumb font-icon-plus"></span>
						</a>
                           

                      <img src="'.$row['p_img'].'" alt="" height="220" width="275"/>
						</li>
                            ';
			
			
			
			}
			
			echo'</ul>
					</section>
				</div>';
?>

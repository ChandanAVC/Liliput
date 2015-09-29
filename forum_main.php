
<?php
//create_cat.php
include 'connect_test.php';
include 'forum_header.php';
 function percent($num_amount, $num_total) {
		if($num_total==0){$num_total=1;}
        $count1 = $num_amount / $num_total;
        $count2 = $count1 * 100;
        $count = number_format($count2, 0);
        return $count;
    }
	$user_ip = mysql_real_escape_string($_SESSION['user_id']);
?>
 <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">
                            Forum Feed</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="index.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Forum Feed</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Forum Feed</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <!--END TITLE & BREADCRUMB PAGE-->
                <!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                        <div class="row mbl">
                            <div class="col-lg-12">
                                            <div class="col-md-12">
                                                <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                                                </div>
                                            </div>
                                
                            </div>

                            <div class="col-lg-12">
                            
                            <div class="page-content">
                <div class="row" >
                    <div class="col-lg-12">
                        <div class="panel">
                            <div class="panel-body">
                                <div id="grid-layout-table-1" class="box jplist">
                                    <div class="jplist-ios-button"><i class="fa fa-sort"></i>jPList Actions</div>
                                    <div class="jplist-panel box panel-top">
                                        <button type="button" data-control-type="reset" data-control-name="reset" data-control-action="reset" class="jplist-reset-btn btn btn-default">Reset<i class="fa fa-share mls"></i></button>
                                        <div data-control-type="drop-down" data-control-name="paging" data-control-action="paging" class="jplist-drop-down form-control">
                                            <ul class="dropdown-menu">
                                                <li><span data-number="3"> 3 per page</span></li>
                                                <li><span data-number="5"> 5 per page</span></li>
                                                <li><span data-number="10" data-default="true"> 10 per page</span></li>
                                                <li><span data-number="all"> view all</span></li>
                                            </ul>
                                        </div>
                                        <div data-control-type="drop-down" data-control-name="sort" data-control-action="sort" data-datetime-format="{month}/{day}/{year}" class="jplist-drop-down form-control">
                                            <ul class="dropdown-menu">
                                                <li><span data-path="default">Sort by</span></li>
                                                <li><span data-path=".title" data-order="asc" data-type="text">Title A-Z</span></li>
                                                <li><span data-path=".title" data-order="desc" data-type="text">Title Z-A</span></li>
                                                
                                            </ul>
                                        </div>
                                        <div class="text-filter-box">
                                            <div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span><input data-path=".title" type="text" value="" placeholder="Filter by Topic" data-control-type="textbox" data-control-name="title-filter" data-control-action="filter" class="form-control"/></div>
                                        </div>
                                        <div class="text-filter-box">
                                            <div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span><input data-path=".desc" type="text" value="" placeholder="Filter by Username" data-control-type="textbox" data-control-name="desc-filter" data-control-action="filter" class="form-control"/></div>
                                        </div>
                                        <div data-type="Page {current} of {pages}" data-control-type="pagination-info" data-control-name="paging" data-control-action="paging" class="jplist-label btn btn-default"></div>
                                        <div data-control-type="pagination" data-control-name="paging" data-control-action="paging" class="jplist-pagination"></div>
                                    </div>
									<div class="box text-shadow">
                                        <table class="demo-tbl"><!--<item>1</item>-->
                                           
<?php

			$topicsql = "SELECT
									topic_id,
									topic_subject,
									topic_date,
									topic_cat,
									topic_by
									
								FROM
									topics
								
								ORDER BY
									topic_id
								DESC
								
						";
								
					$topicsresult = mysql_query( $topicsql);
				
					if(!$topicsresult)
					{
						echo 'Last topic could not be displayed.';
					}
					else
					{
						if(mysql_num_rows($topicsresult) == 0)
						{
						
						}
						else
						{
							
							
							while($topicrow = mysql_fetch_assoc($topicsresult)){
								$cat_img="SELECT * FROM categories Where cat_id='".$topicrow['topic_cat']."'";
								$c_img=mysql_query($cat_img)or die();
								$im=mysql_fetch_array($c_img);
                              $pageID =$topicrow['topic_id']; // The ID of the page, the article or the video ...

    //function to calculate the percent
   

    // check if the user has already clicked on the unlike (rate = 2) or the like (rate = 1)
                         $dislike_sql = mysql_query('SELECT COUNT(*) FROM  topic_like WHERE topic_by = "'.$user_ip.'" and topic_id = "'.$pageID.'" and rate = 2 ');
                         $dislike_count = mysql_result($dislike_sql, 0); 

                         $like_sql = mysql_query('SELECT COUNT(*) FROM  topic_like WHERE topic_by = "'.$user_ip.'" and topic_id = "'.$pageID.'" and rate = 1 ');
                         $like_count = mysql_result($like_sql, 0);  

        // count all the rate 
                           $rate_all_count = mysql_query('SELECT COUNT(*) FROM  topic_like WHERE topic_id= "'.$pageID.'"');
                             $rate_all_count = mysql_result($rate_all_count, 0);  

        $rate_like_count = mysql_query('SELECT COUNT(*) FROM  topic_like WHERE topic_id = "'.$pageID.'" and rate = 1');
        $rate_like_count = mysql_result($rate_like_count, 0);  
        $rate_like_percent = percent($rate_like_count, $rate_all_count);

        $rate_dislike_count = mysql_query('SELECT COUNT(*) FROM topic_like WHERE topic_id = "'.$pageID.'" and rate = 2');
        $rate_dislike_count = mysql_result($rate_dislike_count, 0);  
        $rate_dislike_percent = percent($rate_dislike_count, $rate_all_count);
		
        $rep="SELECT COUNT(*) as reply FROM posts WHERE post_topic='".$topicrow['topic_id']."'";
					$rep_res=mysql_query($rep) or die();
					$tool=mysql_fetch_array($rep_res);
					
					$reply=$tool['reply'];
					$reply-=1;
					$user="SELECT * FROM users WHERE user_id='".$topicrow['topic_by']."'";
					$user_res=mysql_query($user) or die();
					$user_result=mysql_fetch_array($user_res);
					
					$cat="SELECT * FROM categories WHERE cat_id='".$topicrow['topic_cat']."'";
					$cat_res=mysql_query($cat) or die();
					$cat_result=mysql_fetch_array($cat_res);
										$l='like-h'.$topicrow['topic_id'];
									     $d='dislike-h'.$topicrow['topic_id'];
									echo    ' <tr class="tbl-item">
	 <td class="img" style="width:150px;height:150px;"><img src="'.$im['cat_img'].'" alt="" class="img-responsive" height="100"title="" /></td>
                                                 <td class="td-block"><p class="date">'.date('d-m-Y  H:i', strtotime($topicrow['topic_date'])).'</p>

									<a style ="text-decoration:none;" href="topic.php?id=' . $topicrow['topic_id'] . '">
                                    <p class="title" style="font-size:18px; color:green;">'. $topicrow['topic_subject'].'</p></a>
                                    <p class="desc" style="font-size:14px;"><a href="user_profile.php?id='.$user_result['user_id'].'"><span style="font-weight:600">'.$user_result['user_name'].'</span></a> ->><a style="color:#937EDC;" href="category.php?id='.$cat_result['cat_id'].'">'.$cat_result['cat_name'].'</a> <br> replies-> '.$reply.'</p>
							    
                           
							
							';?>


							 <?php if($_SESSION['signed_in']){?>
            <a href="ajax.php?id=<?php echo $topicrow['topic_id']?> &k=1 &by=<?php echo $topicrow['topic_by']?> "><div class="like-btn <?php if($like_count == 1){ echo 'like-h';} ?>">Follow</div></a>
            <a href="ajax.php?id=<?php echo $topicrow['topic_id']?>  &k=0 &by=<?php echo $topicrow['topic_by']?>"><div class="dislike-btn <?php if($dislike_count == 1){ echo 'dislike-h';} ?>"></div></a>
           

	
							 <?php }?>
            <div class="stat-cnt">
                <div class="rate-count"><?php echo $rate_all_count; ?></div>
                <div class="stat-bar">
                    <div class="bg-green" style="width:<?php echo $rate_like_percent; ?>%;"></div>
                    <div class="bg-red" style="width:<?php echo $rate_dislike_percent; ?>%"></div>
                </div><!-- stat-bar -->
                <div class="dislike-count"><?php echo $rate_dislike_count; ?></div>
                <div class="like-count"><?php echo $rate_like_count; ?></div>
         </div>
		     





 <br><br><br>
            <br>
		 <script>
    $(function(){ 

      
        $('.share-btn').click(function(){
            $('.share-cnt').toggle();
        });
    });
</script>          
        <div >

            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style ">
            <a class="addthis_button_linkedin_counter"></a>
            <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
            <a class="addthis_button_tweet"></a>
            <a class="addthis_button_google_plusone" g:plusone:size="medium"></a> 
            <a class="addthis_button_pinterest_pinit"></a>
            <a class="addthis_counter addthis_pill_style"></a>
            </div>
            <!-- AddThis Button END -->

      
		     <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5174d2b853d85895"></script>

		 
		 
		 <?php   echo '
       </div>
							</td></tr>
							
							';
							
						}
			
					}
				}

	
?>
	

			
			</table>
     </div>
                                    <div class="box jplist-no-results text-shadow align-center"><p>No results found</p></div>
                                    <div class="jplist-ios-button"><i class="fa fa-sort"></i>jPList Actions</div>
                                    <div class="jplist-panel box panel-bottom">
                                        <div data-control-type="drop-down" data-control-name="paging" data-control-action="paging" data-control-animate-to-top="true" class="jplist-drop-down form-control">
                                            <ul class="dropdown-menu">
                                                <li><span data-number="3"> 3 per page</span></li>
                                                <li><span data-number="5"> 5 per page</span></li>
                                                <li><span data-number="10" data-default="true"> 10 per page</span></li>
                                                <li><span data-number="all"> view all</span></li>
                                            </ul>
                                        </div>
                                        <div data-control-type="drop-down" data-control-name="sort" data-control-action="sort" data-control-animate-to-top="true" data-datetime-format="{month}/{day}/{year}" class="jplist-drop-down form-control">
                                            <ul class="dropdown-menu">
                                                <li><span data-path="default">Sort by</span></li>
                                                <li><span data-path=".title" data-order="asc" data-type="text">Title A-Z</span></li>
                                                <li><span data-path=".title" data-order="desc" data-type="text">Title Z-A</span></li>
                                                
                                            </ul>
                                        </div>
                                        <div data-type="{start} - {end} of {all}" data-control-type="pagination-info" data-control-name="paging" data-control-action="paging" class="jplist-label btn btn-default"></div>
                                        <div data-control-type="pagination" data-control-name="paging" data-control-action="paging" data-control-animate-to-top="true" class="jplist-pagination"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        <a href="#">Forum| LILIPUT</a></div>
                </div>
                <!--END FOOTER-->
            </div>
            <!--END PAGE WRAPPER-->
        </div>
    </div>
    <script src="forum/script/jquery-1.10.2.min.js"></script>
    <script src="forum/script/jquery-migrate-1.2.1.min.js"></script>
    <script src="forum/script/jquery-ui.js"></script>
    <script src="forum/script/bootstrap.min.js"></script>
    <script src="forum/script/bootstrap-hover-dropdown.js"></script>
    <script src="forum/script/html5shiv.js"></script>
    <script src="forum/script/respond.min.js"></script>
    <script src="forum/script/jquery.metisMenu.js"></script>
    <script src="forum/script/jquery.slimscroll.js"></script>
    <script src="forum/script/jquery.cookie.js"></script>
    <script src="forum/script/icheck.min.js"></script>
    <script src="forum/script/custom.min.js"></script>
    <script src="forum/script/jquery.news-ticker.js"></script>
    <script src="forum/script/jquery.menu.js"></script>
    <script src="forum/script/pace.min.js"></script>
    <script src="forum/script/holder.js"></script>
    <script src="forum/script/responsive-tabs.js"></script>
    <script src="forum/script/jquery.flot.js"></script>
    <script src="forum/script/jquery.flot.categories.js"></script>
    <script src="forum/script/jquery.flot.pie.js"></script>
    <script src="forum/script/jquery.flot.tooltip.js"></script>
    <script src="forum/script/jquery.flot.resize.js"></script>
    <script src="forum/script/jquery.flot.fillbetween.js"></script>
    <script src="forum/script/jquery.flot.stack.js"></script>
    <script src="forum/script/jquery.flot.spline.js"></script>
    <script src="forum/script/zabuto_calendar.min.js"></script>
    <script src="forum/script/index.js"></script>
    <script src="forum/script/highcharts.js"></script>
    <script src="forum/script/data.js"></script>
    <script src="forum/script/drilldown.js"></script>
    <script src="forum/script/exporting.js"></script>
    <script src="forum/script/highcharts-more.js"></script>
    <script src="forum/script/charts-highchart-pie.js"></script>
    <script src="forum/script/charts-highchart-more.js"></script>
    <script src="forum/script/modernizr.min.js"></script>
    <script src="forum/script/jplist.min.js"></script>
    <script src="forum/script/jplist.js"></script>

    <!--CORE JAVASCRIPT-->

    <script src="forum/script/main.js"></script>


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
            <!-- AddThis Button END -->
</body>
</html>

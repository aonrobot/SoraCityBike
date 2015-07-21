<?php include('counter.php');?>
<?php include('config/config.php'); ?>
<?php include('header.php');?>


      <!-- ////////////////////////////////////    THIS  IS SLIDE       ///////////////////////////////////////////////////// -->

      <div id="leonardo_da_vinci_machines" class="box-slider slide1">
        <div class="items-wrapper">
          <?php 
          $slide=$database->select("slide_data"
            , ["[>]slide" => ["slide_id" => "slide_id"]]
            ,"*"
            ,["slide_type[=]" => 'home',"ORDER"=>"slide_data_order"]);
      foreach ($slide as $a) {?><!-- 
    --><div class="item" >
    <div class="slidein">
      <a href=<?php echo "'".$a['slide_data_img_link']."'"; ?> style="margin:0px;"><img class="item" src=<?php echo "'".$a['slide_data_img_url']."'"; ?>></a>
      <a href=<?php echo "'".$a['slide_data_content_link']."'"; ?> style="margin:0px;">
      <span class="caption simple-caption" >
        <h4 style="margin-top:0px;margin-buttom:8px;"><?php echo $a['slide_data_name']; ?></h4>  
        <?php echo $a['slide_data_content']; ?>  
        <p class="readmore_btn">read more</p>
      </span>
      </a>
    </div>  
            </div><!--
          --><?php } ?>  

        </div>
        <div class="buttons">
          <button  class="left left1"></button>
          <button class="right right1"></button>
        </div>
      </div>



      <div class="hidden-slider" align="center">
        <div class="hidden-content" id="hideMe" style="display:none; ">        
          <div id="leonardo_da_vinci_machines" class="box-slider slide2">
            <div class="items-wrapper">
              <?php 
              $slide_video = $database->select("slide_data"
                ,["[>]slide" => ["slide_id" => "slide_id"]]
                ,["slide_data_id","slide_data_name","slide_data_img_url"]
                ,["slide_type[=]"=>"video","ORDER"=>"slide_data_order"]);
              foreach ($slide_video as $key ) {
                ?><!-- --><iframe class="itemvideo" src=<?php echo '"'.$key['slide_data_img_url'].'"'; ?> width="580" height="332" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe><!-- --><?php } ?>
              </div>
              <div class="buttons">
                <button  class="left left2"></button>
                <button class="right right2"></button>
              </div>
            </div>
          </div>
          <button class="bg-gray pero-font btn btn-default" onclick="toggle_visibility('hideMe');">show films <span><img id="video_btn" class="dropdown-span" src=<?php echo '"'.$site_path.'/components/img/down-btn.png" /'?>></span></button> 
        </div>

        <script type="text/javascript" src=<?php echo '"'.$site_path.'/components/js/horizontal_box_slider.js"'?>></script>
        <script type="text/javascript" src=<?php echo '"'.$site_path.'/components/js/jquery.horizontal_box_slider.js"'?>></script>


        <script type="text/javascript">
          var leonardo_da_vinci_machines = $(".slide1");
          var items_wrapper = leonardo_da_vinci_machines.find(".items-wrapper");
          var da_slider = items_wrapper.horizontalBoxSlider(".item");
          var left_button = leonardo_da_vinci_machines.find(".left1");
          var right_button = leonardo_da_vinci_machines.find(".right1");

          right_button.click(function(){
            da_slider.next();
          });
          left_button.click(function(){
            da_slider.previous();
          });

          var leonardo_da_vinci_machines2 = $(".slide2");
          var items_wrapper2 = leonardo_da_vinci_machines2.find(".items-wrapper");
          var da_slider2 = items_wrapper2.horizontalBoxSlider(".itemvideo");
          var left_button2 = leonardo_da_vinci_machines2.find(".left2");
          var right_button2 = leonardo_da_vinci_machines2.find(".right2");

          right_button2.click(function(){
            da_slider2.next();
          });
          left_button2.click(function(){
            da_slider2.previous();
          });
        </script>


        <!-- ////////////////////////////////////    THIS  IS END OF SLIDE       ///////////////////////////////////////////////////// -->

        <hr style="max-width:70%;margin-top:2em;">

        <!-- ////////////////////////////////////    THIS  IS CONTENT       ///////////////////////////////////////////////////// -->
        <div class="content row">
         <div class="container head-content" id="results" align="center">
          <center><h4 class="pero-font large-font underline ">stories</h4></center>
          


           <?php 
           $lang_id=$_SESSION['lang_session'];



           $datas = $database->select("category_relationships", 

            array("[>]category" => array("cat_id" => "cat_id"),"[>]content_translation" => "cont_id")

            ,'*',

            array("AND" => array("cat_type[=]"=>'story', "lang_id[=]"=>$lang_id),"ORDER"=>"cont_order")
            //array("ORDER"=>"cont_order")
            );

            ?>
		
            <?php 
			
			$countsto = 0;
			foreach ($datas as $data ) {
			
              if ($data['cat_type']=='story') {
				
                $a=$database->select("content",'*',["id[=]"=>$data['cont_id']]);
			
                ?>
				
                <div class="col-md-4 category-box">
                  <img src=<?php echo '"'.$a[0]['cont_thumbnail'].'"';?> class="index-img"/>
                  <p class="pero-font text-header"><?php echo $data["cont_title"]; ?></p>
                  <p class="pero-font text-content">
                    <?php echo $data["cont_description"]; ?> 
                    <?php echo '<a href="content.php?id='.$data["cont_id"].'"><b>READ MORE</b></a>'; ?>
                  </p>
                </div>

                <?php }}  ?>


              </div> 
					<center><a href="#" title="" id="results-show-more" class="bg-gray pero-font btn btn-default" style="margin-top:2em;">show more</a></center>
		
            </div>

            <!-- ////////////////////////////////////    THIS  IS END OF CONTENT       ///////////////////////////////////////////////////// -->


            <hr style="max-width:70%;">

            <footer>
              <div class="bg-gray container">
                <div class="row">
                  <div class="pero-font col-lg-12" align="center">
                    <small>Copyright &copy; Your Website 2014</small>
                  </div>
                </div>
              </div>
            </footer>

            <!-- jQuery -->
		
	


            <script src=<?php echo '"'.$site_path.'/components/js/jquery.js"'?>></script>
            <script src=<?php echo '"'.$site_path.'/components/js/sora-default.js"'?>></script>
            <script src=<?php echo '"'.$site_path.'/components/js/bootstrap.min.js"'?>></script>
            <script src=<?php echo '"'.$site_path.'/components/js/bootstrap-hover-dropdown.js"'?>></script>

				
                
             <script>		
				$(document).ready(function(){
					var limit =6;
					var per_page = 6;
					
					jQuery('#results> div.category-box:gt('+(limit-1)+')').hide();
					
					if (jQuery('#results > div.category-box').length <= limit) {
						jQuery('#results-show-more').hide();
					}
					
					jQuery('#results-show-more').bind('click', function(event){
						event.preventDefault();
						limit += per_page;
						jQuery('#results > div.category-box:lt('+(limit)+')').show();
						if (jQuery('#results > div.category-box').length <= limit) {
							jQuery(this).hide();
						}
					});
				});
				 </script>   
                
          </body>
          </html>

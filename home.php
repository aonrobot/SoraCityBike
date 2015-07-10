<div class="swiper-container swiper1" style="display:block;">
 <div class="swiper-wrapper">
  <!-- Wrapper for slides -->
  <?php 
   $slide=$database->select("slide_data", ["[>]slide" => ["slide_id" => "slide_id"]],"*",["slide_type[=]" => 'home']);
  foreach ($slide as $a) {
    
  
  ?>
 

    <div class="swiper-slide">
     <div class="slidein" > 
       <a href=<?php echo "'".$a['slide_data_img_link']."'"; ?>><img src=<?php echo "'".$a['slide_data_img_url']."'"; ?> alt="" class="swiper-slide"> </a>
       <a href=<?php echo "'".$a['slide_data_content_link']."'"; ?>><span class="caption simple-caption" >
        <h3 style="margin-left:10px;"><?php echo $a['slide_data_name']; ?></h3> 
          <p style="margin-left:10px; color:white;"> <?php echo $a['slide_data_content']; ?></p>    
        </span></a>
      </div> 
    </div>

  <?php } ?>  
  </div>

  
  <!--navigation buttons-->
  <div class="swiper-button-next swiper-button-next1"></div>
  <div class="swiper-button-prev swiper-button-prev1"></div>
</div>

<div class="hidden-slider" align="center">
  <div class="hidden-content" id="hideMe" style="display:none; ">
    <div class="swiper-container swiper2" >
      <!-- Wrapper for slides -->
      <div class="swiper-wrapper">
      <?php 
      $slide_video = $database->select("slide_data",["[>]slide" => ["slide_id" => "slide_id"]],["slide_data_id","slide_data_name","slide_data_img_url"],["slide_type[=]"=>"video"]);
      foreach ($slide_video as $key ) {
      ?>
        <div class="bg-gray swiper-slide" >
          <iframe src=<?php echo '"'.$key['slide_data_img_url'].'"'; ?> width="590" height="332" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
        </div>
        <?php } ?>
    </div>
    <div class="swiper-button-next swiper-button-next2"></div>
    <div class="swiper-button-prev swiper-button-prev2"></div>
  </div>
</div>

<button class="bg-gray pero-font btn btn-default" onclick="toggle_visibility('hideMe');">show films <span><img id="video_btn" class="dropdown-span" src="components/img/down-btn.png" /></span></button> 

</div>

<hr style="max-width:70%;margin-top:2em;">

<div class="content row">
 <div class="container head-content" align="center">
  <h4 class="pero-font large-font underline ">stories</h4>
  <p class="pero-font">Kinfolk is a slow lifestyle magazine that explores ways for readers to simplify their lives<br>
   cultivate community and spend more time with their friends and family.</p>
   

   <?php 
   $lang_id=1;
   


   $datas = $database->select("category_relationships", 

    array("[>]category" => array("cat_id" => "cat_id"),"[>]content_translation" => "cont_id"),

   // "[>]content" => "id"
   '*',

   //array("cat_type[=]"=>'story'));
   array("AND" => array("cat_type[=]"=>'story', "lang_id[=]"=>$lang_id))
   );

    //foreach ($datas as $key) {
    // echo $key['cont_id'].$key['cont_title'].'+';
      
    //}
      
   ?>
   

   <?php foreach ($datas as $data ) {
    $a=$database->select("content",'*',["id[=]"=>$data['cont_id']]);
      
    ?>

     <div class="col-md-4 category-box">
      <img src=<?php echo '"'.$a[0]['cont_thumbnail'].'"';?> class="index-img"/>
      <p class="pero-font text-header"><?php echo $data["cont_title"]; ?></p>
      <p class="pero-font text-content">
        <?php echo $data["cont_description"]; ?> 
        <?php echo '<a href="index.php?p=content&id='.$data["cont_id"].'"><b>READ MORE</b></a>'; ?>
      </p>
    </div>

    <?php } ?>


  </div> 


</div>



<div class="swiper-container swiper1" style="display:block;">
 <div class="swiper-wrapper">
  <!-- Wrapper for slides -->
  <?php 
   $slide=$database->select("slide_data", ["[>]slide" => ["slide_id" => "slide_id"]],"*",["slide_name[=]" => 'home']);
  foreach ($slide as $key) {
    
  
  ?>
 

    <div class="swiper-slide">
     <div class="slidein" > 
       <img src=<?php echo "'".$key['slide_data_img_url']."'"; ?> alt="" class="slide_pic"> 
       <span class="caption simple-caption" >
        <h3 style="margin-left:10px;"><?php echo $key['slide_data_name']; ?></h1> 
          <p style="margin-left:10px; color:white;"> <?php echo $key['slide_data_content']; ?></p>    
        </span>
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
        <div class="bg-gray swiper-slide" >
          <iframe src="http://player.vimeo.com/video/78083533?title=0&amp;byline=0&amp;portrait=0&amp;color=6fde9f" width="590" height="332" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
        </div>
        <div class="bg-gray swiper-slide" >
         <iframe src="http://player.vimeo.com/video/78083533?title=0&amp;byline=0&amp;portrait=0&amp;color=6fde9f" width="590" height="332" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
       </div>
       <div class="bg-gray swiper-slide" >
        <iframe src="http://player.vimeo.com/video/33205292?title=0&amp;byline=0&amp;portrait=0&amp;color=6fde9f" width="590" height="332" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>    
      </div>
      <div class="bg-gray swiper-slide" >
        <iframe src="http://player.vimeo.com/video/71142382?title=0&amp;byline=0&amp;portrait=0&amp;color=6fde9f" width="590" height="332" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>   
      </div>
      <div class="bg-gray swiper-slide" >
        <iframe src="http://player.vimeo.com/video/71377855?title=0&amp;byline=0&amp;portrait=0&amp;color=6fde9f" width="590" height="332" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
      </div>
    </div>
    <div class="swiper-button-next swiper-button-next2"></div>
    <div class="swiper-button-prev swiper-button-prev2"></div>
  </div>
</div>

<button class="bg-gray hidden-btn pero-font btn btn-default"  onclick="toggle_visibility('hideMe');">more slide</button> 

</div>

<hr style="max-width:70%;margin-top:2em;">

<div class="content row">
 <div class="container con-content" align="center">
  <h4 class="pero-font large-font underline ">stories</h4>
  <p class="pero-font">Kinfolk is a slow lifestyle magazine that explores ways for readers to simplify their lives<br>
   cultivate community and spend more time with their friends and family.</p>
   

   <?php 
   $lang_id=1;
   


   $datas = $database->select("category_relationships", array(

    "[>]category" => array("cat_id" => "cat_id"),

    "[>]content_translation" => "cont_id"

   // "[>]content" => "id"
    ),

   '*',

   array("AND" => array("cat_type[=]"=>'story', "lang_id[=]"=>$lang_id))

   );

    foreach ($datas as $key) {
      echo $key['cont_id'].$key['cont_title'].'+';
      $a=$database->select("content",'*',["id[=]"=>$key['cont_id']]);
    }
      echo $a[0]['cont_author'];
   ?>
   

   <?php foreach ($datas as $data ) { ?>

     <div class="col-md-6 category-box">
      <img src= <?php echo "'".$data['cont_thumbnail']."'";?> class="index-img"/>
      <p class="pero-font text-header"><?php echo $data["cont_title"]; ?></p>
      <p class="pero-font text-content">
        <?php echo $data["cont_description"]; ?> 
        <?php echo '<a href="index.php?p=content&id='.$data["cont_id"].'"><b>READ MORE</b></a>'; ?>
      </p>
    </div>

    <?php } ?>


  </div> 


</div>
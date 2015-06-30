<div class="swiper-container swiper1" style="display:block;">

  <!-- Wrapper for slides -->
  <div class="swiper-wrapper">
    <div class="swiper-slide">
     <div class="slidein" > 
       <img src="img/slide-1.jpg" alt="" > 
       <span class="caption simple-caption" >
        <h3 style="margin-left:10px;">Simple Caption</h1> 
          <p style="margin-left:10px; color:white;"> Hello my name is pusit nice to meet you. This is first image.
          </p>    
        </span>
      </div> 
    </div>
    <div class="swiper-slide">
     <div class="slidein" > 
       <img src="img/slide-2.jpg" alt="" > 
       <span class="caption simple-caption" >
        <h3 style="margin-left:10px;">Simple Caption1</h1>  
          <p style="margin-left:10px; color:white;"> This is second image.
          </p>    
        </span>
      </div> 
    </div>
    <div class="swiper-slide">
     <div class="slidein" > 
       <img src="img/slide-3.jpg" alt="" > 
       <span class="caption simple-caption" >
        <h3 style="margin-left:10px;">Simple Caption2</h1>  
          <p style="margin-left:10px; color:white;"> This is third image.
          </p>    
        </span>
      </div> 
    </div>
    <div class="swiper-slide">
     <div class="slidein" > 
       <img src="img/slide-7.jpg" alt=""  > 
       <span class="caption simple-caption" >
        <h3 style="margin-left:10px;">Simple Caption2</h1>  
          <p style="margin-left:10px; color:white;"> This is third image.
          </p>    
        </span>
      </div> 
    </div>
    <div class="swiper-slide">
      <div class="slidein" > 
       <img src="img/slide-1.jpg" alt="" > 
       <span class="caption simple-caption" >
        <h3 style="margin-left:10px;">Simple Caption3</h1>  
          <p style="margin-left:10px; color:white;"> This is 4th image.
          </p>    
        </span>
      </div> 
    </div>
    <div class="swiper-slide">
      <div class="slidein" > 
       <img src="img/slide-2.jpg" alt="" > 
       <span class="caption simple-caption" >
        <h3 style="margin-left:10px;">Simple Caption4</h1>  
          <p style="margin-left:10px; color:white;"> This is 5th image.
          </p>    
        </span>
      </div> 
    </div>
    <div class="swiper-slide">
     <div class="slidein" > 
       <img src="img/slide-3.jpg" alt="" > 
       <span class="caption simple-caption" >
        <h3 style="margin-left:10px;">Simple Caption5</h1>  
          <p style="margin-left:10px; color:white;"> This is 6th image.
          </p>    
        </span>
      </div> 
    </div>
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
   $datas = $database->select("content_translation","*");
    ?>
   
   <?php foreach ($datas as $data ) { ?>

   
   <div class="col-md-6 category-box">
    <img src="img/slide-3.jpg" class="index-img"/>
    <p class="pero-font text-header"><?php echo $data["cont_title"]; ?></p>
    <p class="pero-font text-content">
    <?php echo $data["cont_description"]; ?> 
    <a href=""><b>READ MORE</b></a>
    </p>
    </div>
   <?php } ?>


</div> 


</div>
<div id="leonardo_da_vinci_machines" class="box-slider slide1">
      <div class="items-wrapper">
      <?php 
      $slide=$database->select("slide_data", ["[>]slide" => ["slide_id" => "slide_id"]],"*",["slide_type[=]" => 'home']);
      foreach ($slide as $a) {?>
            <div class="item" >
              <div class="slidein">
                <img class="item" src=<?php echo "'".$a['slide_data_img_url']."'"; ?>>
                <span class="caption simple-caption" >
                  <h3 style="margin-left:10px;"><?php echo $a['slide_data_name']; ?></h3>  
                  <p style="margin-left:10px; color:white;"> <?php echo $a['slide_data_content']; ?></p>   
                </span>
              </div>
            </div>
         <?php } ?>  
  </div>
    <div class="buttons">
    <button  class="left left1"></button>
    <button class="right right1"></button>
  </div>
</div>



<div class="hidden-slider" align="center">
  <div class="hidden-content" id="hideMe" style="display:none; ">
    
\

<div id="leonardo_da_vinci_machines" class="box-slider slide2">
<div class="items-wrapper">
<?php 
        $slide_video = $database->select("slide_data",["[>]slide" => ["slide_id" => "slide_id"]],["slide_data_id","slide_data_name","slide_data_img_url"],["slide_type[=]"=>"video"]);
        foreach ($slide_video as $key ) {
          ?>
  
    <iframe class="itemvideo" src=<?php echo '"'.$key['slide_data_img_url'].'"'; ?> width="590" height="332" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
        <?php } ?>
  </div>
  
  <div class="buttons">
    <button  class="left left2"></button>
    <button class="right right2"></button>
  </div>
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


<script type="text/javascript" src="components/js/horizontal_box_slider.js"></script>
<script type="text/javascript" src="components/js/jquery.horizontal_box_slider.js"></script>
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

<?php include('config/config.php'); ?>
<?php include('header.php');?>

    

      <!-- ////////////////////////////////////    THIS  IS SLIDE       ///////////////////////////////////////////////////// -->

      

<!-- slide with zoom picture -->
<?php 

 $content_db = $database->select("content",["id","slide_id","cont_name"],["id[=]"  => $_GET['id']]);
foreach ($content_db as $key) {
 
 $slide_id= $key['slide_id'];
}
$slide = $database->select("slide_data"
  ,["slide_data_id","slide_data_name","slide_data_img_url"]
  ,["slide_id[=]" => $slide_id]
  ,["ORDER"=>"slide_data_order"]
  );

?>

<div id="leonardo_da_vinci_machines" class="box-slider">
  <div class="items-wrapper">
     
   
   <?php foreach ($slide as $key) { ?><!-- --><a href=<?php echo '"'.$key['slide_data_img_url'].'"'; ?> class="itemzoom"><span class="zoom"></span><img class="itemzoom" src=<?php echo '"'.$key['slide_data_img_url'].'"'; ?>  
      alt="" ></a><!-- --><?php } ?>
          

  </div>

  
  <div class="buttons">
    <button  class="left"></button>
    <button class="right"></button>
  </div>
</div>




<script type="text/javascript" src=<?php echo '"'.$site_path.'/components/js/cobox.js"'?>></script>
<script type="text/javascript" src=<?php echo '"'.$site_path.'/components/js/horizontal_box_slider.js"'?>></script>
<script type="text/javascript" src=<?php echo '"'.$site_path.'/components/js/jquery.horizontal_box_slider.js"'?>></script>

<script>


var leonardo_da_vinci_machines = $("#leonardo_da_vinci_machines");
var items_wrapper = leonardo_da_vinci_machines.find(".items-wrapper");
var da_slider = items_wrapper.horizontalBoxSlider(".itemzoom");
var left_button = leonardo_da_vinci_machines.find(".left");
var right_button = leonardo_da_vinci_machines.find(".right");

right_button.click(function(){
  da_slider.next();
});
left_button.click(function(){
  da_slider.previous();
});



</script>

<!-- End slide with zoom picture -->

<!-- ////////////////////////////////////    THIS  IS END OF SLIDE       ///////////////////////////////////////////////////// -->

        <hr style="max-width:70%;margin-top:2em;">

<!-- ////////////////////////////////////    THIS  IS CONTENT       ///////////////////////////////////////////////////// -->


<?php

 $lang_id=$_SESSION['lang_session'];
 $id=$_GET["id"];
 $datas = $database->select("content_translation","*",["AND"=>["lang_id[=]"=>$lang_id,"cont_id[=]"=>$id]]);
?>

<div class="content row">
  <div class="pero-font container main_content">
    <div class="title_content"><h4 class="pero-font large-font underline "><?php echo $datas[0]["cont_title"]; ?></h4></div>
    <?php 
    echo $datas[0]["cont_content"];
    ?>
  </div>


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


        </body>
        </html>

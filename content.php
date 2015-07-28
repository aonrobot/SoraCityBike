
<?php include('config/config.php'); ?>
<?php include('header.php');?>

<?php
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
?>    

      <!-- ////////////////////////////////////    THIS  IS SLIDE       ///////////////////////////////////////////////////// -->

      

<!-- slide with zoom picture -->
<?php 
  
 $content_db = $database->select("content",["id","slide_id","cont_name"],["id[=]"  => $_GET['id']]);

 $slide_id = $content_db[0]["slide_id"];

$slide = $database->select("slide_data"
  ,["slide_data_id","slide_data_name","slide_data_img_url","slide_data_order"]
  ,["slide_id[=]" => $slide_id,"ORDER"=>"slide_data_order"]

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
<script src=<?php echo '"'.$site_path.'/components/js/jquery.prettySocial.min.js"'?>></script>


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
    <p>share</p>
    <a href="#" data-type="facebook" data-url=<?php echo curPageURL(); ?> data-title="hellasdasdaoooo" data-description="WTFsadasdasdadaddasdasddude"
     data-media="http://sonnyt.com/assets/imgs/prettySocial.png" class="prettySocial fa fa-facebook" style='color:#000'><b>facebook</b></a>
     
    <div>
        <!-- Buttons start here. Copy this ul to your document. -->
        <ul class="rrssb-buttons clearfix">
          <li class="rrssb-facebook">
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo curPageURL(); ?>" class="popup">
              <span class="rrssb-icon">
                <svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="29" height="29" viewBox="0 0 29 29"><path d="M26.4 0H2.6C1.714 0 0 1.715 0 2.6v23.8c0 .884 1.715 2.6 2.6 2.6h12.393V17.988h-3.996v-3.98h3.997v-3.062c0-3.746 2.835-5.97 6.177-5.97 1.6 0 2.444.173 2.845.226v3.792H21.18c-1.817 0-2.156.9-2.156 2.168v2.847h5.045l-.66 3.978h-4.386V29H26.4c.884 0 2.6-1.716 2.6-2.6V2.6c0-.885-1.716-2.6-2.6-2.6z"
                  class="cls-2" fill-rule="evenodd"/></svg>
              </span>
              <span class="rrssb-text">facebook</span>
            </a>
          </li>  
          <li class="rrssb-twitter">
            <a href="https://twitter.com/intent/tweet?text=Ridiculously%20Responsive%20Social%20Sharing%20Buttons%20by%20%40dbox%20and%20%40joshuatuscan%3A%20http%3A%2F%2Fkurtnoble.com%2Flabs%2Frrssb%20%7C%20http%3A%2F%2Fkurtnoble.com%2Flabs%2Frrssb%2Fmedia%2Frrssb-preview.png"
            class="popup">
              <span class="rrssb-icon"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28"><path d="M24.253 8.756C24.69 17.08 18.297 24.182 9.97 24.62c-3.122.162-6.22-.646-8.86-2.32 2.702.18 5.375-.648 7.507-2.32-2.072-.248-3.818-1.662-4.49-3.64.802.13 1.62.077 2.4-.154-2.482-.466-4.312-2.586-4.412-5.11.688.276 1.426.408 2.168.387-2.135-1.65-2.73-4.62-1.394-6.965C5.574 7.816 9.54 9.84 13.802 10.07c-.842-2.738.694-5.64 3.434-6.48 2.018-.624 4.212.043 5.546 1.682 1.186-.213 2.318-.662 3.33-1.317-.386 1.256-1.248 2.312-2.4 2.942 1.048-.106 2.07-.394 3.02-.85-.458 1.182-1.343 2.15-2.48 2.71z"/></svg></span>
              <span class="rrssb-text">twitter</span>
            </a>
          </li>
        </ul>
        <!-- Buttons end here -->    
   </div>
     
  </div>


</div>

<script type="text/javascript" class="source">
      $('.prettySocial').prettySocial();
    </script>
    
<!-- RRSSB Social Share JS -->
<script src="<?php echo $site_path;?>/components/js/rrssb.min.js"></script>


<!-- ////////////////////////////////////    THIS  IS END OF CONTENT       ///////////////////////////////////////////////////// -->





          <script src=<?php echo '"'.$site_path.'/components/js/jquery.js"'?>></script>
          <script src=<?php echo '"'.$site_path.'/components/js/sora-default.js"'?>></script>
          <script src=<?php echo '"'.$site_path.'/components/js/bootstrap.min.js"'?>></script>
          <script src=<?php echo '"'.$site_path.'/components/js/bootstrap-hover-dropdown.js"'?>></script>


        </body>
        </html>

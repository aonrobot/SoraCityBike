
<?php include('config/config.php'); ?>
<?php include('header.php');?>



 <!-- ////////////////////////////////////    THIS  IS SLIDE       ///////////////////////////////////////////////////// -->

      

<!-- slide with zoom picture -->
<?php 
 $datas = $database->select("category",["cat_id","slide_id","cat_name"],["cat_id[=]"  => $_GET['id']]);

foreach ($datas as $key) {
 $slide_id= $key['slide_id'];
}
$slide = $database->select("slide_data"
  ,["slide_data_id","slide_data_name","slide_data_img_url"]
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



/*
 function showImage(a) {

  //alert(a);
  var formData = {
    'id' : a
  };

  $.ajax({
   type: "POST",                                     
   url: 'select_url.php',
   dataType: 'json',                           
   data: formData ,
  
   success: function(data){
    //(data[0]);
  
    document.getElementById('largeImg').src = data[0];
  
    showLargeImagePanel();
    unselectAll();

   } 
 });




  
}
function showLargeImagePanel() {
  document.getElementById('largeImgPanel').style.visibility = 'visible';
  
}
function unselectAll() {
  if(document.selection) document.selection.empty();
  if(window.getSelection) window.getSelection().removeAllRanges();
}
function hideImg(obj) {
  
  obj.style.visibility = 'hidden';

}

*/

</script>

<!-- End slide with zoom picture -->

<!-- ////////////////////////////////////    THIS  IS END OF SLIDE       ///////////////////////////////////////////////////// -->

        <hr class="endofslide" style="max-width:70%;margin-top:2em;">

		<script>
			if( $('.itemzoom').is(':empty') ) {
				
			}else{
				$('.endofslide').css("margin-top","0.2em");
			}
		</script>

<!-- ////////////////////////////////////    THIS  IS CONTENT       ///////////////////////////////////////////////////// -->


<div class="content row">
  <div class="pero-font container main_content" align="center">
        <center style="padding-bottom:2.5em;"><h4 class="pero-font large-font underline   ">categories</h4><br></center>
     <?php 
           $lang_id=$_SESSION['lang_session'];
           $id=$_GET["id"];


           $datas = $database->select("category_relationships", 
            array("[>]category" => array("cat_id" => "cat_id"),"[>]content_translation" => "cont_id")
            ,'*'
            ,array("lang_id[=]"=>$lang_id,"ORDER"=>"cont_order")                    
            );
            
            ?>


            <?php foreach ($datas as $data ) 
            {   
            //echo $data["cont_order"];
                if ($data['cat_id']==$id){
              $a=$database->select("content",'*',["id[=]"=>$data['cont_id']]);
              $link = "'".$site_path."/content/".$data['cont_id']."/".$a[0]["cont_slug"]."'"; 
              ?>

              <div class="col-md-4 category-box">

                  <a href=<?php echo $link?>><img src=<?php echo '"'.$a[0]['cont_thumbnail'].'"';?> class="index-img"/></a>
                  <div class="text-headerbox"><a href=<?php echo $link?>><p class="pero-font text-header"><?php echo $data["cont_title"]; ?></p></a></div>
                  <span class="pero-font text-content" style="padding-top:30px;">
                    <?php echo $data["cont_description"]; ?>
                   </span>
                   <p class="pero-font text-content"><?php echo '<a href='.$link.'><b>read more</b></a>' ?></p>
                  
                </div>

              <?php }} ?>

</div>
</div>
<hr style="max-width:70%;margin-top:-3em;">

<!-- ////////////////////////////////////    THIS  IS END OF CONTENT       ///////////////////////////////////////////////////// -->




          <script src=<?php echo '"'.$site_path.'/components/js/jquery.js"'?>></script>
          <script src=<?php echo '"'.$site_path.'/components/js/sora-default.js"'?>></script>
          <script src=<?php echo '"'.$site_path.'/components/js/bootstrap.min.js"'?>></script>
          <script src=<?php echo '"'.$site_path.'/components/js/bootstrap-hover-dropdown.js"'?>></script>


        </body>
        </html>




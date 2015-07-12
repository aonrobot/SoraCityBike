

<!-- slide with zoom picture -->
<?php 
$datas = $database->select("content",["id","slide_id"],["id[=]"=>$_GET['id']]);

foreach ($datas as $key) {
 $slide_id= $key['slide_id'];
}
$slide = $database->select("slide_data",["slide_data_id","slide_data_name","slide_data_img_url"],["slide_id[=]"=>$slide_id]);
?><div id="leonardo_da_vinci_machines" class="box-slider">
  <div class="items-wrapper">
     <div class="item" >
    <?php 
    foreach ($slide as $key) { ?>
     
   <img class="item" src=<?php echo '"'.$key['slide_data_img_url'].'"'; ?>  onClick="showImage(id);" id=<?php echo '"'.$key['slide_data_id'].'"';?>>
   <?php } ?>
          </div>

  </div>

  
  <div class="buttons">
    <button  class="left"></button>
    <button class="right"></button>
  </div>
</div>


           <div id="largeImgPanel" onclick="hideMe(this);">
           <img id="largeImg" style="margin: 0; padding: 0; height:500px;" />
  </div>

<script>

 function showImage(a) {

  //alert(a);
  var formData = {
    'id'         : a
  };

  $.ajax({
   type: "POST",                                     
   url: 'select_url.php',
   dataType: 'json',                           
   data: formData,

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


</script>
<script type="text/javascript" src="components/js/horizontal_box_slider.js"></script>
<script type="text/javascript" src="components/js/jquery.horizontal_box_slider.js"></script>
<!-- End slide with zoom picture -->



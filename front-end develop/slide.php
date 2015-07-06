

<!-- slide with zoom picture -->
<?php 
$datas = $database->select("content",["id","slide_id"],["id[=]"=>$_GET['id']]);

foreach ($datas as $key) {
 $slide_id= $key['slide_id'];
}

$slide = $database->select("slide_data",["slide_data_id","slide_data_name","slide_data_img_url"],["slide_id[=]"=>$slide_id]);


?>
<div class="swiper-container swiper3">

  <!-- Wrapper for slides -->
  <div class="swiper-wrapper " style="cursor:pointer;">

    <?php 
    foreach ($slide as $key) { 
      $i=1;
      echo '<div class="slide_pic swiper-slide" > <img src='.$key['slide_data_img_url'].' onClick="showImage(id);" alt="" id='.$key['slide_data_id'].'> </div>';
      $i=$i+1; }
      ?>
    </div>

  </div>

  <!--navigation buttons-->
  <div class="swiper-button-next swiper-button-next3"></div>
  <div class="swiper-button-prev swiper-button-prev3"></div>

</div>



<div id="largeImgPanel" onclick="hideImg(this);">
 <img id="largeImg" style="margin: 0; padding: 0;" />
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
<!-- End slide with zoom picture -->



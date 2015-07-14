

<!-- slide with zoom picture -->
<?php 
 $datas = $database->select("content",["id","slide_id"],["id[=]"  => $_GET['id']]);

foreach ($datas as $key) {
 $slide_id= $key['slide_id'];
}
$slide = $database->select("slide_data",["slide_data_id","slide_data_name","slide_data_img_url"],["slide_id[=]" => $slide_id]);
?>
<div id="leonardo_da_vinci_machines" class="box-slider">
  <div class="items-wrapper">
     
	 
	 <?php foreach ($slide as $key) { ?><!-- --><div class="item" >
     <img class="item" src=<?php echo '"'.$key['slide_data_img_url'].'"'; ?>  onClick="showImage(id);" id=<?php echo '"'.$key['slide_data_id'].'"';?>  alt="" >
     </div><!-- --><?php } ?>
          

  </div>

  
  <div class="buttons">
    <button  class="left"></button>
    <button class="right"></button>
  </div>
</div>


   <div id="largeImgPanel" onclick="hideImg(this);">
           <img id="largeImg" style="margin: 0; padding: 0; height:500px;" />
  </div>




<script type="text/javascript" src="components/js/horizontal_box_slider.js"></script>
<script type="text/javascript" src="components/js/jquery.horizontal_box_slider.js"></script>

<script>


var leonardo_da_vinci_machines = $("#leonardo_da_vinci_machines");
var items_wrapper = leonardo_da_vinci_machines.find(".items-wrapper");
var da_slider = items_wrapper.horizontalBoxSlider(".item");
var left_button = leonardo_da_vinci_machines.find(".left");
var right_button = leonardo_da_vinci_machines.find(".right");

right_button.click(function(){
	da_slider.next();
});
left_button.click(function(){
	da_slider.previous();
});





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



</script>

<!-- End slide with zoom picture -->



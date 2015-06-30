

<!-- slide with zoom picture -->
<div class="swiper-container swiper3">

    <!-- Wrapper for slides -->
    <div class="swiper-wrapper" style="cursor:pointer;">
        <div class="swiper-slide" >
           
               <img src="img/slide-1.jpg" id='1' onClick="showImage(id);" alt="" > 
              

          </div>



          <div class="swiper-slide"  >
          
               <img src="img/slide-2.jpg" id='2' onClick="showImage(id);" alt="" > 
              

          </div>
          <div class="swiper-slide">

          
               <img src="img/slide-3.jpg" id='3' onClick="showImage(id);" alt="" > 
              

          </div>
          <div class="swiper-slide">
             
                 <img src="img/slide-1.jpg" id='1' onClick="showImage(id);" alt="" > 
                 
          </div>
          <div class="swiper-slide">
             
                 <img src="img/slide-2.jpg" id='2' onClick="showImage(id);" alt="" > 
                 

          </div>

          <div class="swiper-slide ">
            
                 <img src="img/slide-3.jpg" id='3' onClick="showImage(id);" alt="" > 
             
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
			  function showImage(String) {
	   					
                document.getElementById('largeImg').src = "img/slide-"+String+".jpg";
                showLargeImagePanel();
                unselectAll();
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





 <?php include('../config/config.php'); ?>
 <?php include('header.php'); ?>

<hr style="max-width:70%;">
 <?php 
if ($page!='home') {
   include('slide.php');
}
 ?>

 <?php include($page.'.php'); ?>
 <hr style="max-width:70%;">
 <?php include('footer.php'); ?>

 <!-- jQuery -->
 <script src="js/jquery.js"></script>
 <script src="js/sora-default.js"></script>
 <script src="js/bootstrap.min.js"></script>
 <script src="js/swiper.min.js"></script>
 

<script>
 var swiper1 = new Swiper('.swiper1', {

        slidesPerView: 'auto',
        centeredSlides: false,
        spaceBetween: 0,
        grabCursor: false,

        nextButton: '.swiper-button-next1',
        prevButton: '.swiper-button-prev1'

    });
	
	
	
</script>

<script>
 var swiper3 = new Swiper('.swiper3', {

        slidesPerView: 'auto',
        centeredSlides: false,
        spaceBetween: 0,
        grabCursor: false,

        nextButton: '.swiper-button-next3',
        prevButton: '.swiper-button-prev3'

    });
  
  
  
</script>
</body>

</html>



 <?php include('../config/config.php'); ?>
 <?php include('header.php'); ?>
 <?php include('slide.php'); ?>

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
</body>

</html>

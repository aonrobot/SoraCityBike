





 <?php include('top-menu.php'); ?>
 <?php include('slide.php'); ?>
 <hr class="mid-line">
 <?php include('content.php'); ?>


 <hr style="max-width: 70%;">
 <?php include('footer.php'); ?>

 <!-- jQuery -->
 <script src="js/jquery.js"></script>
 <script src="js/sora-default.js"></script>
 <script src="js/bootstrap.min.js"></script>
  <script src="js/swiper.min.js"></script>
 
 <script>
  $('.carousel').carousel({
        interval: 5000 //changes the speed
      })
</script>
<script>
  var swiper = new Swiper('.swiper-container', {
    scrollbar: '.swiper-scrollbar',
    scrollbarHide: false,
    slidesPerView: 'auto',
    centeredSlides: false,
    spaceBetween: 0,
    grabCursor: false,

    nextButton: '.swiper-button-next',
    prevButton: '.swiper-button-prev'

  });
</script>
</body>

</html>

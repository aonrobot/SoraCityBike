<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="img/favicon2.png">
  <link rel="icon" href="img/favicon2.png">

  <title>Sora City Bike</title>
  <!-- Swiper Slider css -->
  <link href="css/swiper.min.css" rel="stylesheet" >
  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="css/sora-default.css" rel="stylesheet">

  <!-- Fonts -->

</head>

<body>
  <?php include('top-menu.php'); ?>
  <?php include('slide.php'); ?>
  <hr class="mid-line">
  <?php include('content.php'); ?>
  <hr style="max-width: 70%;">
  <?php include('footer.php'); ?>



<!-- jQuery -->
<script src="js/jquery.js"></script>
<script src="js/sora-default.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Script to Activate the Carousel -->
<script>
  $('.carousel').carousel({
        interval: 5000 //changes the speed
      })
</script>
<!-- Swiper JS -->
<script src="js/swiper.min.js"></script>

<!-- Initialize Swiper -->
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

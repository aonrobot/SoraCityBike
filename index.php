
<?php 


session_start();
$_SESSION['def_lang']=$default_l=strtoupper (substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 1));

if(!isset($_SESSION['lang_session']))
  $_SESSION['lang_session'] = 1;

$_SESSION['lang_session'] = $_SESSION['lang_session']+1;

if ($_SESSION['lang_session'] == 1) {
   $_SESSION['def_lang']=1;
}
//session_destroy();

?>

<?php include('config/config.php'); ?>
<?php include('header.php'); ?>


<?php 
if ($page!='home') {
 include('slide.php');
}
?>

<?php include($page.'.php'); ?>
<hr style="max-width:70%;">
<?php include('footer.php'); ?>

<!-- jQuery -->
<script src="components/js/jquery.js"></script>
<script src="components/js/sora-default.js"></script>
<script src="components/js/bootstrap.min.js"></script>



</body>
</html>

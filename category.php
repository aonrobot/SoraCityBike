
<?php 

session_start();

include('counter.php');

if(!isset($_SESSION['lang_session']))
 $_SESSION['lang_session'] = 1;
// session_start();
// $_SESSION['def_lang']=$default_l=strtoupper (substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 1));

// if(!isset($_SESSION['lang_session']))
//   $_SESSION['lang_session'] = 1;

// $_SESSION['lang_session'] = $_SESSION['lang_session']+1;

// if ($_SESSION['lang_session'] == 1) {
//    $_SESSION['def_lang']=1;
// }
//session_destroy();

?>

<?php include('config/config.php'); ?>

<?php


$datas = $database->select("category",["cat_id","slide_id","cat_name"],["cat_id[=]"  => $_GET['id']]);
$top_menu=$database->select("menu", ["[>]object" => ["obj_id" => "obj_id"]],"*",["parent_id[=]" => 0]);
$sub_menu=$database->select("menu", ["[>]object" => ["obj_id" => "obj_id"]],"*",["parent_id[>]" => 0]);
$lang=$database->select("language",'*');

?>


<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="components/img/favicon2.png">
  <link rel="icon" href="components/img/favicon2.png">

  <title><?php echo $datas[0]['cat_name'] ?> | Sora City Bike</title>

  <link href="components/css/bootstrap.css" rel="stylesheet">
  <link href="components/css/sora-default.css" rel="stylesheet">
  <link href="components/css/leo.css" rel="stylesheet">
  <script src="components/js/jquery.js"></script>

</head>



<body> 




<!-- ////////////////////////////////////    THIS  IS TOP MENU       ///////////////////////////////////////////////////// -->
  <div class="row row_navbar">
    <div class="col-xs-4 brand-time " align="center">
      <?php 
      echo '<span class=" pero-font uppercase time_text">'.date('D j M').'</span>';



      ?>
    </div>
    <div class="col-xs-4 col-xs-offset-4 brand-social" align="center">
      <a href="https://www.facebook.com/" target="_blank"><img class="social_icon" onmouseover="logo_mousein('icon-fb')" 
        onmouseout="logo_mouseout('icon-fb')" id="icon-fb" src="components/img/icon/icon-fb-type2.png"/></a>
        <a href="https://www.instragram.com/" target="_blank"><img class="social_icon" onmouseover="logo_mousein('icon-ig')" 
          onmouseout="logo_mouseout('icon-ig')" id="icon-ig" src="components/img/icon/icon-ig-type2.png"/></a>
          <a href="https://www.pinterest.com/" target="_blank"><img class="social_icon" onmouseover="logo_mousein('icon-pt')" 
            onmouseout="logo_mouseout('icon-pt')" id="icon-pt" src="components/img/icon/icon-pt-type2.png"/></a>
            <a href="https://www.vimeo.com/" target="_blank"><img class="social_icon" onmouseover="logo_mousein('icon-ve')" 
              onmouseout="logo_mouseout('icon-ve')" id="icon-ve" src="components/img/icon/icon-ve-type2.png"/></a>
               <?php
              
              foreach ($lang as $a) {?>

                 <a href=""><button class="lang_btn time_text bg-gray pero-font btn btn-default lowercase" id="lang_btn" onclick=<?php echo '"a('."'".$a['lang_id']."'".');"'; ?>     ><?php echo $a['lang_code']; ?></button></a>
                
              <?php
              }    
              ?>
              <script type="text/javascript">
              function a(e){
                
                 $.ajax({
                    type: 'POST',
                    url: "change_lang.php",
                    data: {
                      lang: e
                    }
                  }).done(function() {
                        
                  });
                 
              }
              </script>
            </div>
          </div>

          <div class="brand row">


            <div class="col-xs-4 col-xs-offset-4 brand-logo ">
              <a href="index.php"><img class="logo_img" src="components/img/LOGO-(with-cloud)2.png"/></a>
            </div>


          </div>
          <hr class="top_line">

          <nav class="bg-gray navbar navbar-default " role="navigation" id="stickyheader">
            <div class="bg-gray container top-menu ">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header" align="center">

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>

                </button>
                <a class="pero-font navbar-brand" href="index.php"><b>Sora City Bike</b></a>
              </div>

              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" align="center">

                <ul class="nav navbar-nav">

                  <?php foreach ($top_menu as $menu ) { 
                    echo '<li id="menu_'.$menu['menu_id'].'">';
                    if ($menu['obj_type'] == 'content') {

                      $link = "'content.php?&id=".$menu['obj_url']."'";

                    }
                    elseif ($menu['obj_type'] == 'link') {
                     $link ="'".$menu['obj_url']."'";  
                   } 
                   else {
                    $link = "";
                  }    

                  echo '<div class="dropdown-toggle bg-gray pero-bold-font btn btn-default " type="button" id="dropdownMenu1" data-hover="dropdown" data-delay="100" data-toggle="dropdown" onclick="window.location.href='.$link.'">';?>
                  <?php echo $menu['obj_name']; ?>
                  <?php if ($menu['obj_type'] == 'category') echo '<span><img class="dropdown-span" src="components/img/down-btn.png"/></span>'; ?>
                </div>
                <?php if ($menu['obj_type'] == 'category') { ?>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                  <?php
                  foreach ($sub_menu as $a ) {
                    $sub=$a['parent_id'];
                    $top=$menu['obj_id'];
                    if ($sub==$top) {

                      echo '<li role="presentation"><a role="menuitem" tabindex="-1" href="'.$a['obj_type'].'.php?id='.$a['obj_url'].'">'.$a['obj_name'].'</a></li>' ;


                    }
                  }

                  ?>
                </ul>
                <?php } ?>
              </li>
              <?php } ?>



            </ul>

          </div>
          <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
      </nav>

      <div id="stickyalias"></div>
<!-- ////////////////////////////////////    THIS  IS END OF TOPMENU       ///////////////////////////////////////////////////// -->

      <script>

        $(function(){
        // Check the initial Poistion of the Sticky Header
        var stickyHeaderTop = $('#stickyheader').offset().top;

        

        $(window).scroll(function(){
          if( $(window).scrollTop() > stickyHeaderTop ) {
            $('#stickyheader').css({position: 'fixed',width:'100%',top: '0px'});

            $('#stickyalias').css('display', 'block');
          } else {
            $('#stickyheader').css({position: 'relative', top: '0px'});
            $('#stickyalias').css('display', 'none');
          }
        });
      });

      </script>

<!-- ////////////////////////////////////    THIS  IS SLIDE       ///////////////////////////////////////////////////// -->

      

<!-- slide with zoom picture -->
<?php 
 

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

<!-- ////////////////////////////////////    THIS  IS END OF SLIDE       ///////////////////////////////////////////////////// -->

        <hr style="max-width:70%;margin-top:2em;">

<!-- ////////////////////////////////////    THIS  IS CONTENT       ///////////////////////////////////////////////////// -->


<div class="content row">
  <div class="pero-font container main_content" align="center">
        <h4 class="pero-font large-font underline   ">categorys</h4><br>
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

              ?>

              <div class="col-md-4 category-box">
                <img src=<?php echo '"'.$a[0]['cont_thumbnail'].'"';?> class="index-img"/>
                <p class="pero-font text-header"><?php echo $data["cont_title"]; ?></p>
                <p class="pero-font text-content">
                  <?php echo $data["cont_description"]; ?> 
                  <?php echo '<a href="content.php?id='.$data["cont_id"].'"><b>READ MORE</b></a>'; ?>
                </p>
              </div>

              <?php }} ?>

</div></div>


<!-- ////////////////////////////////////    THIS  IS END OF CONTENT       ///////////////////////////////////////////////////// -->


          <hr style="max-width:70%;">

          <footer>
            <div class="bg-gray container">
              <div class="row">
                <div class="pero-font col-lg-12" align="center">
                  <small>Copyright &copy; Your Website 2014</small>
                </div>
              </div>
            </div>
          </footer>

          <!-- jQuery -->



          <script src="components/js/jquery.js"></script>
          <script src="components/js/sora-default.js"></script>
          <script src="components/js/bootstrap.min.js"></script>
         
  
            <script src="components/js/bootstrap-hover-dropdown.js"></script>


        </body>
        </html>




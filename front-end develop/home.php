

<div class="content row">
 <div class="container con-content" align="center">
  <h4 class="pero-font large-font underline ">stories</h4>
  <p class="pero-font">Kinfolk is a slow lifestyle magazine that explores ways for readers to simplify their lives<br>
   cultivate community and spend more time with their friends and family.</p>
   

   <?php 
   $datas = $database->select("content_translation","*");
    ?>
   
   <?php foreach ($datas as $data ) { ?>

   
   <div class="col-md-6 category-box">
    <img src="img/slide-3.jpg" class="index-img"/>
    <p class="pero-font text-header"><?php echo $data["cont_title"]; ?></p>
    <p class="pero-font text-content">
    <?php echo $data["cont_description"]; ?> 
    <a href="">READ MORE</a>
    </p>
    </div>
   <?php } ?>


</div> 


</div>
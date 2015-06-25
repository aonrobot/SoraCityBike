

<div class="content row">
   <div class="pero-font container" align="center">
    <h4 class="pero-font large-font underline ">stories</h4>
    <p >Kinfolk is a slow lifestyle magazine that explores ways for readers to simplify their lives<br>
     cultivate community and spend more time with their friends and family.</p>
        <?php 


 $datas = $database->select("content_translation","*");
 echo $datas[0]["cont_content"];
 ?>
    
  
    
  </div>


</div>
<?php 
 $datas = $database->select("content_translation","*");
 $uri = $_SERVER['REQUEST_URI'];
 $id=$_GET["id"];
?>

<div class="content row">
	<div class="pero-font container" align="center">
		<h4 class="pero-font large-font underline "><?php echo $datas[$id]["cont_title"]; ?></h4>
		<?php 
		
		echo $datas[$id]["cont_content"];
		?>



	</div>


</div>
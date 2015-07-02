<?php
 $lang_id=1; 
 $id=$_GET["id"];
 $datas = $database->select("content_translation","*",["lang_id[=]"=>$lang_id]);
 
foreach ($datas as $data) {
	echo $data["cont_id"];
	}
		


?>

<div class="content row">
	<div class="pero-font container" align="center">
		<h4 class="pero-font large-font underline "><?php echo $datas[0]["cont_title"]; ?></h4>
		<?php 
		echo $datas[0]["cont_content"];
		?>



	</div>


</div>
<?php
 $lang_session=$_GET['lang']; 
 $id=$_GET["id"];
 $datas = $database->select("content_translation","*",["AND"=>["lang_id[=]"=>$lang_session,"cont_id[=]"=>$id]]);
?>

<div class="content row">
	<div class="pero-font container" align="center">
		<h4 class="pero-font large-font underline "><?php echo $datas[0]["cont_title"]; ?></h4>
		<?php 
		echo $datas[0]["cont_content"];
		?>
	</div>


</div>
<?php
// $lang_session=$_GET['lang']; 

 $lang_session=$_SESSION['lang_session'];
 $id=$_GET["id"];
 $datas = $database->select("content_translation","*",["AND"=>["lang_id[=]"=>$lang_session,"cont_id[=]"=>$id]]);
?>

<div class="content row">
	<div class="pero-font container main_content" align="center">
		<h4 class="pero-font large-font underline title_content"><?php echo $datas[0]["cont_title"]; ?></h4>
		<?php 
		echo $datas[0]["cont_content"];
		?>
	</div>


</div>
<?php include('config/config.php'); ?>



<?php
	$slug = $_GET["slug"];
	$lang = $_GET["lang"];

	$db_ckeck_cont = $database->count("content",["cont_slug[=]"  => $slug]);
	$db_ckeck_cat = $database->count("category",["cat_slug[=]"  =>$slug]);

	if($db_ckeck_cont==1){
		$db_cont = $database->select("content","*",["cont_slug[=]"  => $slug]);
		include('content.php');	
	}
	if($db_ckeck_cat==1){
		$db_cat = $database->select("category","*",["cat_slug[=]"  =>$slug]);
		include('category.php');
	}
?> 
<?php
	
	// Include Medoo
	include 'db_connect.php';
    
    $site_title = $database->select("site_meta","meta_value",array("meta_key" => 'site_title'));
	
	$site_title = $site_title[0];;
	
	if (isset($_GET['p'])) {
	
		$page = $_GET['p'];
		// Set $pageid to equal the value given in the URL
	
	} else {
	
		$page = 'home';
		// Set $pageid equal to 1 or the Home Page.
	
	}
	
	# Page Setup:

	

	
	# User Setup:

	
?>
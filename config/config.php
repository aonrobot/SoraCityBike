<?php
	
	// Include Medoo
	require_once 'components/medoo.min.php';
    $database = new medoo(array(
        'database_type' => 'mysql',
        'database_name' => 'sora_db',
        'server' => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'charset' => 'utf8'
    ));
    
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
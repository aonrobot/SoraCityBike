<?php
	
	// Include Medoo
	require_once '../components/medoo.min.php';
	
	// Initialize
	$database = new medoo(array(
	    'database_type' => 'mysql',
	    'database_name' => 'sora_db',
	    'server' => 'localhost',
	    'username' => 'root',
	    'password' => 'root',
	    'charset' => 'utf8'
	));

	
	$site_title = 'SORA City Bike';
	
	if (isset($_GET['p'])) {
	
		$page = $_GET['p'];
		// Set $pageid to equal the value given in the URL
	
	} else {
	
		$page = 'home';
		// Set $pageid equal to 1 or the Home Page.
	
	}
	
	# Page Setup:

	$default_l=strtoupper (substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));
	session_start();
	$_SESSION['def_lang'] = $default_l;
		if(empty($_SESSION['lang_session']))
		$_SESSION['lang_session'] = 1;


	
	# User Setup:

	
?>
<?php

    include 'db_connect.php';
	// // Include Medoo
	// require_once '../components/medoo.min.php';
// 	
	// // Initialize
	// $database = new medoo(array(
	    // 'database_type' => 'mysql',
	    // 'database_name' => 'sora_db',
	    // 'server' => 'localhost',
	    // 'username' => 'root',
	    // 'password' => 'root',
	    // 'charset' => 'utf8'
	// ));
	
	$admin_template = $database->select("site_meta","meta_value",array("meta_key" => 'admin_template'));
    
    $site_title = $database->select("site_meta","meta_value",array("meta_key" => 'site_title'));
    
    $site_path = $database->select("site_meta","meta_value",array("meta_key" => 'site_path'));

	#Template Path
	$GLOBALS['D_TEMPLATE'] = 'template/'.$admin_template[0].'/';
    
    #Variable

	// Setup File:
	error_reporting(0);
	# Database Connection:
	#include ('../config/connection.php');
	
	# Functions:
    //include('functions/modal.php'); 
	
	# Site Setup:
	$site_title = $site_title[0];
	
	if (isset($_GET['p'])) {
	
		$page = $_GET['p'];
		// Set $pageid to equal the value given in the URL
	
	} else {
	
		$page = 'dashboard';
		// Set $pageid equal to 1 or the Home Page.
	
	}
	
	# Page Setup:
	
	
	# User Setup:

	
?>
<?php
	   // Include Medoo
    require_once '../../components/medoo.min.php';
    
    // Initialize
    $database = new medoo(array(
        'database_type' => 'mysql',
        'database_name' => 'sora_db',
        'server' => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'charset' => 'utf8'
    ));
    
    
      $objcat_name = $database->select("category",array("cat_id","cat_name")); 
    
        echo json_encode($objcat_name);  
      
?>
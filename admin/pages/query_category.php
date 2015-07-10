<?php
	
	// Include Medoo
    include('../../config/db_connect.php'); 
    
    
      $objcat_name = $database->select("category",array("cat_id","cat_name")); 
    
        echo json_encode($objcat_name);  
      
?>
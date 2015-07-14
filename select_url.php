<?php

    // Include Medoo
    require_once 'components/medoo.min.php';
    
    // Initialize
    $database = new medoo(array(
        'database_type' => 'mysql',
        'database_name' => 'sora_db',
        'server' => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'charset' => 'utf8'
    ));
    
    

        
     $id = $_POST['id'];
           
     $obj_name = $database->select("slide_data","slide_data_img_url",array("slide_data_id"=>$id)); 
    
     echo json_encode($obj_name); 

    
    

?>
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
    
    
    if(!isset($_POST['a'])) $a = '';
    else $a = $_POST['a'];
    //var_dump($database->error());
    
    /////////////////////////////////////////////// MENU MANAGEMENT //////////////////////////////////////////////////////////////////
    
    if(!strcmp($a, 'addObject')){
        
        $url = $_POST['url'];
        
        if( !strcmp($_POST['type'], 'link') && strcmp($_POST['url'], '') && (strpos($_POST['url'], 'http://')===false && strpos($_POST['url'], 'https://')===false) ) $url = 'http://'.$_POST['url'];
        
        $last_obj = $database->insert("object", array(
                "obj_name" => $_POST['name'],
                "obj_url" => $url,
                "obj_type" => $_POST['type'],
           ));  
           
        $obj_name = $database->select("object",array('obj_id','obj_name','obj_url','obj_type'),array("obj_id"=>$last_obj)); 
    
        echo json_encode($obj_name); 
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    else if(!strcmp($a, 'delMenu')){
                
        $database->delete("object", array("obj_id" => $_POST['obj_id']));  
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    else if(!strcmp($a, 'updateMenuStructure')){
        
        //$database->update("content_meta", array("meta_value" => $_POST['structure']),array("meta_id" => '1'));    //Old
        
        $count_cont = $database->count("content", array("cont_name" => 'menu-structure'));
        
        $count_meta = $database->count("content_meta", array("meta_key" => 'menu'));
        
        if($count_cont == 0){
            $last_cont = $database->insert("content", array(
               "user_id" => '1',                                    //****** User Id 
               "cont_name" => 'menu-structure',
               "cont_slug" => 'menu-structure',
               "cont_status" => 'private',
               "cont_thumbnail" => 'no',
               )); 
        }
        
        if($count_meta == 0){
            
            $cont_id = $database->select("content",'id',array("cont_name" => 'menu-structure'));
            
            $cont_id = $cont_id[0];
            
            $database->insert("content_meta", array(
               "cont_id" => $cont_id,
               "meta_key" => 'menu',
               "meta_value" => $_POST['structure']
               ));  
               
        }else{
            
            $database->update("content_meta", array("meta_value" => $_POST['structure']),array("meta_key" => 'menu'));
        }
        //var_dump($database->error());            
    }
    else{
        
        $datas = json_decode($_POST['data'],true);
    
        $i = 1;
        $even = 1;
        $odd = 1;
        
        print_r($datas);
        
        $database->query("DELETE FROM menu;");
        
        foreach ($datas as $data) {
            
            if($data['depth'] == 0)continue;
            
            // echo(($data['left']+$data['right']+$data['depth']) % 2);
            // echo "<br>";
            
            if((($data['left']+$data['right']+$data['depth']) % 2) == 0){
                $odd = 1;
                $parent = $data['parent_id'];
                if($parent == null)$parent = "0";
                $database->insert("menu", array(
                    "menu_id" => $i,
                    "obj_id" => $data['item_id'],
                    "parent_id" => $parent,
                    "menu_order" => $even
                ));
                $even++;
            }
            else{
                $parent = $data['parent_id'];
                if($parent == null)$parent = "0";
                $database->insert("menu", array(
                    "menu_id" => $i,
                    "obj_id" => $data['item_id'],
                    "parent_id" => $data['parent_id'],
                    "menu_order" => $odd
                ));
                
                $odd++;
            }
    
            $i++;
        }
    }
    

?>
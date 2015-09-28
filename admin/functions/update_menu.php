<?php

    include('../../config/db_connect.php'); 
    
    
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
        
        $database->delete("menu_obj", array("obj_id" => $_POST['obj_id']));        
        $database->delete("object", array("obj_id" => $_POST['obj_id']));  
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    else if(!strcmp($a, 'updateMenuStructure')){
               
        /*$user_id = $_POST['user_id'];
        
        $count_cont = $database->count("content", array("cont_name" => 'menu-structure'));
        
        $count_meta = $database->count("content_meta", array("meta_key" => 'menu'));
        
        if($count_cont == 0){
            $last_cont = $database->insert("content", array(
               "user_id" => $user_id,                                    //****** User Id 
               "cont_name" => 'menu-structure',
               "cont_slug" => 'menu-structure',
               "cont_status" => 'private',
               "cont_type" => 'menu',
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
        //var_dump($database->error());*/
        
        //New Update Structure
        
        $menu_id = $_POST['menu_id'];

        $database->update("menu", array("menu_structure" => $_POST['structure']),array("menu_id" => $menu_id));            
    }
    else{
        
        $chk_lang = $database->count("menu", array("lang_id" => $_POST['lang']));
                
        if($chk_lang==0 && isset($_POST['lang'])){
            
            $database->insert("menu", array(
                "lang_id" => $_POST['lang']
           ));
           
           //var_dump($database->error());
           
           $head = 'Location: ../index.php?p=menu&lang='.$_POST['lang'];
           header( $head ) ;
           exit();
        }
        else{
            
            $menu_id = $_GET['menu_id'];
            
            console.log('Hello');
        
            $datas = json_decode($_POST['data'],true);
        
            $i = 1;
            $even = 1;
            $odd = 1;
            
            print_r($datas);
            
            $database->query("DELETE FROM menu_obj WHERE menu_id = '". $menu_id ."';");
            
            foreach ($datas as $data) {
                
                if($data['depth'] == 0)continue;
                
                // echo(($data['left']+$data['right']+$data['depth']) % 2);
                // echo "<br>";
                
                if((($data['left']+$data['right']+$data['depth']) % 2) == 0){
                    $odd = 1;
                    $parent = $data['parent_id'];
                    if($parent == null)$parent = "0";
                    $database->insert("menu_obj", array(
                        //"menu_obj_id" => $i,
                        "menu_id" => $menu_id,
                        "obj_id" => $data['item_id'],
                        "parent_id" => $parent,
                        "menu_order" => $even
                    ));
                    $even++;
                }
                else{
                    $parent = $data['parent_id'];
                    if($parent == null)$parent = "0";
                    $database->insert("menu_obj", array(
                        //"menu_obj_id" => $i,
                        "menu_id" => $menu_id,
                        "obj_id" => $data['item_id'],
                        "parent_id" => $data['parent_id'],
                        "menu_order" => $odd
                    ));
                    
                    $odd++;
                }
        
                $i++;
            }
            
            //Delete All Duplicate Row (menu_id, obj_id, menu_order) Why it Insert many data???
            $database->query("DELETE FROM menu_obj WHERE menu_obj_id NOT IN(SELECT MIN(menu_obj_id) FROM menu_obj GROUP BY menu_id, obj_id, menu_order)");

        }
    }
    

?>
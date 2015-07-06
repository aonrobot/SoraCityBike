<?php

    /* SQL 
    
        a = Action
        s = Sub Page
        w = what
        i = id
        l = language
	    c = column 
    
    */ 
    
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
    

    //////////////////////////////////////////////   INSERT  //////////////////////////////////////////////////

    if(!strcmp($_GET['a'], 'addContent')){
        
          $date = date('Y-m-d H:i:s');
          
        
          $last = $database->insert("content", array(
                "cont_lang_id" => $_POST['lang'],
                "cont_name" => $_POST['name'],
                "cont_name" => $_POST['name'],
                "cont_author" => $_POST['author'],
                "cont_slug" => $_POST['slug'],
                "cont_status" => $_POST['status'],
                "cont_modified" => $date,
                "cont_type" => $_POST['type']
           ));
           
           //$last = $database->max("content", "id");
           
           //Language Insert
           $database->insert("content_translation", array(
                "cont_id" => $last,
                "lang_id" => $_POST['lang'],
                "cont_title" => $_POST['title'],
                "cont_content" => $_POST['txt_content'],
                "cont_description" => $_POST['description']
           ));           
           
           //(BACKUP CODE) Get All id of Language

           //Category Insert
           $category = $_POST['category'];
           foreach ($category as $cat) {
                
               $database->insert("category_relationships", array(
               "cont_id" => $last,
               "cat_id" => $cat,
               ));  
           }
           
           header( 'Location: index.php?p=content&s=show' ) ;
           exit();
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    if(!strcmp($_GET['a'], 'addCategory')){
        
          $database->insert("category", array(
                "cat_name" => $_POST['name'],
                "cat_type" => $_POST['type'],
                "cat_slug" => $_POST['slug']
           ));
           
           
           header( 'Location: index.php?p=category' ) ;
           exit();
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    if(!strcmp($_GET['a'], 'addlang')){
        
          $database->insert("language", array(
                "lang_code" => $_POST['code'],
                "lang_name" => $_POST['name']
           ));
           
           
           header( 'Location: index.php?p=content&s=language' ) ;
           exit();
    }

    

    /////////////////////////////////////////////// UPDATE ////////////////////////////////////////////////////////////////////////
    
    if(!strcmp($_GET['a'], 'updateContent')){
        
        $chk_lang = $database->count("content_translation", array(
                    "AND" => array("cont_id" => $_POST['content_id'], "lang_id" => $_POST['lang'])
                ));
                
        if($chk_lang==0){
            
            $other_lang_content = $database->select("content_translation","*",array("cont_id" => $_POST['content_id']));
            
            $database->insert("content_translation", array(
                "cont_id" => $_POST['content_id'],
                "lang_id" => $_POST['lang'],
                "cont_title" => $other_lang_content[0]['cont_title'],
                "cont_content" => $other_lang_content[0]['cont_content'],
                "cont_description" => $other_lang_content[0]['cont_description']
           ));
        }
        else{
            $database->update("content_translation", array(
                "cont_title" => $_POST['title'],
                "cont_content" => $_POST['txt_content'],
                "cont_description" => $_POST['description']
                
            ), array(
                "AND" => array("cont_id" => $_POST['content_id'], "lang_id" => $_POST['lang'])
            ));
        }
        
        $database->update("content", array(
            "cont_name" => $_POST['name'],
            "cont_author" => $_POST['author'],
            "cont_slug" => $_POST['slug'],
            "cont_status" => $_POST['status'],
            "cont_type" => $_POST['type'],
            
        ), array("id" => $_POST['content_id']
        ));
        
        //Delete All Content In Cat Relationship
        $database->delete("category_relationships", array("cont_id" => $_POST['content_id']));
        
        //Insert New
        $category = $_POST['category'];
            foreach ($category as $cat) {
                
                $database->insert("category_relationships", array(
                "cont_id" => $_POST['content_id'],
                "cat_id" => $cat,
                ));  
            }
             
        $head = 'Location: index.php?p=content&a=edit&id='.$_POST['content_id'].'&lang='.$_POST['lang'];
        
        header( $head ) ;
        exit();
    
    }
    
    /*if(!strcmp($_GET['a'], 'updateContentInfo')){
    
        $database->update("content", array(
            "cont_name" => $_POST['name'],
            "cont_author" => $_POST['author'],
            "cont_slug" => $_POST['slug'],
            "cont_status" => $_POST['status'],
            "cont_type" => $_POST['type'],
            
        ), array("id" => $_POST['content_id']
        ));
        
        //Delete All Content In Cat Relationship
        $database->delete("category_relationships", array("cont_id" => $_POST['content_id']));
        
        //Insert New
        $category = $_POST['category'];
            foreach ($category as $cat) {
                
                $database->insert("category_relationships", array(
                "cont_id" => $_POST['content_id'],
                "cat_id" => $cat,
                ));  
            }
        
        
        $head = 'Location: index.php?p=content&a=edit&id='.$_POST['content_id'].'&lang='.$_POST['lang'];
        
        header( $head ) ;
        exit();
    
    }*/
    
    
    if(!strcmp($_GET['a'], 'editvalue')){
    	$pk= $_POST['pk'];
    	$value= $_POST['value'];
		$column = $_GET['c'];
		
        $database->update("content", array(
            $column => $value
        
        ), array("id" => $pk
        ));
    }
    
   
     if(!strcmp($_GET['a'], 'editvalue2')){
    	$pk= $_POST['pk'];
    	$value= $_POST['value'];
		
        $database->delete("category_relationships", array("cont_id" => $pk));
        
        //Insert New
    
            foreach ($value as $cat) {
                
                $database->insert("category_relationships", array(
                "cont_id" => $pk,
                "cat_id" => $cat,
                ));  
   	         }
    	}
    

    // (BACKUP CODE) UPDATE CONTENT INFO

    
    if(!strcmp($_GET['a'], 'addFav')){
        
        $cont_id = $_GET['i'];

        $database->update("category_relationships", array(
            'cont_order' => -1
        
        ), array("cont_id" => $cont_id));
        
        header( 'Location: index.php?p=category&a=edit&id='.$_GET['edit_id'] ) ;
        exit();
    }
    if(!strcmp($_GET['a'], 'delFav')){
        
        $cont_id = $_GET['i'];

        $database->update("category_relationships", array(
            'cont_order' => 0
        
        ), array("cont_id" => $cont_id));
        
        header( 'Location: index.php?p=category&a=edit&id='.$_GET['edit_id'] ) ;
        exit();
    }

    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    if(!strcmp($_GET['a'], 'addSlide')){
        
          $database->insert("slide", array(
                "slide_name" => $_POST['name'],
                "slide_type" => $_POST['type']
           ));
           
           
           header( 'Location: index.php?p=slide' ) ;
           exit();
    }


    /////////////////////////////////////////////// DELETE ////////////////////////////////////////////////////////////////////////
    
    if(!strcmp($_GET['a'], 'del')){
        
        /*
         * 
         * 1 -> Content Delete
         * 2 -> Category
         * 3 -> Language
         * 
         */
        
        switch ($_GET['w']) {
            
            case 'content':
            
                $database->delete("content_meta", array("cont_id" => $_GET['i'])); 
                $database->delete("content_translation", array("cont_id" => $_GET['i'])); 
                $database->delete("category_relationships", array("cont_id" => $_GET['i']));
                $database->delete("content", array("id" => $_GET['i']));
                
                header( 'Location: index.php?p=content&s=show' ) ;
                exit();               
                break;
                
            case 'category':
            
                $count_cont = $database->count("category_relationships", array(
                    "cat_id" => $_GET['i']
                ));
                
                if($count_cont == 0) {
                    $database->delete("category", array("cat_id" => $_GET['i']));
                    header( 'Location: index.php?p=category' ) ;
                    exit();                     
                }   
                else {
                    header( 'Location: index.php?p=error&a=delCat' ) ;
                    exit();
                }          
                break;
                
            case 'lang':
            
                $count_lang = $database->count("content_translation", array(
                    "lang_id" => $_GET['i']
                ));
                
                if($count_lang == 0) {
                    $database->delete("language", array("lang_id" => $_GET['i']));
                    header( 'Location: index.php?p=content&s=language' ) ;
                    exit();                     
                }   
                else {
                    header( 'Location: index.php?p=error&a=delLang' ) ;
                    exit();
                }          
                break;
                
            case 'slide':
                
                $slide_id = $_GET['i'];
                
                $database->delete("slide_data", array("slide_id" => $slide_id));
                $database->delete("slide", array("slide_id" => $slide_id));
                header( 'Location: index.php?p=slide' ) ;
                exit();                     
        
                break;
                                
        }
        
        
    }


    ////////////////////////////////// BACKUP CODE ZONE ///////////////////////////////////////////////////
    
        /* 
         * MENU I
         * 
        $json_out = $_GET['out'];
        $json_del = $_GET['delete'];
        
        // $obj = array("obj_id"=>'', "parent_id"=>'', "menu_order"=>'');
        
        $outputs = json2array($json_out);
        $deletes = json2array($json_del);
        
        
        
        $database->query("DELETE FROM menu;");
        
        $i = 1;
        foreach ($outputs as $output) {
            $database->insert("menu", array(
                "menu_id" => $i,
                "obj_id" => $output['obj_id'],
                "parent_id" => $output['parent_id'],
                "menu_order" => $output['menu_order']
            ));
            $i++;
        }
        
        $database->update("content_meta", array("meta_value" => $_GET['structure']),array("meta_id" => '1'));
        
        // !!!!! MUST TO DEL JUNK OBJ !!!!!!
        
        echo '[{"sucess":1}]';
        */
        
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        /*
         * UPDATE CONTENT INFO
         * 
        if(!strcmp($_GET['a'], 'updateContentInfo')){
    
        $database->update("content", array(
            "cont_name" => $_POST['name'],
            "cont_author" => $_POST['author'],
            "cont_slug" => $_POST['slug'],
            "cont_status" => $_POST['status'],
            "cont_type" => $_POST['type'],
            
        ), array("id" => $_POST['content_id']
        ));
        
        //Delete All Content In Cat Relationship
        $database->delete("category_relationships", array("cont_id" => $_POST['content_id']));
        
        //Insert New
        $category = $_POST['category'];
            foreach ($category as $cat) {
                
                $database->insert("category_relationships", array(
                "cont_id" => $_POST['content_id'],
                "cat_id" => $cat,
                ));  
            }
        
        
        $head = 'Location: index.php?p=content&a=edit&id='.$_POST['content_id'].'&lang='.$_POST['lang'];
        
        header( $head ) ;
        exit();
    
        }
        */
        
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        /*
         * Get All id of Language
         * 
        $datas = $database->select("language","lang_id");
        $lang_id = array();           
        foreach ($datas as $data) {
              array_push($lang_id,$data);                        
        }
        foreach ($lang_id as $id) {
                
              $database->insert("content_translation", array(
              "cont_id" => $last,
              "lang_id" => $id,
              "cont_title" => $_POST['title'],
              "cont_content" => $_POST['txt_content'],
              "cont_description" => $_POST['description']
              ));
                
        }
        */
        
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        /*
         * JSON2Array
         * 
        function json2array($json)
        {
            $array = json_decode($json, true);
                        
            $objs = array();
                                 
            for($i = 1 ; $i < count($array) ; $i++){
                if(isset($array[$i]['children']) === false && empty($array[$i]['children']) === true){
                    $obj = array("obj_id"=>$array[$i]['id'], "parent_id"=>"0", "menu_order"=>$i);
                    array_push($objs,$obj);
                }else{
                    $obj = array("obj_id"=>$array[$i]['id'], "parent_id"=>"0", "menu_order"=>$i);
                    array_push($objs,$obj);
                    for($j = 0 ; $j < count($array[$i]['children']) ; $j++){
                        $obj = array("obj_id"=>$array[$i]['children'][$j]['id'], "parent_id"=>$array[$i]['id'], "menu_order"=>$j+1);
                        array_push($objs,$obj);
                    }
                }
            }
            
            return $objs;
        }
         
        */
        
        /*
         * 
         * 
        
        if(!strcmp($_GET['a'], 'saveMenu')){
        
        // (BACKUP CODE) Menu I
                
        //Menu II
        $datas = json_decode($_POST['data'],true);
    
        $i = 1;
        $even = 1;
        $odd = 1;
        
        //print_r($datas);
        
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
        */
    
?>
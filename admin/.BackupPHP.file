
           //Category Insert Old
           /*$category = $_POST['category'];
           foreach ($category as $cat) {
                
               $database->insert("category_relationships", array(
               "cont_id" => $last,
               "cat_id" => $cat,
               "cont_oder" => 0
               ));  
           }*/
           
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
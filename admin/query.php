<?php

    /* SQL 
    
        a = Action
        s = Sub Page
        w = what
        i = id
        l = language
    
    */ 
    
    // Include Medoo
    require_once '../components/medoo.min.php';
    
    // Initialize
    $database = new medoo(array(
        'database_type' => 'mysql',
        'database_name' => 'sora_db',
        'server' => 'localhost',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8'
    ));


    //////////////////////////////////////////////   INSERT  //////////////////////////////////////////////////

    if(!strcmp($_GET['a'], 'addContent')){
        
          $date = date('Y-m-d H:i:s');
          
        
          $database->insert("content", array(
                "cont_lang_id" => $_POST['lang'],
                "cont_name" => $_POST['name'],
                "cont_name" => $_POST['name'],
                "cont_author" => $_POST['author'],
                "cont_slug" => $_POST['slug'],
                "cont_status" => $_POST['status'],
                "cont_modified" => $date,
                "cont_type" => $_POST['type']
           ));
           
           $last = $database->max("content", "id");
           
           //Language Insert
           $database->insert("content_translation", array(
                "cont_id" => $last,
                "lang_id" => $_POST['lang'],
                "cont_title" => $_POST['title'],
                "cont_content" => $_POST['txt_content'],
                "cont_description" => $_POST['description']
           ));           
           //Get All id of Language
           /*
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
                                
        }
        
        
    }
    
    header( 'Location: index.php' ) ;
    exit();
    
?>
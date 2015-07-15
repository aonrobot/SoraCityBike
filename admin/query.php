<?php

    /* SQL 
    
        a = Action
        s = Sub Page
        w = what
        i = id
        l = language
	    c = column 
    
    */ 
    //Include Functions
    require_once 'functions/functions.php';
    
    include('../config/db_connect.php'); 
    

    //////////////////////////////////////////////   INSERT  //////////////////////////////////////////////////

    if(!strcmp($_GET['a'], 'addContent')){
        
          $date = date('Y-m-d H:i:s');
        
          $slug = sanitize($_POST['slug']);
          
        
          $last = $database->insert("content", array(
                "user_id" => $_POST['user_id'],
                "cont_lang_id" => $_POST['lang'],
                "cont_name" => $_POST['name'],
                "cont_author" => $_POST['author'],
                "cont_slug" => $slug,
                "cont_status" => $_POST['status'],
                "cont_modified" => $date,
                "cont_type" => $_POST['type'],
                "cont_thumbnail" => $_POST['thumb']
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

           //Insert Cat
           
           $new_cats = $_POST['category'];

           foreach ($new_cats as $new_cat) {

                   $max_order = $database->max("category_relationships", "cont_order", array("cat_id" => $new_cat));    // [ordering] max order in this cat
                   if(!strcmp($max_order, ''))$max_order = 0;
                   else if(!strcmp($max_order, '-1'))$max_order = 0;
                   
                   $max_order++;
                   
                   $database->insert("category_relationships", array(
                   "cont_id" => $last,
                   "cat_id" => $new_cat,
                   "cont_order" => $max_order // [ordering]
                   )); 
           }

           header( 'Location: index.php?p=content&s=show&noti=SAddContent' ) ;
           exit();
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    if(!strcmp($_GET['a'], 'addCategory')){
        
          $database->insert("category", array(
                "cat_name" => $_POST['name'],
                "cat_type" => $_POST['type'],
                "cat_slug" => $_POST['slug']
           ));
           
           
           header( 'Location: index.php?p=category&noti=SAddCategory' ) ;
           exit();
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    if(!strcmp($_GET['a'], 'addFooter')){
        
          $last = $database->insert("content", array(
                "user_id" => $_POST['user_id'],
                "cont_name" => $_POST['title'],
                "cont_status" => 'private',
                "cont_type" => 'footer',
                "cont_thumbnail" => 'no',
                
          ));
          
          $url = $_POST['link'];
        
          if((strpos($_POST['link'], 'http://')===false && strpos($_POST['link'], 'https://')===false) ) $url = 'http://'.$_POST['link'];
          
          $database->insert("content_meta", array(
                "cont_id" => $last,
                "meta_key" => 'footer.link',
                "meta_value" => $url,
          ));
          
          $database->insert("content_meta", array(
                "cont_id" => $last,
                "meta_key" => 'footer.link_target',
                "meta_value" => $_POST['link_target'],
          ));
           
           
          header( 'Location: index.php?p=footer&noti=SAddFooter' ) ;
          exit();
    }
    
    if(!strcmp($_GET['a'], 'addlang')){
        
          $database->insert("language", array(
                "lang_code" => $_POST['code'],
                "lang_name" => $_POST['name']
           ));
           
           
           header( 'Location: index.php?p=content&s=language&noti=SAddLang' ) ;
           exit();
    }
    
    if(!strcmp($_GET['a'], 'addSlide')){
        
          $last_slide = $database->insert("slide", array(
                "slide_name" => $_POST['name'],
                "slide_type" => $_POST['type']
           ));
           
           if(!strcmp($_POST['type'], 'content')){
           
               $database->update("content", array(
                    "slide_id" => $last_slide,
               ),array(('id')=>$_POST['cont_id']));
           
           }
           if(!strcmp($_POST['type'], 'category')){
           
               $database->update("category", array(
                    "slide_id" => $last_slide,
               ),array(('cat_id')=>$_POST['cat_id']));
           
           }
           
           
           header( 'Location: index.php?p=slide&noti=SAddSlide' ) ;
           exit();
    }
    

    /////////////////////////////////////////////// UPDATE ////////////////////////////////////////////////////////////////////////
    
    if(!strcmp($_GET['a'], 'updateContent')){
        
        $cont_id = $_POST['content_id'];
        
        $chk_lang = $database->count("content_translation", array(
                    "AND" => array("cont_id" => $cont_id, "lang_id" => $_POST['lang'])
                ));
                
        if($chk_lang==0){
            
            $other_lang_content = $database->select("content_translation","*",array("cont_id" => $cont_id));
            
            $database->insert("content_translation", array(
                "cont_id" => $cont_id,
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
                "AND" => array("cont_id" => $cont_id, "lang_id" => $_POST['lang'])
            ));
        }
        
        $slug = sanitize($_POST['slug']);
        
        $database->update("content", array(
            "cont_name" => $_POST['name'],
            "cont_author" => $_POST['author'],
            "cont_slug" => $slug,
            "cont_status" => $_POST['status'],
            "cont_type" => $_POST['type'],
            "cont_thumbnail" => $_POST['thumb']
            
        ), array("id" => $cont_id
        ));
        
        //UPDATE CAT
        
        $new_cats = $_POST['category'];
        
        $old_cats = $database->select("category_relationships","*",array("cont_id" => $cont_id));
        
        $old_cats_array = array();
        foreach ($old_cats as $old_cat) {
            array_push($old_cats_array,$old_cat['cat_id']);
        }
        
  
        foreach ($old_cats as $old_cat) {
            if(!in_array($old_cat['cat_id'], $new_cats)){
                
                // [ordering]
                
                $current_cont_order = $old_cat['cont_order']; //current order = -1
                
                $new_ordering_cat = $old_cat['cat_id'];
                   
                $below_orders = $database->select("category_relationships",array("category_relationship_id","cont_order"),array(
                    "AND" => array("cat_id" => $new_ordering_cat, "cont_order[>]" => $old_cat['cont_order'])
                ));
                                     
                foreach ($below_orders as $below_order) {
                    
                    $new_order = $below_order['cont_order'];
                    $new_order--;
                    if(!strcmp($current_cont_order, '-1'))$new_order++; //current order = -1
                       
                    $database->update("category_relationships"
                       
                    , array("cont_order" => $new_order)
                      
                    , array("category_relationship_id" => $below_order['category_relationship_id']));
                    
                }
                
                // [ordering]
                
                $database->delete("category_relationships", array(
                    "AND" => array("cont_id" => $cont_id, "cat_id" => $old_cat['cat_id'])
                ));
            }
        }

        foreach ($new_cats as $new_cat) {
            
            if(!in_array($new_cat, $old_cats_array)){
                
                $max_order = $database->max("category_relationships", "cont_order", array("cat_id" => $new_cat));    // [ordering] max order in this cat
                if(!strcmp($max_order, ''))$max_order = 0;
                else if(!strcmp($max_order, '-1'))$max_order = 0;

                $max_order++;
                
                $database->insert("category_relationships", array(
                    "cont_id" => $cont_id,
                    "cat_id" => $new_cat,
                    "cont_order" => $max_order // [ordering]
                )); 
            }
        }
             
        $head = 'Location: index.php?p=content&a=edit&id='.$_POST['content_id'].'&lang='.$_POST['lang'].'&noti=SUpdateContent';
        
        header( $head ) ;
        exit();
    
    }

    // ========================= Inline Edit (By Jakkkk) ==================================== 
    
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
            
        $cont_id = $pk;
        
        $new_cats = $value;            
        
        $old_cats = $database->select("category_relationships","*",array("cont_id" => $cont_id));
        
        $old_cats_array = array();
        foreach ($old_cats as $old_cat) {
            array_push($old_cats_array,$old_cat['cat_id']);
        }
        
  
        foreach ($old_cats as $old_cat) {
            if(!in_array($old_cat['cat_id'], $new_cats)){
                
                // [ordering]
                
                $current_cont_order = $old_cat['cont_order']; //current order = -1
                
                $new_ordering_cat = $old_cat['cat_id'];
                   
                $below_orders = $database->select("category_relationships",array("category_relationship_id","cont_order"),array(
                    "AND" => array("cat_id" => $new_ordering_cat, "cont_order[>]" => $old_cat['cont_order'])
                ));
                                     
                foreach ($below_orders as $below_order) {
                    
                    $new_order = $below_order['cont_order'];
                    $new_order--;
                    if(!strcmp($current_cont_order, '-1'))$new_order++; //current order = -1
                       
                    $database->update("category_relationships"
                       
                    , array("cont_order" => $new_order)
                      
                    , array("category_relationship_id" => $below_order['category_relationship_id']));
                    
                }
                
                // [ordering]
                
                $database->delete("category_relationships", array(
                    "AND" => array("cont_id" => $cont_id, "cat_id" => $old_cat['cat_id'])
                ));
            }
        }

        foreach ($new_cats as $new_cat) {
            
            if(!in_array($new_cat, $old_cats_array)){
                
                $max_order = $database->max("category_relationships", "cont_order", array("cat_id" => $new_cat));    // [ordering] max order in this cat
                if(!strcmp($max_order, ''))$max_order = 0;
                else if(!strcmp($max_order, '-1'))$max_order = 0;

                $max_order++;
                
                $database->insert("category_relationships", array(
                    "cont_id" => $cont_id,
                    "cat_id" => $new_cat,
                    "cont_order" => $max_order // [ordering]
                )); 
            }
        }
            
    	   
    	}
    
		if(!strcmp($_GET['a'], 'editvaluelang')){
	    	$pk= $_POST['pk'];
	    	$value= $_POST['value'];
			$column = $_GET['c'];
			
	        $database->update("language", array(
	            $column => $value
	        
	        ), array("lang_id" => $pk
	        ));
	    }
		
		if(!strcmp($_GET['a'], 'editvaluecat')){
	    	$pk= $_POST['pk']; //If $colum = cont_order $pk = cont_id
	    	$value= $_POST['value'];
			$column = $_GET['c'];
			$cat_id = $_GET['cat_id'];
			
			if(!strcmp($column, 'cont_order')){
			    
                /*
                 * SUPER    ORDERING FUNCTION
                 * By       MigrateToTheMoon
                 * Dev For  SoraCityBike
                 * 
                */
                
                //pk = current (cont_id)
			    //value = new order number
			    //cat_id = current (cat_id)
			    
			    $count = $database->count("category_relationships", array("cat_id" => $cat_id));
                
                if($value > $count){
                    // Return Parameter Error
                    header('Location: index.php?p=category&a=edit&id='.$_POST['content_id'].'&noti=EPCAT01UOD');    
                    exit();
                }
                if($value < 1){
                    // Return Parameter Error
                    header('Location: index.php?p=category&a=edit&id='.$_POST['content_id'].'&noti=EPCAT01UOD');  
                    exit();
                }
			    
			    $current_cont = $database->select("category_relationships","*",array("AND" => array("cont_id" => $pk , "cat_id" => $cat_id)));
                
                if(intval($current_cont[0]['cont_order']) < $value){
                    
                    // Update Order Between 
                    $update_orders = $database->select("category_relationships",array("category_relationship_id","cont_order"),array(
                        "AND" => array("cat_id" => $cat_id,"cont_order[>=]" => intval($current_cont[0]['cont_order']), "cont_order[<=]" => $value)
                    ));
                    
                    foreach ($update_orders as $update_order) {
                                
                        $new_order = $update_order['cont_order'];
                        $new_order--;
                                           
                        $database->update("category_relationships"
                                           
                            , array("cont_order" => $new_order)
                                              
                            , array("category_relationship_id" => $update_order['category_relationship_id']));
                                
                    }
                    
                }
                else if(intval($current_cont[0]['cont_order']) > $value){
                    
                    // Update Order Between 
                    $update_orders = $database->select("category_relationships",array("category_relationship_id","cont_order"),array(
                        "AND" => array("cat_id" => $cat_id,"cont_order[<=]" => intval($current_cont[0]['cont_order']), "cont_order[>=]" => $value)
                    ));
                    
                    foreach ($update_orders as $update_order) {
                                
                        $new_order = $update_order['cont_order'];
                        $new_order++;
                                           
                        $database->update("category_relationships"
                                           
                            , array("cont_order" => $new_order)
                                              
                            , array("category_relationship_id" => $update_order['category_relationship_id']));
                                
                    }
                    
                }
                                             
                $database->update("category_relationships", array($column => $value)
                ,array("AND" => array("cont_id" => $pk, "cat_id" => $cat_id)));
			    
            }			
            else{
                $database->update("category", array($column => $value), array("cat_id" => $pk));
            }
	    }
    
	if(!strcmp($_GET['a'], 'editvalueslide')){
	    	$pk= $_POST['pk'];
	    	$value= $_POST['value'];
			$column = $_GET['c'];
			
	        $database->update("slide", array(
	            $column => $value
	        
	        ), array("slide_id" => $pk
	        ));
	    }
    
	
    // ============================================================================================= 
	
	

    // (BACKUP CODE) UPDATE CONTENT INFO

    
    if(!strcmp($_GET['a'], 'addFav')){
        
        $cont_id = $_GET['i'];
        $cat_id = $_GET['cat_id'];
        
        $current_cat = $database->select("category_relationships","*",array("AND" => array("cont_id" => $cont_id , "cat_id" => $cat_id)));
        
        // Update Below Order     
        $below_orders = $database->select("category_relationships",array("category_relationship_id","cont_order"),array(
            "AND" => array("cat_id" => $current_cat[0]['cat_id'], "cont_order[>]" => $current_cat[0]['cont_order'])
        ));
                                   
        foreach ($below_orders as $below_order) {
                        
            $new_order = $below_order['cont_order'];
            $new_order--;
            if($new_order == 0)$new_order = 1;
                               
            $database->update("category_relationships"
                               
                , array("cont_order" => $new_order)
                                  
                , array("category_relationship_id" => $below_order['category_relationship_id']));
                        
        }
        
        $database->update("category_relationships", array(
            'cont_order' => -1
        ), array("AND" => array("cont_id" => $cont_id, "cat_id" => $cat_id)));
        
        header( 'Location: index.php?p=category&a=edit&id='.$cat_id.'&noti=SAddFav') ;
        exit();
    }
    if(!strcmp($_GET['a'], 'delFav')){
        
        $cont_id = $_GET['i'];
        $cat_id = $_GET['cat_id'];
        
        $max_order = $database->max("category_relationships", "cont_order", array("cat_id" => $cat_id));    // [ordering] max order in this cat
        if(!strcmp($max_order, ''))$max_order = 0;
        else if(!strcmp($max_order, '-1'))$max_order = 0;

        $max_order++;
                
        $database->update("category_relationships", array(
            "cont_id" => $cont_id,
            "cat_id" => $cat_id,
            "cont_order" => $max_order++ // [ordering]
        ), array("AND" => array("cont_id" => $cont_id, "cat_id" => $cat_id))); 
        
        header( 'Location: index.php?p=category&a=edit&id='.$cat_id.'&noti=SDelFav' ) ;
        exit();
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    if(!strcmp($_GET['a'], 'updateSlide')){
        
          $slide_id = $_POST['slide_id'];
        
          $database->update("slide", array(
                "slide_type" => $_POST['type']
           ),array('slide_id' => $slide_id));
           
           if(!strcmp($_POST['type'], 'content')){
           
               $database->update("content", array(
                    "slide_id" => $slide_id,
               ),array(('id')=>$_POST['cont_id']));
           
           }
           if(!strcmp($_POST['type'], 'category')){
           
               $database->update("category", array(
                    "slide_id" => $slide_id,
               ),array(('cat_id')=>$_POST['cat_id']));
           
           }
           if(!strcmp($_POST['type'], 'video')){
           
               $database->update("content", array(
                    "slide_id" => '',
               ),array(('slide_id')=>$slide_id));
               
               $database->update("category", array(
                    "slide_id" => '',
               ),array(('slide_id')=>$slide_id));
           
           }
           if(!strcmp($_POST['type'], 'home')){
           
               $database->update("content", array(
                    "slide_id" => '',
               ),array(('slide_id')=>$slide_id));
               
               $database->update("category", array(
                    "slide_id" => '',
               ),array(('slide_id')=>$slide_id));
           
           }
           
           
           header( 'Location: index.php?p=slide&a=edit&id='.$slide_id.'&noti=SUpdateSlide' ) ;
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
                
                $cont_id = $_GET['i'];
                $delete_cats = $database->select("category_relationships","*", array("cont_id" => $cont_id));
 
                foreach($delete_cats as $delete_cat) {

                    $current_cont_order = $delete_cat['cont_order']; //current order = -1
                    
                    $new_ordering_cat = $delete_cat['cat_id'];
                    
                    $below_orders = $database->select("category_relationships",array("category_relationship_id","cont_order")
                    
                    ,array("AND" => array("cont_order[>]" => $delete_cat['cont_order'], "cat_id" => $new_ordering_cat)
                    
                    ));
                       
                    foreach ($below_orders as $below_order) {
                           
                        $new_order = $below_order['cont_order'];
                        $new_order--;
                        if(!strcmp($current_cont_order, '-1'))$new_order++; //current order = -1
                           
                        $database->update("category_relationships"
                           
                        , array("cont_order" => $new_order)
                           
                        , array("category_relationship_id" => $below_order['category_relationship_id']));
    
                    }

                    
                    $database->delete("category_relationships", array("cont_id" => $_GET['i']));
                     
                }

                $database->delete("content_meta", array("cont_id" => $_GET['i']));
                $database->delete("content_translation", array("cont_id" => $_GET['i']));     
                $database->delete("content", array("id" => $_GET['i']));
                
                //echo "<br><br>Delete Content<br>";
                //var_dump($database->error());

                header( 'Location: index.php?p=content&s=show&noti=SDelContent' ) ;
                exit();               
                break;
                
            case 'category':
            
                $count_cont = $database->count("category_relationships", array(
                    "cat_id" => $_GET['i']
                ));
                
                if($count_cont == 0) {
                    $database->delete("category", array("cat_id" => $_GET['i']));

                    header( 'Location: index.php?p=category&noti=SDelCategory' ) ;
                    exit();                     
                }   
                else {

                    header( 'Location: index.php?p=error&a=delCat&noti=EDelCategory' ) ;
                    exit();
                }          
                break;
                
            case 'lang':
            
                $count_lang = $database->count("content_translation", array(
                    "lang_id" => $_GET['i']
                ));
                
                if($count_lang == 0) {
                    $database->delete("language", array("lang_id" => $_GET['i']));
                    header( 'Location: index.php?p=content&s=language&noti=SDelLang' ) ;
                    exit();                     
                }   
                else {
                    header( 'Location: index.php?p=error&a=delLang&noti=EDelLang' ) ;
                    exit();
                }          
                break;
                
            case 'slide':
                
                $slide_id = $_GET['i'];
                
                $database->update("content", array(
                    "slide_id" => '0',
                ),array(('slide_id')=>$slide_id));
                
                $database->delete("content_meta", array("meta_key" => 'slide:'.$slide_id));
                $database->delete("slide_data", array("slide_id" => $slide_id));
                $database->delete("slide", array("slide_id" => $slide_id));
                
                header( 'Location: index.php?p=slide&noti=SDelSlide' ) ;
                exit();                     
        
                break;
            
            case 'footer':
                
                $database->delete("content_meta", array("cont_id" => $_GET['i']));
                $database->delete("content", array("id" => $_GET['i']));
                
                
                header( 'Location: index.php?p=footer&noti=SDelFooter' ) ;
                exit();                     
        
                break;
                                
        }
        
        
    }
    
?>
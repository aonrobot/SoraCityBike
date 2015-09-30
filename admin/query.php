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
    include("functions/resize-class.php");
    
    include('../config/db_connect.php'); 
    
    include('../config/admin_config.php');
    

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
                
           ));
           
           //Create New Thumbnail 200*200px//

           if(!strcmp($site_path[0], ''))$thumb_url = '..'.$_POST['thumb'];
           else $thumb_url = str_replace($site_path[0],"..",$_POST['thumb']);
         
           $resizeObj = new resize($thumb_url);

           $resizeObj -> resizeImage(600, 315, 'auto');
 
           $resizeObj -> saveImage('../images/thumbnail/'.$last.'-'.$slug.'-thumbnail.png', 100);     
          
           // End Create New Thumbnail 200*200px//  
           
           //Update Thumbnail To Database
           $database->update("content", array(
                "cont_thumbnail" => $site_path[0].'/images/thumbnail/'.$last.'-'.$slug.'-thumbnail.png'      
           ), array("id" => $last
           ));
           
           
           //Language Insert
           $database->insert("content_translation", array(
                "cont_id" => $last,
                "lang_id" => $_POST['lang'],
                "cont_title" => $_POST['title'],
                "cont_content" => $_POST['txt_content'],
                "cont_description" => $_POST['description']
           ));           
           

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
          $slug = sanitize($_POST['slug']);
          $last = $database->insert("category", array(
                "cat_name" => $_POST['name'],
                "cat_type" => $_POST['type'],
                "cat_slug" => $slug
           ));
           
           //Language Insert
           $database->insert("category_translation", array(
                "cat_id" => $last,
                "lang_id" => $_POST['lang'],
                "cat_title" => $_POST['title'],
           ));  
           
           
           header( 'Location: index.php?p=category&noti=SAddCategory' ) ;
           exit();
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    if(!strcmp($_GET['a'], 'addFooter')){
        
          $last = $database->insert("footer_translation", array(
                "user_id" => $_POST['user_id'],
                "cont_name" => $_POST['title'],
                "cont_status" => 'private',
                "cont_type" => 'footer',
                "cont_thumbnail" => 'no',
                
          ));
          
          $url = $_POST['link'];
        
          if((strpos($_POST['link'], 'http://')===false && strpos($_POST['link'], 'https://')===false) ) $url = 'http://'.$_POST['link'];
          
          $last = $database->insert("footer", array(
                "footer_name" => $_POST['name'],
                "footer_link" => $url,
                "footer_target" => $_POST['link_target'],
                "footer_position" => $_POST['link_position'],
                "footer_order" => $_POST['link_order'],
          ));
          
          $database->insert("footer_translation", array(
                "footer_id" => $last,
                "lang_id" => $_POST['lang'],
                "footer_title" => $_POST['title'],
          ));           
           
          header( 'Location: index.php?p=footer&noti=SAddFooter' ) ;
          exit();
    }
    
    if(!strcmp($_GET['a'], 'addlang')){
        
          $database->insert("language", array(
                "lang_code" => $_POST['code'],
                "lang_name" => $_POST['name']
           ));
           
           
           header( 'Location: index.php?p=language&noti=SAddLang' ) ;
           exit();
    }
    
    if(!strcmp($_GET['a'], 'addDefaultLang')){
        
          $count = $database->count('site_meta',array('meta_key'=>'site_default_lang'));
          if($count == 0){
              $database->insert("site_meta", array(
                    "meta_key" => 'site_default_lang',
                    "meta_value" => $_POST['lang']
              ));
           }else{
              $database->update("site_meta", array(
                    "meta_value" => $_POST['lang']
              ),array("meta_key" => 'site_default_lang'));
           }
           
           header( 'Location: index.php?p=language&noti=SSetLang' ) ;
           exit();
    }
    
    if(!strcmp($_GET['a'], 'addSlide')){
        
          $last_slide = $database->insert("slide", array(
                "slide_name" => $_POST['name'],
                "slide_type" => $_POST['type'],
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
           
           //Slide Structure Insert
           $last_slide_structure = $database->insert("slide_structure",array(
                "slide_structure" => NULL,                    
           ));
           
           //Language Insert
           $database->insert("slide_data", array(
                "slide_id" => $last_slide,
                "lang_id" => $_POST['lang'],
                "slide_structure_id" => $last_slide_structure,
           ));  
           
           
           header( 'Location: index.php?p=slide&noti=SAddSlide' ) ;
           exit();
    }
    

    /////////////////////////////////////////////// UPDATE ////////////////////////////////////////////////////////////////////////
    
    if(!strcmp($_GET['a'], 'updateContent')){
        
        $date = date('Y-m-d H:i:s');
        
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
        
        // Update New Thumbnail 200*200px //
        
        $old_img_name = $database->select('content','cont_thumbnail',array("id" => $cont_id));
        $old_img_name = $old_img_name[0];

        if(!strcmp($site_path[0], NULL))$old_img_name = '..'.$old_img_name;
        else $old_img_name = str_replace($site_path[0],"..",$old_img_name);

        if(!strcmp($site_path[0], NULL))$thumb_url = '..'.$_POST['thumb'];
        else $thumb_url = str_replace($site_path[0],"..",$_POST['thumb']); 

        $resize_img_name = '../images/thumbnail/'.$cont_id.'-'.$slug.'-thumbnail.png'; 
         
        $resizeObj = new resize($thumb_url);

        $resizeObj -> resizeImage(600, 315, 'auto');
 
        $resizeObj -> saveImage($resize_img_name, 100);
        
        if(strcmp($resize_img_name, $old_img_name))
        {
            $files = glob($old_img_name); // get all file names
            foreach($files as $file){
                if(is_file($file)){
                    unlink($file);
                }
            }
        }    
          
        // End Update New Thumbnail 200*200px //
        
        $database->update("content", array(
            "cont_name" => $_POST['name'],
            "cont_author" => $_POST['author'],
            "cont_slug" => $slug,
            "cont_status" => $_POST['status'],
            "cont_modified" => $date,
            "cont_type" => $_POST['type'],
            "cont_thumbnail" => $site_path[0].'/images/thumbnail/'.$cont_id.'-'.$slug.'-thumbnail.png'
            
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

    if(!strcmp($_GET['a'], 'updateCategory')){
        
        $cat_id = $_POST['cat_id'];
        
        $chk_lang = $database->count("category_translation", array(
                    "AND" => array("cat_id" => $cat_id, "lang_id" => $_POST['lang'])
                ));
                
        if($chk_lang==0){
            
            $other_lang_cat = $database->select("category_translation","*",array("cat_id" => $cat_id));
            
            $database->insert("category_translation", array(
                "cat_id" => $cat_id,
                "lang_id" => $_POST['lang'],
                "cat_title" => $other_lang_cat[0]['cat_title'],
           ));
        }
        else{
            $database->update("category_translation", array(
                "cat_title" => $_POST['title'],
                
            ), array(
                "AND" => array("cat_id" => $cat_id, "lang_id" => $_POST['lang'])
            ));
        }
        
        $head = 'Location: index.php?p=category&a=edit&id='.$cat_id.'&lang='.$_POST['lang'].'&noti=SUpdateCategory';
        
        header( $head ) ;
        exit();
        
    }

    if(!strcmp($_GET['a'], 'updateFooter')){
        
        $footer_id = $_POST['footer_id'];
        
        $chk_lang = $database->count("footer_translation", array(
                    "AND" => array("footer_id" => $footer_id, "lang_id" => $_POST['lang'])
                ));
                
        if($chk_lang==0){
            
            $other_lang_footer = $database->select("footer_translation","*",array("footer_id" => $footer_id));

            $database->insert("footer_translation", array(
                "footer_id" => $footer_id,
                "lang_id" => $_POST['lang'],
                "footer_title" => $other_lang_footer[0]['footer_title'],
            ));

        }
        else{
            $database->update("footer_translation", array(
                "footer_title" => $_POST['title'],
                
            ), array(
                "AND" => array("footer_id" => $footer_id, "lang_id" => $_POST['lang'])
            ));
            
            $url = $_POST['link'];
        
            if((strpos($_POST['link'], 'http://')===false && strpos($_POST['link'], 'https://')===false) ) $url = 'http://'.$_POST['link'];
              
            $last = $database->update("footer", array(
                  "footer_name" => $_POST['name'],
                  "footer_link" => $url,
                  "footer_target" => $_POST['link_target'],
                  "footer_position" => $_POST['link_position'],
                  "footer_order" => $_POST['link_order'],
            ), array(
                "AND" => array("footer_id" => $footer_id)
            ));
        }
        
        $head = 'Location: index.php?p=footer&a=edit&id='.$footer_id.'&lang='.$_POST['lang'].'&noti=SUpdateFooter';
        
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
	if(!strcmp($_GET['a'], 'editvaluefooter')){
    	$pk= $_POST['pk'];
    	$value= $_POST['value'];
		$column = $_GET['c'];

        $database->update("footer", array(
            $column => $value
        
        ), array("footer_id" => $pk
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
            else if(!strcmp($column, 'cat_slug')){
                $value_slug = sanitize($value);
                $database->update("category", array($column => $value_slug), array("cat_id" => $pk));
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
        
          $chk_lang = $database->count("slide_data", array(
                      "AND" => array("slide_id" => $slide_id, "lang_id" => $_POST['lang'])
                  ));
                
          if($chk_lang==0){
            
              $other_lang_slide = $database->select("slide_data","*",array("slide_id" => $slide_id));
              
              //Slide Structure Insert
              $last_slide_structure = $database->insert("slide_structure",array(
                   "slide_structure" => NULL,                    
              ));
            
              $database->insert("slide_data", array(
                  "slide_id" => $slide_id,
                  "lang_id" => $_POST['lang'],
                  "slide_structure_id" => $last_slide_structure,
                  "slide_data_name" => $other_lang_slide[0]['slide_data_name'],
                  "slide_data_img_url" => $other_lang_slide[0]['slide_data_img_url'],
                  "slide_data_content" => $other_lang_slide[0]['slide_data_content'],
                  "slide_data_img_link" => $other_lang_slide[0]['slide_data_img_link'],
                  "slide_data_content_link" => $other_lang_slide[0]['slide_data_content_link']
                ));
          }
          
          else{
        
              $database->update("slide", array(
                    "slide_type" => $_POST['type']
               ),array('slide_id' => $slide_id));
               
               if(!strcmp($_POST['type'], 'content')){
                   
                   //Clear Slide In Other Content and Cat
                   $database->update("content", array(
                        "slide_id" => NULL,
                   ),array(('slide_id')=>$slide_id));
                   $database->update("category", array(
                        "slide_id" => NULL,
                   ),array(('slide_id')=>$slide_id));
                   //
               
                   $database->update("content", array(
                        "slide_id" => $slide_id,
                   ),array(('id')=>$_POST['cont_id']));
               
               }
               if(!strcmp($_POST['type'], 'category')){
                   
                   //Clear Slide In Other Content and Cat
                   $database->update("content", array(
                        "slide_id" => NULL,
                   ),array(('slide_id')=>$slide_id));
                   $database->update("category", array(
                        "slide_id" => NULL,
                   ),array(('slide_id')=>$slide_id));
                   //
               
                   $database->update("category", array(
                        "slide_id" => $slide_id,
                   ),array(('cat_id')=>$_POST['cat_id']));
               
               }
               if(!strcmp($_POST['type'], 'video')){
                   
                   //Clear Slide In Other Content and Cat
                   $database->update("content", array(
                        "slide_id" => NULL,
                   ),array(('slide_id')=>$slide_id));
                   $database->update("category", array(
                        "slide_id" => NULL,
                   ),array(('slide_id')=>$slide_id));
                   //
               
                   $database->update("content", array(
                        "slide_id" => '',
                   ),array(('slide_id')=>$slide_id));
                   
                   $database->update("category", array(
                        "slide_id" => '',
                   ),array(('slide_id')=>$slide_id));
               
               }
               if(!strcmp($_POST['type'], 'home')){
                   
                   //Clear Slide In Other Content and Cat
                   $database->update("content", array(
                        "slide_id" => NULL,
                   ),array(('slide_id')=>$slide_id));
                   $database->update("category", array(
                        "slide_id" => NULL,
                   ),array(('slide_id')=>$slide_id));
                   //
                   
                   $database->update("content", array(
                        "slide_id" => '',
                   ),array(('slide_id')=>$slide_id));
                   
                   $database->update("category", array(
                        "slide_id" => '',
                   ),array(('slide_id')=>$slide_id));
               
               }
           }  
           
           header( 'Location: index.php?p=slide&a=edit&id='.$slide_id.'&lang='.$_POST['lang'].'&noti=SUpdateSlide' ) ;
           exit();
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    if(!strcmp($_GET['a'], 'updateUserEmail')){
        
          $user_id = $_POST['user_id'];
          $email = $_POST['newEmail'];
        
          $database->update("users", array(
                "email" => $email
           ),array('id' => $user_id));          
           
           header( 'Location: index.php?p=userInfo&noti=SUpdateUserEmail' ) ;
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

                //Del Thumbnail
                $files = glob('../images/thumbnail/'.$cont_id.'-*.png'); // get all file names
                foreach($files as $file){
                  if(is_file($file)) unlink($file);
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
                
                $database->delete("category_translation", array("cat_id" => $_GET['i']));   
            
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
                    header( 'Location: index.php?p=language&noti=SDelLang' ) ;
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
                    "slide_id" => NULL,
                ),array(('slide_id')=>$slide_id));
                
                $database->update("category", array(
                    "slide_id" => NULL,
                ),array(('slide_id')=>$slide_id));
                
                $structure_ids = $database->select("slide_data","slide_structure_id",array("slide_id" => $slide_id));
                
                $database->delete("slide_data", array("slide_id" => $slide_id));
                
                foreach ($structure_ids as $structure_id) {
                    $database->delete("slide_structure", array("slide_structure_id" => $structure_id));
                }
                
                $database->delete("slide", array("slide_id" => $slide_id));
                
                header( 'Location: index.php?p=slide&noti=SDelSlide' ) ;
                exit();                     
        
                break;
            
            case 'footer':
                
                $database->delete("footer_translation", array("footer_id" => $_GET['i']));
                $database->delete("footer", array("footer_id" => $_GET['i']));
                
                
                header( 'Location: index.php?p=footer&noti=SDelFooter' ) ;
                exit();                     
        
                break;
                
            case 'user':
            
                $count_content = $database->count("content", array(
                    "user_id" => $_GET['i']
                ));
                

                if($count_content == 0) {
                    $database->delete("users", array("id" => $_GET['i']));
                    header( 'Location: index.php?p=manUser' ) ;
                    exit();                   
                } 
                else{
                    header( 'Location: index.php?p=error&a=delUser&noti=EDelUser' ) ;
                    exit(); 
                }
                                   
        
                break;
                                
        }
        
        
    }
    
?>
<?php
    
    include('../../config/db_connect.php');   
    

    //var_dump($database->error());
    
    /////////////////////////////////////////////// Add In Page //////////////////////////////////////////////////////////////////
    
    if(!isset($_POST['a'])) $a = '';
    else $a = $_POST['a'];
    
    if(!strcmp($a, 'addCategoryInContent')){
        
        $last_cat_id = $database->insert("category", array(
             "cat_name" => $_POST['name'],
             "cat_type" => $_POST['type'],
             "cat_slug" => $_POST['slug']
        ));
           
        $cat = $database->select("category",array('cat_id','cat_name'),array("cat_id"=>$last_cat_id)); 
        
        echo json_encode($cat);
    }
    
    //////////////////////////////////////////////  Multi Action /////////////////////////////////////////////////////////////////
    
    if(!strcmp($_POST['a'], 'multiActionCont')){
        
        switch ($_POST['action']) {
            
            case 'delete':
                
                $ids = $_POST['checkItem'];
                
                foreach ($ids as $id) {
                
                //----------------- Edit HERE ------------------------------------------------------
                    
                    $cont_id = $id;
                    
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
    
                        
                        $database->delete("category_relationships", array("cont_id" => $cont_id));
                         
                    }
    
                    $database->delete("content_meta", array("cont_id" => $cont_id));
                    $database->delete("content_translation", array("cont_id" => $cont_id));     
                    $database->delete("content", array("id" => $cont_id));
                    
                //----------------- ./Edit HERE -----------------------------------------------------
                            
                }
                
            break;
        } 
        
    }
    
    
    if(!strcmp($a, 'selectSitePath')){
        
        $site_path = $database->select("site_meta","meta_value",array("meta_key" => 'site_path')); 
        
        echo $site_path[0];
    }

?>
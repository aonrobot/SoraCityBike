<?php
    
    include('../../config/db_connect.php');   
    

    //var_dump($database->error());
    
    /////////////////////////////////////////////// MENU MANAGEMENT //////////////////////////////////////////////////////////////////
    
    if(!isset($_POST['a'])) $a = '';
    else $a = $_POST['a'];
    
    if(!strcmp($a, 'addImg')){
        
        $img_link = $_POST['img_link'];
        
        $content_link = $_POST['content_link'];   
        
        $last_img = $database->insert("slide_data", array(
                "slide_id" => $_POST['slide_id'],
                "lang_id" => $_POST['lang_id'],
                "slide_structure_id" => $_POST['structure_id'],
                "slide_data_name" => $_POST['img_name'],
                "slide_data_img_url" => $_POST['img_url'],
                "slide_data_img_link" => $img_link,
                "slide_data_content" => $_POST['content'],
                "slide_data_content_link" => $content_link,
           ));  
           
        
           
        $img = $database->select("slide_data",array('slide_data_id','slide_data_name','slide_data_img_url'
        
        ,'slide_data_img_link','slide_data_content','slide_data_content_link'),array("slide_data_id"=>$last_img));
    
        echo json_encode($img); 
    }
    
    else if(!strcmp($a, 'addVideo')){
        
        $str_url = $_POST['img_url'];
        
        if(strpos($str_url,'https://vimeo.com/') !== false){
        
            $str_url = explode("https://vimeo.com/",$str_url);
            $video_url = "http://player.vimeo.com/video/".$str_url[1]."?title=0&amp;byline=0&amp;portrait=0&amp;color=6fde9f";
                    
            $last_img = $database->insert("slide_data", array(
                    "slide_id" => $_POST['slide_id'],
                    "lang_id" => $_POST['lang_id'],
                    "slide_structure_id" => $_POST['structure_id'],
                    "slide_data_name" => $_POST['img_name'],
                    "slide_data_img_url" => $video_url,
               ));  
               
            
               
            $img = $database->select("slide_data",array('slide_data_id','slide_data_name','slide_data_img_url')
                                    ,array("slide_data_id"=>$last_img)); 
        
            echo json_encode($img); 
        }
    }
    
    else if(!strcmp($a, 'updateImgName')){
        
        $slide_data_id = $_POST['slide_data_id'];
        
        $new_img_name = $_POST['update_img_name'];       
        
        $last_img = $database->update("slide_data", array(
        
                "slide_data_name" => $new_img_name,

           ),array("AND" => array("slide_data_id" => $slide_data_id , "lang_id" => $_POST['lang_id'])));  
           
           
        $img = $database->select("slide_data",array('slide_data_id','slide_data_name','slide_data_img_url'
        
        ,'slide_data_img_link','slide_data_content','slide_data_content_link'),array("slide_data_id"=>$slide_data_id)); 
    
        echo json_encode($img); 
    }
    
    else if(!strcmp($a, 'updateImage')){
        
        $slide_data_id = $_POST['slide_data_id'];
        
        $new_img_url = $_POST['update_img_url'];
        
        $new_img_link = $_POST['update_img_link'];        
        
        $last_img = $database->update("slide_data", array(
        
                "slide_data_img_url" => $new_img_url,
                "slide_data_img_link" => $new_img_link,

           ),array("AND" => array("slide_data_id" => $slide_data_id , "lang_id" => $_POST['lang_id'])));  
           
        
           
        $img = $database->select("slide_data",array('slide_data_id','slide_data_name','slide_data_img_url'
        
        ,'slide_data_img_link','slide_data_content','slide_data_content_link'),array("slide_data_id"=>$slide_data_id)); 
    
        echo json_encode($img); 
    }

    else if(!strcmp($a, 'updateContent')){
        
        $slide_data_id = $_POST['slide_data_id'];
        
        $new_content = $_POST['update_content'];
        
        $new_content_link = $_POST['update_content_link'];        
        
        $last_img = $database->update("slide_data", array(
        
                "slide_data_content" => $new_content,
                "slide_data_content_link" => $new_content_link,

           ),array("AND" => array("slide_data_id" => $slide_data_id , "lang_id" => $_POST['lang_id'])));  
           
        
           
        $img = $database->select("slide_data",array('slide_data_id','slide_data_name','slide_data_img_url'
        
        ,'slide_data_img_link','slide_data_content','slide_data_content_link'),array("slide_data_id"=>$slide_data_id)); 
    
        echo json_encode($img); 
    }
    
    else if(!strcmp($a, 'delImgData')){
        
        $slide_data_id = $_POST['slide_data_id'];
                
		$slide_data_id = $_POST['slide_data_id'];		
        
		$database->delete("slide_data", array("slide_data_id" => $slide_data_id ));
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    else if(!strcmp($a, 'updateImageStructure')){
        
        //$slide_id = $_POST['slide_id'];

        $database->update("slide_structure", array("slide_structure" => $_POST['structure']), array("slide_structure_id" => $_POST['structure_id']));


        //var_dump($database->error());            
    }
    else{
        
        $datas = json_decode($_POST['data'],true);
        $data_sort = array();
        
        foreach ($datas as $data) {
            $data_sort[$data['item_id']] = $data['left']+$data['right'];
        }
        
        unset($data_sort['']);
        
        asort($data_sort);
        
        $value_datas = $data_sort;
        $value_ids = array_flip($data_sort);        
        
        $i = 1;
        foreach ($value_ids as $value_id) {
            $database->update("slide_data", array("slide_data_order" => $i),array("slide_data_id" => $value_id));
            $i++;
        }
        
    }
    

?>
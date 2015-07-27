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
    
    else if(!strcmp($a, 'updateImgName')){
        
        $slide_data_id = $_POST['slide_data_id'];
        
        $new_img_name = $_POST['update_img_name'];       
        
        $last_img = $database->update("slide_data", array(
        
                "slide_data_name" => $new_img_name,

           ),array("slide_data_id" => $slide_data_id));  
           
        
           
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

           ),array("slide_data_id" => $slide_data_id));  
           
        
           
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

           ),array("slide_data_id" => $slide_data_id));  
           
        
           
        $img = $database->select("slide_data",array('slide_data_id','slide_data_name','slide_data_img_url'
        
        ,'slide_data_img_link','slide_data_content','slide_data_content_link'),array("slide_data_id"=>$slide_data_id)); 
    
        echo json_encode($img); 
    }
    
    else if(!strcmp($a, 'addVideo')){
        
        $str_url = $_POST['img_url'];
        
        if(strpos($str_url,'https://vimeo.com/') !== false){
        
            $str_url = explode("https://vimeo.com/",$str_url);
            $video_url = "http://player.vimeo.com/video/".$str_url[1]."?title=0&amp;byline=0&amp;portrait=0&amp;color=6fde9f";
                    
            $last_img = $database->insert("slide_data", array(
                    "slide_id" => $_POST['slide_id'],
                    "slide_data_name" => $_POST['img_name'],
                    "slide_data_img_url" => $video_url,
               ));  
               
            
               
            $img = $database->select("slide_data",array('slide_data_id','slide_data_name','slide_data_img_url')
                                    ,array("slide_data_id"=>$last_img)); 
        
            echo json_encode($img); 
        }
    }
    
    else if(!strcmp($a, 'delImgData')){
                
        $database->delete("slide_data", array("slide_data_id" => $_POST['slide_data_id']));  
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    else if(!strcmp($a, 'updateImageStructure')){
        
        $user_id = $_POST['user_id'];
        
        $count_cont = $database->count("content", array("cont_name" => 'slide-structure'));
        
        $count_meta = $database->count("content_meta", array("meta_key" => 'slide:'.$_POST['slide_id']));
        
        if($count_cont == 0){
            $last_cont = $database->insert("content", array(
               "user_id" => $user_id,                                   //****** User Id 
               "cont_name" => 'slide-structure',
               "cont_slug" => 'slide-structure',
               "cont_status" => 'private',
               "cont_thumbnail" => 'no',
               )); 
        }
        
        if($count_meta == 0){
            
            $cont_id = $database->select("content",'id',array("cont_name" => 'slide-structure'));
            
            $database->insert("content_meta", array(
               "cont_id" => $cont_id[0],
               "meta_key" => 'slide:'.$_POST['slide_id'],
               "meta_value" => $_POST['structure']
               )); 
               
        }else{
            
            $database->update("content_meta", array("meta_value" => $_POST['structure']),array("meta_key" => 'slide:'.$_POST['slide_id']));
        }

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
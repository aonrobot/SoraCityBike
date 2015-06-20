<!-- SQL --> 

<?php

    if(!strcmp($_GET['a'], 'addContent')){
        
          $date = date('Y-m-d H:i:s');
          $database->insert("content", array(
                "user_id" => "1",
                "cont_name" => $_POST['name'],
                "cont_author" => $_POST['author'],
                "cont_slug" => $_POST['slug'],
                "cont_status" => $_POST['status'],
                "cont_modified" => $date,
                "cont_type" => $_POST['type'],
           ));
           
           $last = $database->max("content", "id");
           $database->insert("content_translation", array(
                "cont_id" => $last,
                "lang_id" => $_POST['lang'],
                "cont_title" => $_POST['title'],
                "cont_content" => $_POST['txt_content'],
           ));
           
           header( 'Location: http://127.0.0.1/SoraCityBike/admin/index.php?p=content&a=list' ) ;
    }
    
?>
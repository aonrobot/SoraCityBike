<?php

    // Include Medoo
    require_once '../../components/medoo.min.php';
    
    // Initialize
    $database = new medoo(array(
        'database_type' => 'mysql',
        'database_name' => 'sora_db',
        'server' => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'charset' => 'utf8'
    ));
    
    $datas = json_decode($_POST['data'],true);
    
    $i = 1;
    $even = 1;
    $odd = 1;
    
    print_r($datas);
    
    $database->query("DELETE FROM menu;");
    
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
            $parent = $data['parent_id'];
            if($parent == null)$parent = "0";
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

    //var_dump($database->error());
    

?>
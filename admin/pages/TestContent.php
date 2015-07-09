<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><i class="fa fa-terminal fa-1x"></i> Test Content</h1>
				<div class="panel-heading">
					<?php
							$datas = $database->select("user", "*");
                            //echo var_dump($datas);
                            echo '<pre>'; print_r($datas); echo '</pre>';
                            //echo $results['datas'][1]['username'];
                            //echo $datas[0]['password'];
                            foreach ($datas as $data) {
                                echo $data['create_time']; 
                                echo "<br>";
                            } 
                            $count = $database->count("language");
                            echo 'Number of langiage = '.$count;
					?>
                	<h3><?php echo $_GET['p']; ?></h3>
                	<h4><?php echo 'Parameter -> '.$_POST['txt_content']; ?></h4>
                	
                	<?php
                	           $string = "https://vimeo.com/113560451";
                               $string = explode("https://vimeo.com/",$string);
                               echo $string[1];
                               
                               echo "<br><br>========================= ordering ========================<br><br>";
                               $max_oder = $database->max("category_relationships", "cont_order", array("cat_id" => 2));
                               if(!strcmp($max_oder, '')) echo "Not Have Content";
                               else echo $max_oder;
                               
                               // echo '<h2>'.var_dump($_POST['category']).'</h2>';
//                                
                               // $news = $_POST['category'];
                               // $olds = $database->select("category_relationships","*",array("cont_id" => 91));
                               // $old_cat = array();
                               // foreach ($olds as $old) {
                                   // array_push($old_cat,$old['cat_id']);
                               // }
                               // var_dump($old_cat);
                               // foreach ($news as $new) {
                                   // echo $new;
                                   // if(!in_array($new, $old_cat)){
                                   // echo 'Have New In Old';
                                       // }
                               // }
                               
                               echo "<br><br>========================= ordering update ========================<br><br>";
                               
                               $current_cont = $database->select("category_relationships","*",array("AND" => array("cont_id" => 88 , "cat_id" => 3)));
                               
                               $update_orders = $database->select("category_relationships",array("category_relationship_id","cont_order"),array(
                                    "AND" => array("cat_id" => 3,"cont_order[<=]" => intval($current_cont[0]['cont_order']), "cont_order[>=]" => 2)
                               ));
                               
                               echo $current_cont[0]['cont_order'];
                               
                               //echo gettype(7);
                               echo "<pre>";
                               var_dump($update_orders);
                               echo "</pre>";
                               
                               if(intval($current_cont[0]['cont_order']) > 2) echo "Yess";
                	       
                	?>
                </div>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->


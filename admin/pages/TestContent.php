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


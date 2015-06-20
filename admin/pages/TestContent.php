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
                </div>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->


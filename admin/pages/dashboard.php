<?php

    $counter_name = "../counter.txt";
    
    // Check if a text file exists. If not create one and initialize it to zero.
    if (!file_exists($counter_name)) {
      $f = fopen($counter_name, "w");
      fwrite($f,"0");
      fclose($f);
    }
    
    // Read the current value of our counter file
    $f = fopen($counter_name,"r");
    $counterVal = fread($f, filesize($counter_name));
    fclose($f);
   
    

?>

<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
			    <?php $details = \Fr\LS::getUser();?>
				<h1 class="page-header"><i class="fa fa-bicycle fa-1x"></i> Hi, <?php echo $details['name'];?> :)</h1>
				<p>You registered on this website <strong><?php echo \Fr\LS::joinedSince(); ?></strong> ago.</p>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<?php
		  
		      $count_cat = $database->count("category");
              $count_cont = $database->count("content",array('cont_type'=>'content'));
              $count_lang = $database->count("language");
              $count_slide = $database->count("slide");
		
		?>
		<!-- /.row -->
		<div class="row">
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-cubes fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">
									<?php echo $count_cat;?>
								</div>
								<div>
									Category
								</div>
							</div>
						</div>
					</div>
					<a href="index.php?p=category">
					<div class="panel-footer">
						<span class="pull-left">View Details</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div> </a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-green">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-book fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">
									<?php echo $count_cont;?>
								</div>
								<div>
									Content
								</div>
							</div>
						</div>
					</div>
					<a href="index.php?p=content&s=show">
					<div class="panel-footer">
						<span class="pull-left">View Details</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div> </a>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-yellow">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-sliders fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">
									<?php echo $count_slide;?>
								</div>
								<div>
									Slide
								</div>
							</div>
						</div>
					</div>
					<a href="index.php?p=slide">
					<div class="panel-footer">
						<span class="pull-left">View Details</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div> </a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-red">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-language fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">
									<?php echo $count_lang;?>
								</div>
								<div>
									Language
								</div>
							</div>
						</div>
					</div>
					<a href="index.php?p=content&s=language">
					<div class="panel-footer">
						<span class="pull-left">View Details</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div> </a>
				</div>
			</div>
		</div>
		
		<div class="row">
		    <div class="col-lg-12">
                <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Visitor
                            <div class="pull-left">
                                
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <p>You have visitor on this website <h2><strong><?php  echo $counterVal; ?></strong></h2> persons.</p>
                        </div>
                        <!-- /.panel-body -->
                    </div>		        
                
            </div>
		</div>
		
	</div>
	<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->


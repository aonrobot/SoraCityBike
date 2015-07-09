<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
			    <?php if(!strcmp($_GET['a'], 'delCat')){?>
    				<h1 class="page-header text-warning"><i class="text-danger fa fa-exclamation-triangle fa-2x"></i> Error Can't Delete Category</h1>
    				<h3>Please Delete All Content In This Category First !!!</h3><br>
    				<a href="index.php?p=content&s=show" class="btn btn-danger">Go To Content List</a>
    			<?php };?>
    			
    			<?php if(!strcmp($_GET['a'], 'delLang')){?>
                    <h1 class="page-header text-warning"><i class="text-danger fa fa-exclamation-triangle fa-2x"></i> Error Can't Delete Language</h1>
                    <h3>Please Delete All Content In This Language First !!!</h3><br>
                    <a href="index.php?p=content&s=show" class="btn btn-danger">Go To Content List</a>
                <?php };?>
                
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php require_once 'functions/noti.php';?>
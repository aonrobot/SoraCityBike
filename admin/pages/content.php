<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<!-- Start Content -->				
				
				<h1 class="page-header"><i class="fa fa-book fa-1x"></i> Content Management</h1>
				
				<div class="panel panel-default">
                        <div class="panel-heading">
                            Basic Form Elements
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" role="form" action="index.php?p=TestContent">
                                    	
                                        <div class="form-group">
                                            <label>Tilte</label>
                                            <input name="title" class="form-control" placeholder="Enter Title Name">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Author</label>
                                            <input name="author" class="form-control" placeholder="Enter Author Name">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Slug</label>
                                            <input name="slug" class="form-control" placeholder="Enter Slug Name">
                                        </div>


                                        <div class="form-group">
                                            <label>Content</label>
                                            
                                            <div id="mycanvas">
											    <div class="row">
											        <div class="col-md-6"><p>Content</p></div>
											        <div class="col-md-6"><p>Content</p></div>
											    </div>
											</div>
											
                                        </div>
                                                      
                   
                                        <button type="submit" class="btn btn-default">Submit Button</button>
                                        <button type="reset" class="btn btn-default">Reset Button</button>
                                    </form>
                                </div>
                                <!-- /.col-lg-12 (nested) -->
                               
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
				
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<script> 
    $(document).ready(function(){
        $("#mycanvas").gridmanager();
        
    });
    
    $( "#save_content" ).click(function() {
	  alert( "Handler for .click() called." );
	});
	
</script> 


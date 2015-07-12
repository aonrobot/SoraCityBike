
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<!-- Start Content -->

				<?php $users = \Fr\LS::getUser();?>
				    
				<h1 class="page-header"><i class="fa fa-book fa-1x"></i> Footer Management</h1>
				
				<div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Create New Footer</b>
                        </div>
                        <div class="panel-body">

                                    <form method="post" role="form" action="query.php?a=addFooter" enctype="multipart/form-data">
                
                                                        <div class="col-lg-4 form-group">
                                                            <label>Title</label>
                                                            <input name="title" class="form-control" placeholder="Enter Content Name">
                                                        </div>
                
                                                        <div class="col-lg-4 form-group">
                                                            <label>Link</label>
                                                            <input name="link" class="form-control" placeholder="Enter Slug Name">
                                                        </div>
                
                                                        <div class="col-lg-4 form-group">
                                                            <label>Link Target</label>
                                                            <select name="link_target" class="form-control">
                                                                <option value="_blank">New window</option>
                                                                <option value="_self">Same frame as it was clicked</option>
                                                                <option value="_parent">Parent frameset</option>
                                                                <option value="_top">Full body of the window</option>
                                                            </select>
                                                        </div>
                
                                    
                                        <input name="user_id" type="hidden" value="<?php echo $users['id'];?>">
                                        <button type="submit" class="btn btn-primary save_btn">Create Footer</button>
                
                                    </form>
                               
                       </div>
                      <!-- /.panel-body -->
                </div>

                <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>All Footer</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Link</th>
                                            <th>Link Target</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                            $datas = $database->select("content"
                                            
                                            , array("[<]content_meta" => array("id" => "cont_id"),)
                                            
                                            ,array('id','cont_name','cont_id','meta_key','meta_value')
                                            
                                            ,array('cont_type' => 'footer')
                                            
                                            );
                                            
                                            print_r($datas);
                                            
                                            foreach ($datas as $data) {

                                    ?>
                                        <tr>
                                            <td><?php echo $data['id'];?></td>
                                            <td><?php echo $data['cont_name'];?></td>
                                            <td><?php echo $data['cont_name'];?></td>
                                            <td><?php echo $data['cont_name'];?></td>
                                            <td>
                                                <a href="query.php?a=del&w=footer&i=<?php echo $data['id'];?>" class="btn btn-danger"  style="margin-right: 8px;" ><i class="fa fa-recycle"> Delete</i>
                                            </td>
                                        </tr>

                                            <?php } ?>
                                    </tbody>
                                </table>

                         </div>
                          <!-- /.table-responsive -->
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
<!-- / #page-wrapper -->

<script>

    <?php if(!strcmp($_GET['s'], 'show')){?>
        //DataTable
        $('#dataTables-example').DataTable({
            responsive: true,
            "order": [[ 0, "desc" ]]
        });
    <?php }?>    

    $(document).ready(function() {
        var gm = jQuery("#canvas").data('gridmanager');
        $(".save_btn").on("click", function(e) {
            gm.getContent();
    
        });
        //bite was here
        var cat_src = [];
    
        $.ajax({
    
            url : 'pages/query_category.php',
            dataType : 'json',
    
            success : function(data) {
    
                for ( i = 0; i < data.length; i++) {
    
                    var cat_obj = {};
                    cat_obj["value"] = data[i]['cat_id'];
                    cat_obj["text"] = data[i]['cat_name'];
    
                    cat_src.push(cat_obj);
    
                }
    
                console.log(cat_src);
    
            }
        });
    
        $(function() {
            $.fn.editable.defaults.mode = 'inline';
    
            $('.name').editable({});
            $('.status').editable({
    
                source : [{
                    text : 'draft',
                    value : 'draft'
                }, {
                    value : 'future',
                    text : 'future'
                }, {
                    value : 'pending',
                    text : 'pending'
                }, {
                    value : 'private',
                    text : 'private'
                }, {
                    value : 'published',
                    text : 'published'
                }, {
                    value : 'trash',
                    text : 'trash'
                }]
    
            });
    
            $('.category').editable({
    
                source : cat_src
    
            });
    
        });
    
    });

    
</script>

<script type="text/javascript" src="js/functions.js"></script>
<script src="components/Editablecss/js/bootstrap-editable.js"></script>

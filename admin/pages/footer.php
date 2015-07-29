
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

                                    <form method="post" role="form" action="query.php?a=addFooter" enctype="multipart/form-data" data-toggle="validator">
                
                                                        <div class="col-lg-4 form-group">
                                                            <label>Title</label>
                                                            <input name="title" class="form-control" placeholder="Enter Title Name" required>
                                                        </div>
                                                        
                                                        <div class="col-lg-8 form-group">
                                                            <label>Link</label>
                                                            <input name="link" class="form-control" placeholder="Enter Link" required>
                                                        </div>

                                                        
                                                        <div class="col-lg-4 form-group">
                                                            <label>Link Order</label>
                                                            <input name="link_order" class="form-control" placeholder="Enter Link Order(Number)" required>
                                                        </div>
                                                        
                                                        <div class="col-lg-4 form-group">
                                                            <label>Link Position</label>
                                                            <select name="link_position" class="form-control">
                                                                <option value="right">Right</option>
                                                                <option value="center">Center</option>
                                                            </select>
                                                        </div>

                
                                                        <div class="col-lg-4 form-group">
                                                            <label>Link Target</label>
                                                            <select name="link_target" class="form-control">
                                                                <option value="_self">Same frame as it was clicked (Self)</option>
                                                                <option value="_blank">New window (Blank)</option>
                                                                <option value="_parent">Parent frameset (Parent)</option>
                                                                <option value="_top">Full body of the window (Top)</option>
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
                                            <th>Target</th>
                                            <th>Position</th>
                                            <th>Order</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                            $datas = $database->select("content",array('id','cont_name'),array('cont_type' => 'footer'));
                                            
                                            foreach ($datas as $data) {

                                    ?>
                                        <?php
                                                $footer_link = $database->select("content_meta",'meta_value',array('AND'=>array('cont_id'=>$data['id'] , 'meta_key'=>'footer.link')));
                                                $footer_link_target = $database->select("content_meta",'meta_value',array('AND'=>array('cont_id'=>$data['id'] , 'meta_key'=>'footer.link_target')));
                                                $footer_link_position = $database->select("content_meta",'meta_value',array('AND'=>array('cont_id'=>$data['id'] , 'meta_key'=>'footer.link_position')));
                                                $footer_link_order = $database->select("content_meta",'meta_value',array('AND'=>array('cont_id'=>$data['id'] , 'meta_key'=>'footer.link_order')));
                                        ?>
                                        <tr>
                                            <td><?php echo $data['id'];?></td>
                                            <td><a href="#" class="name" data-type="text" data-pk="<?php echo $data['id'];?>" data-url="query.php?a=editvalue&c=cont_name" data-title="Edit below here" ><?php echo $data['cont_name'];?></a></td>
                                            <td><a href="#" class="footerlink" data-type="text" data-pk="<?php echo $data['id'];?>" data-url="query.php?a=editvaluelink&c=content_meta&where=footer.link" data-title="Edit below here" ><?php echo $footer_link[0];?></a></td>
                                            <td><?php echo $footer_link_target[0];?></td>
                                            <td><?php echo $footer_link_position[0];?></td>
                                            <td><?php echo $footer_link_order[0];?></td>
                                            <td>
                                                <a href="query.php?a=del&w=footer&i=<?php echo $data['id'];?>" class="btn btn-danger"> <i class="fa fa-recycle"></i></a> 
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

    //DataTable
    $('#dataTables-example').DataTable({
         responsive: true,
         "order": [[ 0, "desc" ]]
    });
 

    $(document).ready(function() {        
        
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
			$('.footerlink').editable({});
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

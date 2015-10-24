<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<!-- Start Content -->

				<?php $users = \Fr\LS::getUser();?>

				    <h1 class="page-header"><i class="fa fa-language fa-1x"></i> Language Management</h1>
				    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Create New Language</b>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" role="form" action="query.php?a=addlang" data-toggle="validator">

                                        <div class="col-lg-4 form-group">
                                            <label>Language Code</label>
                                            <input name="code" class="form-control" placeholder="Enter Language Code Name" required>
                                        </div>

                                        <div class="col-lg-4 form-group">
                                            <label>Language Name</label>
                                            <input name="name" class="form-control" placeholder="Enter Language Name" required>
                                        </div>

                                        <div class="col-lg-2">
                                            <button style="margin-top: 20px;" type="submit" class="btn btn-primary">Add Language</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.col-lg-12 (nested) -->

                                </div>
                                <!-- /.row (nested) -->
                           </div>
                          <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>Set Site Default Language</b>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                <div class="col-lg-12">
                                    
                                    <form method="post" role="form" action="query.php?a=addDefaultLang" data-toggle="validator">
                                        <div class="col-lg-3 form-group">                            
                                            <select name="lang" class="form-control">
                                                 <?php
                                                    $datas = $database->select("language","*");
                                                    foreach ($datas as $data) {
                                                ?>
                                                <option value="<?php echo $data['lang_id'];?>">( <?php echo $data['lang_code'];?> ) <?php echo $data['lang_name'];?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 form-group">
                                            <button id="cont_action_btn" class="btn btn-success">
                                                Set
                                            </button>
                                        </div>
                                    </form>
                                    
                                </div>
                                </div>                                                                 
                            </div>
                    </div>

                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>All Language</b>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                
                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" id="lang_table">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>Code</th>
                                                <th>Language Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                                $datas = $database->select("language","*");
                                                $site_default_lang_id = $database->select("site_meta",'meta_value',array('meta_key'=>'site_default_lang'));
                                                foreach ($datas as $data) {
                                        ?>
                 <!-- Bite did hereeeeeeeeeeeeeeeeeeeeeeeeeeeeeee -->
                                            <tr>
                                                <td><?php echo $data['lang_id'];?></td>
                                                <td>
                                                    <a href="#" class="name" data-type="text" data-pk="<?php echo $data['lang_id'];?>" data-url="query.php?a=editvaluelang&c=lang_code" data-title="Edit below here" >
                                                        <?php echo $data['lang_code'];?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="#" class="name" data-type="text" data-pk="<?php echo $data['lang_id'];?>" data-url="query.php?a=editvaluelang&c=lang_name" data-title="Edit below here" >
                                                        <?php echo $data['lang_name'];?>
                                                    </a><?php if($site_default_lang_id[0] == $data['lang_id']) echo "&nbsp;&nbsp;.<a class='btn btn-warning btn-xs'>Site Default Language</a>";?>
                                                </td>
                                                <td>
                                                    
                                                    <?php if($data['lang_id']){?>
                                                    <a href="query.php?a=del&w=lang&i=<?php echo $data['lang_id'];?>" class="btn btn-danger" style="margin-right: 8px;"><i class="fa fa-trash-o"></i>
                                                    <?php };?>
                                                </td>
                                            </tr>

                                        <?php }?>
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

<!------------------------------------------------------------------------------------------------------------------------------------->


<script>
    $(document).ready(function() {
        $('#lang_table').DataTable({
            paging: false,
            responsive: true,
            "order": [[ 1, "desc" ]],
            "columnDefs": [
                { "width": "3px", "targets": 0 },
                { "orderable": false, "targets": 0 }
            ]
        });
                
        $(function() {
            $.fn.editable.defaults.mode = 'inline';
            $('.name').editable({});
        });   
    });
    
</script>

<script type="text/javascript" src="js/functions.js"></script>
<script src="components/Editablecss/js/bootstrap-editable.js"></script>

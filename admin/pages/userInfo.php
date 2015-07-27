<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><i class="fa fa-user fa-1x"></i> User Profile</h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
		<!-- ERROR ZONE -->
		<div class="row">
			<div class="col-lg-12">
				<?php
                if (isset($_POST['change_password'])) {
                    if (isset($_POST['current_password']) && $_POST['current_password'] != "" && isset($_POST['new_password']) && $_POST['new_password'] != "" && isset($_POST['retype_password']) && $_POST['retype_password'] != "" && isset($_POST['current_password']) && $_POST['current_password'] != "") {

                        $curpass = $_POST['current_password'];
                        $new_password = $_POST['new_password'];
                        $retype_password = $_POST['retype_password'];

                        if ($new_password != $retype_password) {
                            echo "<p><h3 class='text-warning'>Passwords Doesn't match</h3><p>The passwords you entered didn't match. Try again.</p></p>";
                        } else {
                            $change_password = \Fr\LS::changePassword($curpass, $new_password);
                            if ($change_password === true) {
                                echo "<h2 class='text-success'>Password Changed Successfully</h2>";
                            }
                        }
                    } else {
                        echo "<p class='text-warning'><h2>Password Fields was blank</h2></p><p class='text-warning'>Form fields were left blank</p>";
                    }
                }

                if(isset($_POST['newName']) ){
                    $_POST['newName'] = $_POST['newName'] == "" ? "Dude" : $_POST['newName'];
                    \Fr\LS::updateUser(array(
                        "name" => $_POST['newName']
                    ));
                }
				?>
			</div>
		</div>
		<!-- END ERROR ZONE -->
		<div class="row">
			<div class="col-lg-12">
			    
				<div class="panel panel-default">
					<div class="panel-heading">
						Change Password
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form action="<?php echo \Fr\LS::curPageURL();?>" method="POST">
									<div class="form-group">
										<label>Current Password</label>
										<input class="form-control" type='password' name='current_password' placeholder="Current Password">
									</div>
									<div class="form-group">
										<label>New Password</label>
										<input class="form-control" type='password' name='new_password' placeholder="New Password">
									</div>
									<div class="form-group">
										<label>Retype New Password Again</label>
										<input class="form-control" type='password' name='retype_password' placeholder="Retype New Password">
									</div>
									<button name='change_password' type='submit' class="btn btn-success">
										Change Password
									</button>
									<button type="reset" class="btn btn-primary">
										Reset
									</button>
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
                        Change the name of your account
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="<?php echo \Fr\LS::curPageURL(); ?>" method="POST">
                                    <div class="form-group">
                                        <label>New Name</label>
                                        <input class="form-control" name="newName" placeholder="New name" placeholder="New Name" value="<?php echo $details['name'];?>">
                                    </div>
                                    <button type='submit' class="btn btn-success">
                                        Change Name
                                    </button>
                                    <button type="reset" class="btn btn-primary">
                                        Reset
                                    </button>
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
                        Change Email
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="query.php?a=updateUserEmail" method="post">
                                    <div class="form-group">
                                        <label>New Email</label>
                                        <input class="form-control" name="newEmail" placeholder="New Email" placeholder="Email" value="<?php echo $details['email'];?>"/>
                                    </div>
                                    <input type="hidden" name="user_id" value="<?php echo $details['id'];?>"/>
                                    <button type='submit' class="btn btn-success">
                                        Change Email
                                    </button>
                                    <button type="reset" class="btn btn-primary">
                                        Reset
                                    </button>
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


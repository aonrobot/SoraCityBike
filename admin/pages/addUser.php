<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><i class="fa fa-plus-circle fa-1x"></i> Add New Admin User</h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
		<!-- ERROR ZONE -->
		<div class="row">
			<div class="col-lg-12">
				<?php
                if (isset($_POST['submit'])) {
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $password = $_POST['pass'];
                    $retyped_password = $_POST['retyped_password'];
                    $name = $_POST['name'];
                    if ($username == "" || $email == "" || $password == '' || $retyped_password == '' || $name == '') {
                        echo "<h3 class='text-warning'>Fields Left Blank</h3>", "<p class='text-danger'>Some Fields were left blank. Please fill up all fields.</p>";
                    } elseif (!\Fr\LS::validEmail($email)) {
                        echo "<h3 class='text-warning'>E-Mail Is Not Valid</h3>", "<p class='text-danger'>The E-Mail you gave is not valid</p>";
                    } elseif (!ctype_alnum($username)) {
                        echo "<h3 class='text-warning'>Invalid Username</h3>", "<p class='text-danger'>The Username is not valid. Only ALPHANUMERIC characters are allowed and shouldn't exceed 10 characters.</p>";
                    } elseif ($password != $retyped_password) {
                        echo "<h3 class='text-warning'>Passwords Don't Match</h3>", "<p class='text-danger'>The Passwords you entered didn't match</p>";
                    } else {
                        $createAccount = \Fr\LS::register($username, $password, array("email" => $email, "name" => $name, "created" => date("Y-m-d H:i:s") // Just for testing
                        ));
                        if ($createAccount === "exists") {
                            echo "<label class='text-danger'>User Exists.</label>";
                        } elseif ($createAccount === true) {
                            echo "<label class='text-success'>Success. Created account. <a href='index.php'>Dashborad</a></label>";
                        }
                    }
                }
				?>
			</div>
		</div>
		<!-- END ERROR ZONE -->
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						User Info
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form action="<?php echo \Fr\LS::curPageURL();?>" method="POST">
									<div class="form-group">
										<label>Username</label>
										<input class="form-control" name="username" placeholder="Username">
									</div>
									<div class="form-group">
										<label>Email</label>
										<input class="form-control" name="email" placeholder="E-Mail">
									</div>
									<div class="form-group">
										<label>Password</label>
										<input class="form-control" name="pass" type="password" placeholder="Password">
									</div>
									<div class="form-group">
										<label>Retype Password Again</label>
										<input class="form-control" name="retyped_password" type="password" placeholder="Retype Password">
									</div>
									<div class="form-group">
										<label>Name</label>
										<input class="form-control" name="name" placeholder="Name">
									</div>
									<button name="submit" type='submit' class="btn btn-success">
										Add User
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


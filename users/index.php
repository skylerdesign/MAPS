<?php include($_SERVER['DOCUMENT_ROOT']."/bouncer.php"); ?>
<?php include($_SERVER['DOCUMENT_ROOT']."/parts/header.php"); ?>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            
            <?php include($_SERVER['DOCUMENT_ROOT']."/parts/topnav.php"); ?>

            <?php include($_SERVER['DOCUMENT_ROOT']."/parts/sidebar.php"); ?>
            
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Users</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
	            	<div class="pull-right">
		            	<p><a href="/" class="btn btn-info">Add New User</a></p>
	            	</div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            All Users
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Username</th>
                                            <th>Role</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php

										    $query = "SELECT * FROM users order by user_id desc"; 

										    try{
											    $sth = $db->prepare($query);
												$sth->execute();
											}
											catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 
											//loop over all table rows and fetch them as an object
											while($result = $sth->fetch(PDO::FETCH_OBJ))
											{
												//print out the fruits name in this case.
												?>
												<tr>
		                                            <td><?php echo $result->user_id; ?></td>
		                                            <td><?php echo $result->user_firstname; ?></td>
		                                            <td><?php echo $result->user_lastname; ?></td>
		                                            <td><?php echo $result->user_username; ?></td>
		                                            <td><?php 
			                                            $role = $result->user_role;
					                                    foreach($db->query('SELECT * FROM roles WHERE role_id=' . $role) as $row) {
														    echo $row['role_name']; 
														}
					                                        
				                                            
			                                        ?></td>
			                                        <td><a href="edit-profile.php?u=<?php echo $result->user_id; ?>" class="btn btn-success btn-circle"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;<!--<a href="edit-profile.php?d=<?php echo $result->user_id; ?>" class="btn btn-danger btn-circle"><span class="fa fa-times"></span></a>--></td>
		                                        </tr>		
											<?php
											}
											?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include($_SERVER['DOCUMENT_ROOT']."/parts/footer.php"); ?>

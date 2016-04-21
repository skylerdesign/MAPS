<?php include($_SERVER['DOCUMENT_ROOT']."/bouncer.php"); ?>
<?php 
    if(!empty($_POST)) 
    { 
        //id
	    //title
	    //start
	    //end
	    //user_id
	    //clinician_id
	    //url
	    //allday

        // Ensure that the user fills out fields 
        if(empty($_POST['title'])) 
        { die("Please enter an appointment name."); } 
        if(empty($_POST['start'])) 
        { die("Please enter a start time."); } 
        if(empty($_POST['end'])) 
        { die("Please enter a end time."); } 
         
        
        $query = " 
            SELECT 
                1 
            FROM users 
            WHERE 
                user_email = :email 
        "; 
        $query_params = array( 
            ':email' => $_POST['email'] 
        ); 
        try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage());} 
        $row = $stmt->fetch(); 
        if($row){ die("This email address is already registered"); } 
         
        // Add row to database 
        $query = " 
            INSERT INTO events ( 
                title, 
                start, 
                end, 
                user_id,
                clinician_id,
                url,
                allday 
            ) VALUES ( 
                :title, 
                :start, 
                :end, 
                :user_id,
                :clinician_id,
                :url,
                :allday 
            ) 
        "; 
         
        // Security measures 
        $query_params = array( 
            ':title' => $_POST['title'], 
            ':start' => $_POST['start'],  
            ':end' => $_POST['end'],
            ':user_id' => $_POST['user_id'], 
            ':clinician_id' => $_POST['clinician_id'], 
            ':url' => $_POST['url']
        ); 
        try {  
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 
        header("Location: index.php"); 
        die("Redirecting to index.php"); 
    } 
?>
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
                    <h1 class="page-header">Add Appointment</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
	                

                    <div class="panel panel-default">
 
                        <!-- /.panel-heading -->
				                        <div class="panel-body">
					                        
					                        
					                        <form action="add.php" method="post"> 
					       
							    <!-- Nav tabs -->
				    <!-- Tab panes -->
				        <div class="tab-pane fade in active" id="general">         
				            <div class="col-md-6">
				                <div class="form-group float-label-control">                      
				                    <label for="">Start Date</label>
				                    <input type="text" class="form-control" placeholder="Han" name="user_firstname" value="Han">
				                    <input type="hidden" class="form-control" placeholder="8" name="user_id" value="8">
				                </div>
				                <div class="form-group float-label-control">  
				                    <label for="">End Date</label>
				                    <input type="text" class="form-control" placeholder="Solo" name="user_lastname" value="Solo">
				                </div>
				                <div class="form-group">
					                <label>Patient</label>
					                <select class="form-control" name="user_id">
					                    <option>Please select</option>
					                    <?php 
						                    $query = "SELECT * FROM users WHERE user_role=3 ORDER BY user_lastname ASC"; 
						                    
						                    $stmt = $db->query($query);
				 
											while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
											
												<option value="<?php echo $row['user_id'] ?>"<?php echo ($clinician == $row['user_id']) ? ' selected' : ''; ?>><?php echo $row['user_lastname'] . ', ' . $row['user_firstname'] ; ?></option>
											
											<?php } ?>
				
				
					                </select>
					            </div>
				                    
				                <div class="form-group float-label-control">
				                    <label for="">Clinician</label>
					                <select class="form-control" name="clinician_id">
					                    <option>Please select</option>
					                    <?php 
						                    $query = "SELECT * FROM users WHERE user_role=2 ORDER BY user_lastname ASC"; 
						                    
						                    $stmt = $db->query($query);
				 
											while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
											
												<option value="<?php echo $row['user_id'] ?>"<?php echo ($clinician == $row['user_id']) ? ' selected' : ''; ?>><?php echo $row['user_lastname'] . ', ' . $row['user_firstname'] ; ?></option>
											
											<?php } ?>
				
				
					                </select>
				                </div>  
				            </div>  
				            <div class="col-md-6">
				                
                       </div>

				    </div>     
				    <br clear="all">
				    <div class="submit">
				        <center>
				            <button class="btn btn-primary ladda-button" data-style="zoom-in" type="submit" id="SubmitButton" value="Upload">Add Appointment</button>
				        </center>
				    </div>
				</form>         
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include($_SERVER['DOCUMENT_ROOT']."/parts/footer.php"); ?>
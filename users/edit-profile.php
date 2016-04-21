<?php include($_SERVER['DOCUMENT_ROOT']."/bouncer.php"); ?>
<?php include($_SERVER['DOCUMENT_ROOT']."/parts/header.php"); ?>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            
            <?php include($_SERVER['DOCUMENT_ROOT']."/parts/topnav.php"); ?>

            <?php include($_SERVER['DOCUMENT_ROOT']."/parts/sidebar.php"); ?>
            
        </nav>
        
        <?php  
	                            
        $user_id = $_GET['u'];
        
        if ($user_id == '' ) {
	        echo "User not found";
	        return false;
        }
        
        foreach($db->query('SELECT * FROM users WHERE user_id=' . $user_id) as $row) {
            
            $id = $row['user_id'];
            $firstname = $row['user_firstname'];
            $prefix = $row['user_prefix'];
            $user_role= $row['user_role'];
            $clinician= $row['user_clinician'];
            $clinic = $row['user_clinic'];
            $lastname = $row['user_lastname'];
            $avatar = $row['user_avatar'];
            $username = $row['user_username'];
            $password = $row['user_password'];
            $email = $row['user_email'];
            $shortbio = $row['user_shortbio'];
            $birthday = $row['user_dob'];
            $profession = $row['user_profession'];
            $country = $row['user_country'];
            $address = $row['user_address'];
            $website = $row['user_website'];
            $gender = $row['user_gender'];
		}        
		
		
		?> 

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
	                 
	                    <?php echo $lastname ; ?>, <?php echo $firstname ; ?>
	                    
	                </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit Profile
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
	                        
	                        <?php include 'controllers/form/edit-profile-form.php' ?>
         
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

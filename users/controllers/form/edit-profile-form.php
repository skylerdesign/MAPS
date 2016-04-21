<form action="components/update-profile.php" method="post" enctype="multipart/form-data" id="UploadForm">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
      <li class="active"><a href="#general" data-toggle="tab">General</a></li>
      <li><a href="#personal" data-toggle="tab">Personal</a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane fade in active" id="general">         
            <div class="col-md-6">
                <div class="form-group float-label-control">                      
                    <label for="">First Name</label>
                    <input type="text" class="form-control" placeholder="<?php echo $firstname; ?>" name="user_firstname" value="<?php echo $firstname ;?>">
                    <input type="hidden" class="form-control" placeholder="<?php echo $id; ?>" name="user_id" value="<?php echo $id ;?>">
                </div>
                <div class="form-group float-label-control">  
                    <label for="">Last Name</label>
                    <input type="text" class="form-control" placeholder="<?php echo $lastname;?>" name="user_lastname" value="<?php echo $lastname;?>">
                </div>
                <div class="form-group">
	                <label>Prefix</label>
	                <select class="form-control" name="user_prefix">
	                    <option<?php echo ($prefix == 'Ms.') ? ' selected' : ''; ?>>Ms.</option>
	                    <option<?php echo ($prefix == 'Miss') ? ' selected' : ''; ?>>Miss</option>
	                    <option<?php echo ($prefix == 'Mrs.') ? ' selected' : ''; ?>>Mrs.</option>
	                    <option<?php echo ($prefix == 'Mr.') ? ' selected' : ''; ?>>Mr.</option>
	                    <option<?php echo ($prefix == 'Dr.') ? ' selected' : ''; ?>>Dr.</option>
	                    <option<?php echo ($prefix == 'Atty.') ? ' selected' : ''; ?>>Atty.</option>
	                    <option<?php echo ($prefix == 'Prof.') ? ' selected' : ''; ?>>Prof.</option>
	                </select>
	            </div>
                    
                <div class="form-group float-label-control">
                    <label for="">Email</label> 
                    <input type="text" class="form-control" placeholder="<?php echo $email ;?>" name="user_email" value="<?php echo $email;?>">
                </div>  
            </div>  
            <div class="col-md-6">
                <div class="form-group float-label-control">
	                <label for="">Username</label>
                    	<input type="text" class="form-control" placeholder="<?php echo $username;?>" name="user_username" value="<?php echo $username;?>" id="disabledTextInput" autocomplete="off">
                </div>
                <div class="form-group float-label-control">
                    <label for="">Password</label>
                    <input type="password" class="form-control" placeholder="password" name="user_password" value="<?php echo $password;?>">
                </div>
                <div class="form-group">
	                <label>Role</label>
	                <select class="form-control" name="user_role">
	                    <option value='2'<?php echo ($user_role == '2') ? ' selected' : ''; ?>>Clinician</option>
	                    <option value='3'<?php echo ($user_role == '3') ? ' selected' : ''; ?>>Patient</option>
	                    <option value='4'<?php echo ($user_role == '3') ? ' selected' : ''; ?>>Staff</option>
	                    <option value='1' <?php echo ($user_role == '1') ? ' selected' : ''; ?>>Director</option>
	                </select>
	            </div>
	            <?php if ($user_role == '3') { ?>
	            	<div class="form-group">
	                <label>Clinician</label>
	                <select class="form-control" name="user_clinician">
	                    <option>Please select</option>
	                    <?php 
		                    $query = "SELECT * FROM users WHERE user_role=2"; 
		                    
		                    $stmt = $db->query($query);
 
							while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
							
								<option value="<?php echo $row['user_id'] ?>"<?php echo ($clinician == $row['user_id']) ? ' selected' : ''; ?>><?php echo $row['user_firstname'] . ' ' . $row['user_lastname'] ; ?></option>
							
							<?php } ?>


	                </select>
	            </div>
	            <?php } ?>
	            
	            <?php if ($user_role == '2') { ?>
	            	<div class="form-group">
	                <label>Clinic</label>
	                <select class="form-control" name="user_clinic">
	                    <option>Please select</option>
	                    <?php 
		                    $query = "SELECT * FROM clinics"; 
		                    
		                    $stmt = $db->query($query);
 
							while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
							
								<option value="<?php echo $row['clinic_id'] ?>"<?php echo ($clinic == $row['clinic_id']) ? ' selected' : ''; ?>><?php echo $row['clinic_name'] ; ?></option>
							
							<?php } ?>


	                </select>
	            </div>
	            <?php } ?>
            </div>
        </div>
        <div class="tab-pane fade" id="personal">
            <div class="col-md-6">
                <div class="form-group float-label-control">
                    <label for="">Short Bio</label>
                    <textarea class="form-control" placeholder="<?php echo $shortbio;?>" rows="10" placeholder="<?php echo $shortbio;?>" name="user_shortbio" value="<?php echo $shortbio;?>"><?php echo $shortbio;?></textarea>
                </div>
                
            </div>
            <div class="col-md-6">
                <div class="form-group float-label-control">
                    <label for="">Profession</label>
                    <input type="text" class="form-control" placeholder="<?php echo $profession;?>" name="user_profession" value="<?php echo $profession;?>" id="profession">    
                </div>  
                <label for="">Gender</label>              
                <div class="form-group float-label-control">
                    <div class="radio-inline">
                        <label>
                            <input type="radio" name="user_gender" id="optionsRadios1" value="male" <?php echo ($gender == 'male') ? 'checked' : ''; ?>>Male</label>
                    </div>              
                    <div class="radio-inline">
                        <label>
                            <input type="radio" name="user_gender" id="optionsRadios1" value="female" <?php echo ($gender == 'female') ? 'checked' : ''; ?>>Female</label>
                    </div>
                </div>
                <div class="form-group float-label-control">
                    <label for="">Birthday</label>   
                    <input type="date" class="form-control" placeholder="<?php echo $birthday;?>" name="user_dob" value="<?php echo $birthday;?>">      
                </div>
            </div>
            
        </div>
    </div>     
    <br clear="all">
    <div class="submit">
        <center>
            <button class="btn btn-primary ladda-button" data-style="zoom-in" type="submit"  id="SubmitButton" value="Upload" />Save Profile</button>
        </center>
    </div>
</form>
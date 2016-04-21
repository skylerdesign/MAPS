<?php
	
    ini_set("display_errors",1);   
    
    if(isset($_POST)){
	    $temp = $_POST["user_id"]; 
		echo 'temp: ' . $temp;
        require($_SERVER['DOCUMENT_ROOT']."/config.php");
        
        // password
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
        $user_password = hash('sha256', $_REQUEST['user_password'] . $salt); 
        for($round = 0; $round < 65536; $round++){ $user_password = hash('sha256', $user_password . $salt); } 
        
        $user_firstname=$_REQUEST['user_firstname'];
        $user_lastname=$_REQUEST['user_lastname'];
        $user_prefix=$_REQUEST['user_prefix'];
        $user_email=$_REQUEST['user_email'];
        $user_role=$_REQUEST['user_role'];
        $user_clinician=$_REQUEST['user_clinician'];
        $user_clinic=$_REQUEST['user_clinic'];
        //$user_password=$_REQUEST['user_password'];
        $user_profession=$_REQUEST['user_profession'];
        $user_shortbio=$_REQUEST['user_shortbio'];   
        $user_dob=$_REQUEST['user_dob'];
        $user_gender=$_REQUEST['user_gender'];
        $sql="UPDATE users SET
			user_firstname='$user_firstname',
			user_lastname='$user_lastname',
			user_prefix='$user_prefix',
			user_profession='$user_profession',
			user_email='$user_email',
			user_role='$user_role',
			user_clinician='$user_clinician',
			user_clinic='$user_clinic',
			user_password='$user_password',
			user_salt='$salt',
			user_shortbio='$user_shortbio',
			user_dob='$user_dob',
			user_gender='$user_gender'
			WHERE user_id = $temp";

        $q = $db->prepare($sql);
        $q->execute();
        
            //mysqli_query($db,$sql3)or die(mysqli_error($db));
            header("location:../edit-profile.php?u=$temp&request=profile-update&status=success");
    }    
?>
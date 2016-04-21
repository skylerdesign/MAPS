<?php 
    require($_SERVER['DOCUMENT_ROOT']."/config.php"); 
    $submitted_username = ''; 
    if(!empty($_POST)){ 
        $query = " 
            SELECT 
                *
            FROM users 
            WHERE 
                user_email = :username 
        "; 
        $query_params = array( 
            ':username' => $_POST['username'] 
        ); 
         
        try{ 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 
        $login_ok = false; 
        $row = $stmt->fetch(); 
        if($row){ 
            $check_password = hash('sha256', $_POST['password'] . $row['user_salt']); 
            for($round = 0; $round < 65536; $round++){
                $check_password = hash('sha256', $check_password . $row['user_salt']);
            } 
            if($check_password === $row['user_password']){
                $login_ok = true;
                
                $current_user = $_SESSION['user_email'];
                $user_id = $_SESSION['user_id'];
                $user_role = $_SESSION['user_role'];
			    $user_email = mysqli_real_escape_string($database,$_REQUEST['user_email']);
			    $profile_username=$rws['user_email'];
			    //echo $profile_username;
            } 
        } 

        if($login_ok){ 
            unset($row['user_salt']); 
            unset($row['user_password']); 
            $_SESSION['user'] = $row;  
            header("Location: index.php"); 
            die("Redirecting to: index.php"); 
        } 
        else{ 
            
            $alert = '<Br><div class="container"><div class="row">
            <div class="">
            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                Login failed.</div>
            </div></div></div>';
            print($alert); 
            $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8'); 
        } 
    } 

function getAppointment($id, $key){
	$db = new Db;
	return $db->get_var("SELECT * FROM " . TABLES_PREFIX . "events WHERE event_id = " . $id . " ORDER BY id DESC LIMIT 0,1");
}

function createClinicianDropdown($name="user_clinician") {
	$str = '<select class="form-control" name="user_clinician">';
	$str .= '<option>Please select</option>';
	$query = "SELECT * FROM users WHERE user_role=2"; 
	$stmt = $db->query($query);
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		//$str .= '<option value="' . $row['user_id'] . '">' . $row['user_firstname'] . ' ' . $row['user_lastname']. '</option>';
		echo 'xx';
	}
	$str .= '</select>';
	return $str;
}

function addAppointment() {
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
         
        // Check if the username is already taken
        $query = " 
            SELECT 
                1 
            FROM users 
            WHERE 
                user_username = :username 
        "; 
        $query_params = array( ':username' => $_POST['username'] ); 
        try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 
        $row = $stmt->fetch(); 
        if($row){ die("This username is already in use"); } 
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
            INSERT INTO users ( 
                user_username, 
                user_password, 
                user_salt, 
                user_email 
            ) VALUES ( 
                :username, 
                :password, 
                :salt, 
                :email 
            ) 
        "; 
         
        // Security measures
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
        $password = hash('sha256', $_POST['password'] . $salt); 
        for($round = 0; $round < 65536; $round++){ $password = hash('sha256', $password . $salt); } 
        $query_params = array( 
            ':username' => $_POST['username'], 
            ':password' => $password, 
            ':salt' => $salt, 
            ':email' => $_POST['email'] 
        ); 
        try {  
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 
        header("Location: index.php"); 
        die("Redirecting to index.php"); 
    } 
}
?> 
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MAPS - Measurement Assisted Practice Program System</title>

    <!-- Bootstrap Core CSS -->
    <link href="/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/calendar.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">
    
     <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!-- jQuery -->
    <script src="/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/bower_components/metisMenu/dist/metisMenu.min.js"></script>


    <!-- Custom Theme JavaScript -->
    <script src="/dist/js/sb-admin-2.js"></script>
	
	<!-- Calendar -->
    
    
</head>
<body>
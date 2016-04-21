<?php
//ini_set("display_errors", 1);
require 'includes.php';

if(IsLoggedIn()){
	Leave('index.php');
}

$layout = PublicPage('signin', '{{ST:signin}}');

if(isset($_POST['submit'])){
	if(isset($_POST['email']) AND isset($_POST['password'])){
		
		$sql = "SELECT * FROM " . TABLES_PREFIX . "admin WHERE email = '" . Clean($_POST['email']) . "' ORDER BY id DESC";
		
		//echo $sql;
		
		$user = $db->get_row($sql);
		
		print_r($user) . '<br>';
		
		$password = $user->password;
		print '<br>~' . encode_password(Clean($_POST['password']));
		
		echo '<br>~' . $password;
		if($user AND ($user->password == encode_password(Clean($_POST['password'])))){
			
			
			if($user->status == 'active'){
				
				echo '<h3>user is active</h3>';
				
				$_SESSION['surveyengine_admin_logged_in'] = true;
				$_SESSION['surveyengine_admin_user_id'] = $user->id;
			
		
				if(isset($_POST['remember_me'])){
					setcookie(COOKIE_NAME, 'email='.$user->username.'&hash='.$user->password, time() + COOKIE_TIME);
				}
		
				header('Location: index.php');
			
				exit();
			
			}else{
				$layout->AddContentById('alert', $layout->GetContent('alert'));
				$layout->AddContentById('alert_nature', ' alert-danger');
				$layout->AddContentById('alert_heading', '{{ST:error}}!');
				$layout->AddContentById('alert_message', '{{ST:access_denied_contact_admin}}');
			}
		}else{
			$layout->AddContentById('alert', $layout->GetContent('alert'));
			$layout->AddContentById('alert_nature', ' alert-danger');
			$layout->AddContentById('alert_heading', '{{ST:error}}!');
			$layout->AddContentById('alert_message', '{{ST:the_info_is_not_correct}}');
		}
	}else{
		$layout->AddContentById('alert', $layout->GetContent('alert'));
		$layout->AddContentById('alert_nature', ' alert-danger');
		$layout->AddContentById('alert_heading', '{{ST:error}}!');
		$layout->AddContentById('alert_message', '{{ST:the_info_is_not_correct}}');
	}
}

$layout->RenderViewAndExit();

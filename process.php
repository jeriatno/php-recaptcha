<?php
 
	if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
	{
		$secret = 'your_actual_secret_key';
		$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
		$responseData = json_decode($verifyResponse);

		if($responseData->success)
		{
			$name		= $_POST['name_member_new'];
			$email		= $_POST['email'];;
			$mobile		= $_POST['mobile'];;
			$subject	= $_POST['subject'];;
			$message	= $_POST['message'];;
			
			$table_name = $wpdb->prefix . "members";
			
			$rowResult = $wpdb->insert($table_name, array(
							'name' 	=> $name, 
							'email' 	=> $email,
							'mobile' 	=> $mobile,
							'subject' => $subject,
							'message' => $message,
					), $format=NULL); 
					
			if($rowResult == 1) {
				$succMsg = 'Your contact request have submitted successfully.';
				header("Location: /contact-us");
			} else {
				header("Location: /contact-us");
			}
		}
		else
		{
			$errMsg = 'Robot verification failed, please try again.';
			header("Location: /contact-us");
		}
	}
?>

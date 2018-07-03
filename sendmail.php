<?php 
	


	$name = htmlspecialchars($_POST['name']);
	$email = htmlspecialchars($_POST['email']);
	$message = htmlspecialchars($_POST['message']);

	if(!empty($email) && !empty($name) && !empty($message)){

		if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            $signal = 'bad';
			$msg = 'please use valid email';
		}
		else{
			$toEmail = 'johnarbert.ruiz@gmail.com';
			$subject = 'Contact Request Form' . $name;
			$body = '<h2>Contact Request</h2>
					<h4>Name:</h4><p>' . $name . '</p>
					<h4>Email:</h4><p> ' . $email . '</p>
					<h4>Message:</h4><p> ' . $message . '</p> ';

					$headers ="MIME-version: 1.0" . "\r\n";
					$headers .="Content-Type: text/html; charset=UTF=8" . "\r\n";

					$headers .="From: " .$name. "<" .$email. ">" . "\r\n";

					if(mail($toEmail, $subject, $body, $headers)){
                        $signal = 'ok';
						$msg = 'Email Sent';
						
					}
					else{
                        $signal = 'bad';
						$msg = 'Email not Sent';
					}
		}
	}
	else{
        $signal = 'bad';
		$msg = 'Please fill in all fields';
	}
$data = array(
    'signal' => $signal,
    'msg' => $msg
);
echo json_encode($data);
?>
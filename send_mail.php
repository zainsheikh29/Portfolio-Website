<?php
$master_email = "zzainsheikh18@outlook.com";
$homepage_page = "homepage.html";
$error_page = "error_message.html";
$thankyou_page = "thank_you.html";

/*
This next bit loads the form field data into variables.
*/
$first_name = $_REQUEST['first_name'] ;
$email_address = $_REQUEST['email_address'] ;
$comments = $_REQUEST['comments'] ;
$msg = 
"Name: " . $n_ame . "\r\n" . 
"Email: " . $email_address . "\r\n" . 
"Comments: " . $comments ;

/*
The following function checks for email injection.
Specifically, it checks for carriage returns - typically used by spammers to inject a CC list.
*/
function isInjected($str) {
	$injections = array('(\n+)',
	'(\r+)',
	'(\t+)',
	'(%0A+)',
	'(%0D+)',
	'(%08+)',
	'(%09+)'
	);
	$inject = join('|', $injections);
	$inject = "/$inject/i";
	if(preg_match($inject,$str)) {
		return true;
	}
	else {
		return false;
	}
}

// If the user tries to access this script directly, redirect them to the feedback form,
if (!isset($_REQUEST['email_address'])) {
header( "Location: $homepage_page" );
}

// If the form fields are empty, redirect to the error page.
elseif (empty($n_ame) || empty($email_address)) {
header( "Location: $error_page" );
}

elseif ( isInjected($email_address) || isInjected($n_ame)  || isInjected($comments) ) {
header( "Location: $error_page" );
}


else {

	mail( "$master_email", "Feedback Form Results", $msg );

	header( "Location: $thankyou_page" );
}
?>
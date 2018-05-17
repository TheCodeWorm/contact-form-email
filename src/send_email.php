<?php

///////////////////////////////////
// sample script to deliver email
// using sendmail PHP
///////////////////////////////////
// IMPORTANT:
// place valid emails in $from_email and $email_to variables:
$from_email = "email@domain.com";    // email address setup at domain, to be sent from
$email_to = "your@email.com";  // where you want emails delivered (check spam box, if testing)

$visitor_name = $_REQUEST['name'];       // name of visitor, from form
$subject = "Website message from: $visitor_name"; // subject line you want on email 
$visitor_email = $_REQUEST['email'];     // visitor's email address

// remove illegal characters from email address
$visitor_email = filter_var($visitor_email, FILTER_SANITIZE_EMAIL);

// check if valid email
if (filter_var($visitor_email, FILTER_VALIDATE_EMAIL)) {
 	
  $visitor_message = $_REQUEST['message']; // message from visitor

  $message_body = "Name: $visitor_name \r\n";
  $message_body .= "Email: $visitor_email \r\n";
  $message_body .= "Message: \r\n $visitor_message \r\n";

  $headers = "From: $from_email \r\n";
  $headers .= "Reply-To: $visitor_email \r\n";
  $headers .= "Return-Path: $from_email\r\n";
  $headers .= "X-Mailer: PHP \r\n";
	
  if(mail($email_to, $subject, $message_body, $headers)) {
    echo ("Thank you, $visitor_name! Your message was sent successfully.");
  } 
  else {
    echo("Error sending email!");
  }
}
else {
  echo ("Please use a valid email.");
}
?>
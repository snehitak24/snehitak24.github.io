<?php
if(!isset($_POST['submit']))
{
	echo "error; you need to submit the form!";
}
$name = $_POST['contactName'];
$visitor_email = $_POST['contactEmail'];
$message = $_POST['contactMessage'];
$subject = $_POST['contactSubject'];

//Validate first
if(empty($name)||empty($visitor_email)) 
{
    echo "Name and email are mandatory!";
    exit;
}

if(IsInjected($visitor_email))
{
    echo "Bad email value!";
    exit;
}

$email_from = $name;
$email_subject = $subject;
$email_body = "You have received a new message from the user $name.\n".
    "Here is the message:\n $message".
    
$to = "snehita.k24@gmail.com";
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email \r\n";
mail($to,$email_subject,$email_body,$headers);


// Function to validate against any email injection attempts
function IsInjected($str)
{
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
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
   
?> 

<?php
$to      = 'priyanshunandan17@gmail.com'; // Send email to our user
$subject = 'Signup | Verification'; // Give the email a subject 
// $message = '
 
// Thanks for signing up!
// Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
 
// ------------------------
// Username: '.$name.'
// Password: '.$password.'
// ------------------------
 
// Please click this link to activate your account:
// http://www.yourwebsite.com/verify.php?email='.$email.'&hash='.$hash.'
 
// '; // Our message above including the link
$message='hi';                
$headers = 'From:webstar@example.com' . "\r\n".'Reply-To:priyanshunandan17@gmail.com'; // Set from headers
mail($to, $subject, $message, $headers); // Send our email
?>
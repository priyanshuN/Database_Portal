<?php
    $dbhost="localhost";
	$dbuser="root";
	$dbpass="mysql";
    $dbname="database_project_cs355";
    echo "hi";
    
	$conn= mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
    $conn1= new mysqli($dbhost,$dbuser,$dbpass,$dbname);
	if(!$conn){
		die("Connection failed: \n");
	}
    $email='iitp_project@rediff.com';
    $hash=md5(rand(0,1000));
    $to=$email;
    $subject='Link validation';
    $message="PLease click the link http://localhost/Database_Portal/portal/php/linkredirect.php?email='.$email.'$hash='.$hash.'";
    $headers='From"iitp_project@rediff.com'."\r\n";
    mail($to,$subject,$message,$headers);
?>
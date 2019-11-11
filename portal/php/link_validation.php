<?php
    $dbhost="localhost";
	$dbuser="root";
	$dbpass="mysql";
    $dbname="database_project_cs355";
    
    
	$conn= mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
    $conn1= new mysqli($dbhost,$dbuser,$dbpass,$dbname);
	if(!$conn){
		die("Connection failed: \n");
	}
    if(isset($_POST['submit'])){
        $email=$_POST['email'];
        $hash=md5(rand(0,1000));
        $sql="insert into link_check(email,hash,active) values('$email','$hash',0)";
        echo $sql;
        $result=mysqli_query($conn,$sql);
        if($result){
            $to=$email;
            $subject='Link validation check';
            $message="PLease click the link http://localhost/Database_Portal/portal/php/linkredirect.php?email='.$email.'&$hash='.$hash.'";
            $headers='From:"abc@rediff.com'."\r\n";
            mail($to,$subject,$message,$headers);
        }
        else{
            echo"query";
        }
    }
    else{
        echo"fail1";
    }
?>

<fieldset>
    <form action="" method="post">
        Email:<input type="email" name='email'>
        <input  type='submit' name='submit' value='submit'>
</fieldset>

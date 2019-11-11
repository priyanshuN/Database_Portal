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
    
    if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
        $email = mysql_escape_string($_GET['email']); // Set email variable
        $hash = mysql_escape_string($_GET['hash']); // Set hash variable
        $sql="select * from link_check where email='$email' and hash='$hash' and active='0'";
        $result=mysqli_connect($conn,$sql);
        if(mysqli_num_rows($result)>0){
            $sql="update link_check set active='1' where email='$email' and hash='$hash'";
            echo "<div class='statusmsg'>Your link verified</div>";
        }
        else{
            echo "<div class='statusmsg'>Your link invalid or already activated.</div>";
        }
    }
    else{
        echo "<div class='statusmsg'>Your link verified</div>";
    }
?>
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
    
    if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
        $email = mysqli_real_escape_string($conn,$_GET['email']); // Set email variable
        $hash = mysqli_real_escape_string($conn,$_GET['hash']);
//        echo $email;// Set hash variable
//        echo $hash;
        $sql="select * from link_check where email='$email' and hash='$hash' and active=0";
//        echo $sql;
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0){
            $sql1="update link_check set active='1' where email='$email' and hash='$hash'";
//            echo $sql1;
            $result1=mysqli_query($conn,$sql1);
            if($result){
                echo "<div class='statusmsg'>Your link verified</div>";
            }
            else{
                echo "u failed";
            }
        }
        else{
            echo "<div class='statusmsg'>Your link invalid or already activated.</div>";
        }
    }
    else{
        echo "<div class='statusmsg'>Your error</div>";
    }
?>
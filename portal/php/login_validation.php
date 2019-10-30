<?php
    $dbhost="localhost";
	$dbuser="root";
	$dbpass="mysql";
	$dbname="bank";
	$conn= mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(!$conn){
		die("Connection failed: \n");
	}
    if($_GET['action']=="login"){
        $error="";
        if($_POST["email"]==""){
            $error = "Email is required!";
        }
        else if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)==false){
            $error = "Please enter valid email!";
        }
        else if($_POST['password']==""){
            $error = "Please enter password!";
        }
        if($error!=""){
            echo $error;
            exit();
        }
    }
?>

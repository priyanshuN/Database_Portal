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
    $email = $conn->real_escape_string($_POST["email"]);
    $pass  = mysqli_real_escape_string($conn,$_POST['password']);
    if($_GET['action']=="register"){
        $name=$_POST['name'];
        $email=$_POST['email'];
        $dept=$_POST['dept'];
        $pass=$_POST['password'];
        if($name==""){
            
        }
        else{
            
        }
    }
?>
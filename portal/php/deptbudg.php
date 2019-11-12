<?php
    $dbhost="localhost";
	$dbuser="root";
	$dbpass="mysql";
    $dbname="database_project_cs355";
    $flag=0;
    
	$conn= mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
    $conn1= new mysqli($dbhost,$dbuser,$dbpass,$dbname);
	if(!$conn){
		die("Connection failed: \n");
	}
    if($_GET['action']=='budget'){
    }
?>
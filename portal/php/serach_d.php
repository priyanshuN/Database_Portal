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
    if($_GET['action']=="search"){
        $name=$_POST['name'];
        $paper=$_POST['paper'];
        $journal=$_POST['journal'];
        $project=$_POST['project'];
        $year=$_POST['year'];
        $budget=$_POST['budget'];
        $lo=$_POST['lower'];
        $up=$_POST['upper']; 
        if($paper!="" || $journal!=""){
            
        }
    }
?>
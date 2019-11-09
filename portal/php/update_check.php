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
if($_GET['action']=="check"){
    $uname=$_POST['ubname'];
    $sql="select * from publication where Name ='$uname'";
    $sql1="select * from project where Name = '$uname'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)){
        echo "<p><br>Click and edit the fields of above record you want to update";
        echo "<div class='card'><h5 class='card-header text-center font-weight-bold text-uppercase py-4'>Results</h5><div class='card-body'><table class='table table-striped' id='rectable'><thead><tr><th scope='col'>Paper_ID</th><th scope='col'>Name</th><th scope='col'>Type</th><th scope='col'>YearofPub</th></tr></thead><tbody>";
        while($row=mysqli_fetch_assoc($result)){
            echo "<tr><th scope='row'>{$row['Paper_ID']}</th><td contenteditable='true'>{$row['Name']}</td><td contenteditable='true'>{$row['Type']}<td contenteditable='true'>{$row['YearofPub']}";
        }
        echo "</tbody></table></div></div>";
       
    }
    else{
        echo"<div class='alert alert-danger' role='alert' id='rAlert' >No record found!</div>";
    }
    
    exit();
}
?>
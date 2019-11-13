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
    if($_GET['action']=='update'){
        $type=mysqli_real_escape_string($conn,$_POST['type1']);
        $id=mysqli_real_escape_string($conn,$_POST['id']);
        //echo $type;
        if($type=='Project'){
            $name=mysqli_real_escape_string($conn,$_POST['name']);
            $budget=mysqli_real_escape_string($conn,$_POST['budget']);
            $year=mysqli_real_escape_string($conn,$_POST['year']);
            $res=mysqli_real_escape_string($conn,$_POST['res']);
            $sql="update project set Name='$name' ,Budget='$budget',YearofPro='$year',research_area='$res' where Paper_ID='$id'";
            //echo $sql;
            $result=mysqli_query($conn,$sql);
            if($result){
                echo "Updated successfully";
            }
            else{
                echo "Updation failed";
            }
        }
        
        if($type=='Paper'||$type=='Journal'){
            $name=mysqli_real_escape_string($conn,$_POST['name']);
            $year=mysqli_real_escape_string($conn,$_POST['year']);
            $res=mysqli_real_escape_string($conn,$_POST['res']);
            $sql="update publication set Name='$name' ,YearofPub='$year', research_area='$res' where Paper_ID='$id'";
            $result=mysqli_query($conn,$sql);
            if($result){
                echo "Updated successfully";
            }
            else{
                echo "Updation failed";
            }
        }
    }
    else{
        echo"error";
    }
?>
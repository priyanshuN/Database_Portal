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
    $search=$_GET['term'];
    $sql="select * from project where Name like '%".$search."%' order by Name";
    $result=mysqli_query($conn,$sql);
    $sdata=array();
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            $data['id']=$row['Paper_ID'];
            $data['value']=$row['Name'];
            array_push($sdata,$data);
        }
    }
    $sql1="select * from publication where Name like '%$search%' order by Name ";
    $result1=mysqli_query($conn,$sql1);
    if(mysqli_num_rows($result1)>0){
        while($row=mysqli_fetch_assoc($result1)){
            $data['id']=$row['Paper_ID'];
            $data['value']=$row['Name'];
            array_push($sdata,$data);
        }
    }
echo json_encode($sdata);
?>
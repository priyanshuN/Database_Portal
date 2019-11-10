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
            $sql="call search_wb('$name','$paper','$journal','$year')";
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)){
                echo "<div class='card'><h5 class='card-header text-center font-weight-bold text-uppercase py-4'>Results</h5><div class='card-body'><table class='table table-striped' id='rectablepub'><thead><tr><th scope='col'>Paper_ID</th><th scope='col'>Name</th><th scope='col'>Type</th><th scope='col'>YearofPub</th></tr></thead><tbody>";
                while($row=mysqli_fetch_assoc($result)){
                    echo "<tr><th scope='row'>{$row['Paper_ID']}</th><td contenteditable='true'>{$row['Name']}</td><td contenteditable='true'>{$row['Type']}<td contenteditable='true'>{$row['YearofPub']}";
                }
                echo "</tbody></table></div></div>";

            }
        }
        if($project!="" || $budget!=-1 || $lo!=-1){
            $sql1="call search_b('$name','$year',$budget,$up,$lo)";
            $result1=mysqli_query($conn,$sql1);
            if(mysqli_num_rows($result1)){
                echo "<div class='card'><h5 class='card-header text-center font-weight-bold text-uppercase py-4'>Results</h5><div class='card-body'><table class='table table-striped' id='rectablepro'><thead><tr><th scope='col'>Paper_ID</th><th scope='col'>Name</th><th scope='col'>Budget</th><th scope='col'>YearofPro</th></tr></thead><tbody>";
                while($row=mysqli_fetch_assoc($result1)){
                    echo "<tr><th scope='row'>{$row['Paper_ID']}</th><td contenteditable='true'>{$row['Name']}</td><td contenteditable='true'>{$row['Budget']}<td contenteditable='true'>{$row['YearofPro']}";
                }
                echo "</tbody></table></div></div>";
            }
        }
    }
    exit();
?>
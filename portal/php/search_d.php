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
//        echo $name;
//        echo $year;
//        echo $budget;
//        echo $up;
//        echo $lo;
        $pubd=array();
        $prod=array();
        if($name!="" ||$paper!="" || $journal!="" || $year!="" && $budget==""){
            
            $sql="call search_wb('$name','$paper','$journal','$year')";
            //echo $sql;
            $result=$conn1->query($sql);
            //echo $result;
            if(mysqli_num_rows($result)){
                echo "<div class='card '><h5 class='card-header text-center font-weight-bold text-uppercase py-4'>Results</h5><div class='card-body'><table class='table table-striped' id='rectablepub'><thead><tr><th scope='col'>Paper_ID</th><th scope='col'>Name</th><th scope='col'>Type</th><th scope='col'>YearofPub</th><th scope='col'>Research Area</th></tr></thead><tbody>";
                while($row=mysqli_fetch_assoc($result)){
                    $pubd[]=$row;
                    echo "<tr><th scope='row'>{$row['Paper_ID']}</th><td >{$row['Name']}</td><td >{$row['Type']}</td><td >{$row['YearofPub']}</td><td>{$row['research_area']}</td></tr>";
                }
                echo "</tbody></table></div></div>";
            
                
            }
        }
        if($name!="" ||$project!="" || $budget!=-1 || $lo!=-1 || $year!="" && $paper=="" && $journal!=""){
            
            $sql1="call search_b('$name','$year',$budget,$up,$lo)";
            //echo $sql1;
            $result1=mysqli_query($conn,$sql1);
            //$result1=$conn1->query($sql1);
            //echo $result1;
            if(mysqli_num_rows($result1)){
                echo "<br><div class='card'><h5 class='card-header text-center font-weight-bold text-uppercase py-4'>Results</h5><div class='card-body'><table class='table table-striped' id='rectablepro'><thead><tr><th scope='col'>Paper_ID</th><th scope='col'>Name</th><th scope='col'>Budget</th><th scope='col'>YearofPro</th><th scope='col'>Research Area</th></tr></thead><tbody>";
                while($row=mysqli_fetch_assoc($result1)){
                    $prod[]=$row;
                    echo "<tr><th scope='row'>{$row['Paper_ID']}</th><td >{$row['Name']}</td><td >{$row['Budget']}</td><td >{$row['YearofPro']}</td><td>{$row['research_area']}</td></tr>";
                }
                echo "</tbody></table></div></div>";
            }
            
        }
    }
//    print json_encode($pubd[0]['Name']);
//    print json_encode($prod);
?>

    

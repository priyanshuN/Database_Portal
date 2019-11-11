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
    if($_GET['action']=="chart"){
        $name=$_POST['name'];
        $paper=$_POST['paper'];
        $journal=$_POST['journal'];
        $project=$_POST['project'];
        $year=$_POST['year'];
        $budget=$_POST['budget'];
        $lo=$_POST['lower'];
        $up=$_POST['upper']; 
        $pubd=array();
        $prod=array();
        if($name!="" ||$paper!="" || $journal!="" || $year!="" && $budget==""){ 
            $sql="call search_wb('$name','$paper','$journal','$year')";
            $result=$conn1->query($sql);
            if(mysqli_num_rows($result)){
                foreach ($result as $row) {
                    $pubd[] = $row;
                }
            }
        }
        if($name!="" ||$project!="" || $budget!=-1 || $lo!=-1 || $year!="" && $paper=="" && $journal!=""){
            $sql1="call search_b('$name','$year',$budget,$up,$lo)";
            $result1=mysqli_query($conn,$sql1);
            if(mysqli_num_rows($result1)){
                foreach ($result1 as $row) {
                    $prod[] = $row;
                }
            }  
        }
        echo json_encode($pubd);
    }
//    print json_encode($pubd[0]['Name']);
//    print json_encode($prod);

?>

    

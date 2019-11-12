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
        $dept=mysqli_real_escape_string($conn,$_POST['dept']);
        $year=mysqli_real_escape_string($conn,$_POST['year']);
        if($dept!='0' && $year!=""){
            $sql="select Department,sum(Budget) as Total_Budget from  professor,project,project_own where project.Paper_ID=project_own.paper_ID and professor.User_ID=project_own.User_ID and Department='$dept' and YearofPro='$year'";
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)>0){
                $row=mysqli_fetch_assoc($result);
                echo "<div class='card'><h5 class='card-header text-center font-weight-bold text-uppercase py-4'>Results</h5><div class='card-body'><table class='table table-striped' id='yearbudpro'><thead><tr><th scope='col'>Department</th><th scope='col'>Total_Budget</th></tr></thead><tbody>";
                echo "<tr><th scope='row'>{$row['Department']}</th><td >{$row['Total_Budget']}</td></tr>";
                echo "</tbody></table></div></div>";
            }
            else{
                echo "No records";
            }
        }
        else{
            echo "Fill correctly";
        }
    }
    else{
        echo "error";
    }
    exit();
?>
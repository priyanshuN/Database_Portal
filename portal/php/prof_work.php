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
    if($_GET['action']=='work'){
        $mail=$_POST['email'];
        $sql="select publisher.Paper_ID,publication.Name as PubName,Type,YearofPub,research_area from publisher,publication,professor where publication.Paper_ID=publisher.Paper_ID and professor.User_ID=publisher.User_ID and Acknowledgement='1' and Email='$mail' ";
            //echo $sql;
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)>0){
                echo "<div class='card'><h5 class='card-header text-center font-weight-bold text-uppercase py-4'>Results</h5><div class='card-body'><table class='table table-striped' id='yeartrpub'><thead><tr><th scope='col'>Paper_ID</th><th scope='col'>PubName</th><th scope='col'>ResearchArea</th><th scope='col'>Type</th><th scope='col'>YearofPub</th></tr></thead><tbody>";
                $flag=1;
                while($row=mysqli_fetch_assoc($result)){
                    $pubt[]=$row;
                    echo "<tr><th scope='row'>{$row['Paper_ID']}</th><td >{$row['PubName']}</td><td >{$row['research_area']}</td><td >{$row['Type']}</td><td >{$row['YearofPub']}</td></tr>";
                }
                echo "</tbody></table></div></div>";
            }
            $sql1="select project.Paper_ID,project.Name as ProName,research_area,Budget,YearofPro from  professor,project,project_own where project.Paper_ID=project_own.Paper_ID and professor.User_ID=project_own.User_ID and Acknowledgement='1' and Email='$mail'";
            //echo $sql1;
            $result1=mysqli_query($conn,$sql1);
            if(mysqli_num_rows($result1)>0){
                echo "<div class='card'><h5 class='card-header text-center font-weight-bold text-uppercase py-4'>Results</h5><div class='card-body'><table class='table table-striped' id='yeartrpro'><thead><tr><th scope='col'>Paper_ID</th><th scope='col'>ProName</th><th scope='col'>ResearchArea</th><th scope='col'>Budget</th><th scope='col'>Yearofro</th></tr></thead><tbody>";
                $flag=1;
                while($row=mysqli_fetch_assoc($result1)){
                    $prot[]=$row;
                    echo "<tr><th scope='row'>{$row['Paper_ID']}</th><td >{$row['ProName']}</td><td >{$row['research_area']}</td><td >{$row['Budget']}</td><td >{$row['YearofPro']}</td></tr>";
                }
                echo "</tbody></table></div></div>";
            }
            if($flag==0){
                echo "No results";
            }
        }
    
?>
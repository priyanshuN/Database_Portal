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
    if($_GET['action']=='collab'){
        $mail=mysqli_real_escape_string($conn,$_POST['email']);
        $sql="select User_ID from professor where Email='$mail'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)==1){
            $row=mysqli_fetch_assoc($result);
            $userid=$row['User_ID'];
            $sql1="select pro1.User_ID as GivenUser,pro2.User_ID as Collaborator from project_own as pro1,project_own as pro2 where pro1.Paper_ID=pro2.Paper_ID and pro1.User_ID!=pro2.User_ID and pro1.User_ID='$userid'";
            //echo $sql1;
            $result1=mysqli_query($conn,$sql1);
            if(mysqli_num_rows($result1)>0){
                echo "<div class='card'><h5 class='card-header text-center font-weight-bold text-uppercase py-4'>Results</h5><div class='card-body'><table class='table table-striped' id='colltable'><thead><tr><th scope='col'>GivenUser</th><th scope='col'>Collaborator</th></tr></thead><tbody>";
                while($row=mysqli_fetch_assoc($result1)){
                    echo "<tr><th scope='row'>{$row['GivenUser']}</th><td >{$row['Collaborator']}</td></tr>";  
                }
                echo "</tbody></table></div></div>";
            }
            else{
                echo "No collaborator till now!";
            }
        }
        else{
            echo "User not found";
        }
    }
    else{
        echo "Error";
    }
?>
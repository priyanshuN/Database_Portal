<?php
session_start();
if(!isset($_SESSION['user_id'])){
//                header("Location : http://localhost/Database_Portal/portal/Html/login.php");
    echo "<a href='http://localhost/Database_Portal/portal/Html/login.php'>Login</a>";
    die();
}
$email=$_SESSION['user_id'];
    $dbhost="localhost";
	$dbuser="root";
	$dbpass="mysql";
    $dbname="database_project_cs355";
    
	$conn= mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
    $conn1= new mysqli($dbhost,$dbuser,$dbpass,$dbname);
	if(!$conn){
		die("Connection failed: \n");
	}
    $ncol  = mysqli_real_escape_string($conn,$_POST['ncol']);
    $names  = mysqli_real_escape_string($conn,$_POST['names']);
    $names = json_decode($_POST['names'], true); 
    //echo ($names[0]);
    if($_GET['action']=="insertcheck"){
        if($ncol>0){
            echo"<p>This is the list of names of collaborators .Please make sure of they are correct and click on submit";
            echo"<div class='card'><h5 class='card-header text-center font-weight-bold text-uppercase py-4'>Results</h5><div class='card-body'><table class='table table-striped' id='collt'><thead><tr><th scope='col'>CollaboratorName</th><th scope='col'>Email</th></tr></thead><tbody>";
        }
        for($i=1;$i<=$ncol;$i++){
            $mail=$names[$i-1];
            if(isset($mail)){
                $sql1="select * from professor where Email='$mail'";
                $result1=mysqli_query($conn,$sql1);
                if(mysqli_num_rows($result1)>0){
                    $row=mysqli_fetch_assoc($result1);
                    $prof=$row['Name'];
                    echo"<tr><th scope='row'>$prof</th><td >$mail</td>";
                }
                else{
                    echo"<tr><th scope='row'>Not registered</th><td contenteditable='true'>$mail</td>";
                }
            }
        }
        if($ncol>0){
            echo "</tbody></table></div></div>";
        } 
    }
?>

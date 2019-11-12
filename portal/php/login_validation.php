<?php

session_start();
    $dbhost="localhost";
	$dbuser="root";
	$dbpass="mysql";
	$dbname="database_project_cs355";
	$conn= mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
    $conn1= new mysqli($dbhost,$dbuser,$dbpass,$dbname);
	if(!$conn){
		die("Connection failed: \n");
	}
    $email = $conn->real_escape_string($_POST["email"]);
    $pass  = mysqli_real_escape_string($conn,$_POST['password']);
    if($_GET['action']=="login"){
        $error="";
        if($email==""){
            $error = "Email is required!";
        }
        else if(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
            $error = "Please enter valid email!";
        }
        else if($pass==""){
            $error = "Please enter password!";
        }
        if($error!=""){
            echo $error;
            exit();
        }
        $sql="select Email from login where Email='$email'";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0){
            $sql="select Email from login where Email='$email' and Password='$pass'";
            $result= mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)>0){
                //echo  "success";
                //echo $sql;
               //header('location: thankyou.html');
                $_SESSION['user_id']=$email;
                //$_SESSION['logged']=1;
//                header("Location:http://localhost/Database_Portal/portal/Html/isu.php");
//                exit();
                
            }
            else{
                $error = "Password is incorrect.Please enter again!";
            }
        }
        else{
            $error = "EmailID is not registered.Please enter valid registered emailID !";
        }
        if($error!=""){          
            echo $error;
            exit();
        }
        else{
            echo "";
            exit();
        }
//        else{
//            echo "";
////             header("Location : http://localhost/Database_Portal/portal/Html/isu.php");
//            exit();
//        }
    }


?>

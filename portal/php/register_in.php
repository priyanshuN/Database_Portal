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
    if($_GET['action']=="register"){
        $name=mysqli_real_escape_string($conn,$_POST['name']);
        $email=mysqli_real_escape_string($conn,$_POST['email']);
        $dept=mysqli_real_escape_string($conn,$_POST['dept']);
        $pass=mysqli_real_escape_string($conn,$_POST['password']);
        if($name==""){
            echo "Name Required!";
            exit();
        }
        else if($dept==""){
            echo "Dept Required!";
            exit();
        }
        else if($email==""){
            echo "Email required";
            exit();
        }
        else if(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
            echo  "Please enter valid email!";
            exit();
        }
        else if($pass==""){
            echo "Password Required.";
            exit();
        }
        $sql1="select * from login where Email='$email'";
        $result1=mysqli_query($conn,$sql1);
        if(mysqli_num_rows($result1)>0){
            echo "Email is not available .Try another.";
                exit();
        }
        $sql="insert into login(Email,Password) values('$email','$pass')";
        $result=mysqli_query($conn,$sql);
        if($result){
            //echo"login insert done";
            function generateRandomString($length = 10) {
                return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
            }
            $userid= generateRandomString();
            //echo  generateRandomString();
            $sql1="insert into professor values('$userid','$name','$email','$dept')";
            $result1=mysqli_query($conn,$sql1);
            if($result1){
                echo "Successful Registration.Please return to login page!";
            }
            else{
                echo"Registration Failed!";
            }
        }
        else{
            echo"Insertion Failed";
        } 
    }
    else{
        echo "error";
    }
?>
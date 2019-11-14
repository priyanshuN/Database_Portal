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
    
    if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
        $email = mysqli_real_escape_string($conn,$_GET['email']); // Set email variable
        $hash = mysqli_real_escape_string($conn,$_GET['hash']);
        $type=mysqli_real_escape_string($conn,$_GET['type']);
//        echo $email;// Set hash variable
//        echo $hash;
        $sql2="select * from professor where Email='$email'";
                   $result2=mysqli_query($conn,$sql2);
                   if(mysqli_num_rows($result2)>0){
                       $row=mysqli_fetch_assoc($result2);
                       $userid=$row['User_ID'];
                    }
        else{
            echo "mialid not found!";
            exit();
        }
        if($type==1){
            $sql="select * from publisher where User_ID='$userid' and hash='$hash' and Acknowledgement=0";
    //        echo $sql;
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)>0){
                $sql1="update publisher set Acknowledgement='1' where User_ID='$userid' and hash='$hash'";
    //            echo $sql1;
                $result1=mysqli_query($conn,$sql1);
                if($result1){
                    echo "<div class='statusmsg'>Your link verified</div>";
                }
                else{
                    echo "u failed";
                }
            }
            else{
                echo "<div class='statusmsg'>Your link invalid or already activated.</div>";
            }
        }
        if($type==3){
            $sql="select * from project_own where User_ID='$userid' and hash='$hash' and Acknowledgement=0";
    //        echo $sql;
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)>0){
                $sql1="update publisher set Acknowledgement='1' where User_ID='$userid' and hash='$hash'";
    //            echo $sql1;
                $result1=mysqli_query($conn,$sql1);
                if($result1){
                    echo "<div class='statusmsg'>Your link verified</div>";
                }
                else{
                    echo "u failed";
                }
            }
            else{
                echo "<div class='statusmsg'>Your link invalid or already activated.</div>";
            }
        }
    }
    else{
        echo "<div class='statusmsg'>Your error</div>";
    }
?>
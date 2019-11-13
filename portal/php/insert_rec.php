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
    $name = $conn->real_escape_string($_POST["name"]);
    $res= mysqli_real_escape_string($conn,$_POST['res']);
    $year  = mysqli_real_escape_string($conn,$_POST['year']);
    $budget  = mysqli_real_escape_string($conn,$_POST['budget']);
    $type = $conn->real_escape_string($_POST["type"]);
    $ncol  = mysqli_real_escape_string($conn,$_POST['ncol']);
    $names  = mysqli_real_escape_string($conn,$_POST['names']);
    $names = json_decode($_POST['names'], true); 
    //echo ($names[0]);
    if($_GET['action']=="insert"){
        $error="";
        if($name==""){
            $error = "Name is required";
        }
        else if($year==""){
            $error = "Year is required";
        }
        else if($res==""){
            $error="Research area required";
        }
        else if($budget=="" && $type==3){
            $error = "Budget is required";
        }
        if($error!=""){
            echo $error;
            exit();
        }
        $sqlid="select * from professor where Email='$email'";
        //echo $sqlid;
        $resultid=mysqli_query($conn,$sqlid);
        if(mysqli_num_rows($resultid)){
            $row=mysqli_fetch_assoc($resultid);
            $id=$row['User_ID'];
        }
        else{
            echo "userid not found";
        }
        if($type==1){
            $ma="select max(Paper_ID * 1) as Paper_ID from publication";
            $resultma=mysqli_query($conn,$ma);
            $row=mysqli_fetch_assoc($resultma);
            $pid=$row['Paper_ID'];
            $pid+=1;
            $sqlm="insert into publication values('$pid','$name','paper','$year','$res')";
            $sqla="insert into publisher values('$id','$pid','1','asewdead')";
            
            $resultm=mysqli_query($conn,$sqlm);
            $resulta=$conn1->query($sqla);
//            echo $sqla;
//            echo $sqlm;
        }
        elseif($type==2){
            $ma="select max(Paper_ID * 1) as Paper_ID from publication";
            $resultma=mysqli_query($conn,$ma);
            $row=mysqli_fetch_assoc($resultma);
            $pid=$row['Paper_ID']+1;
            $sqlm="insert into publication values('$pid','$name','journal','$year','$res')";
            $sqla="insert into publisher values('$id','$pid','1','asewdead')";
            $resultm=mysqli_query($conn,$sqlm);
            $resulta=$conn1->query($sqla);
            
        }
        if($type==3){
            $ma="select max(Paper_ID * 1) as Paper_ID from project";
            $resultma=mysqli_query($conn,$ma);
            $row=mysqli_fetch_assoc($resultma);
            $pid=$row['Paper_ID']+1;
            $sqlm="insert into project values('$pid','$name',$budget,'$year','$res')";
            $sqla="insert into project_own values('$id','$pid','1','asewdead')";
            $resultm=mysqli_query($conn,$sqlm);
            $resulta=$conn1->query($sqla);
           
        }
        
        if($resultm && $resulta){
            echo "Inserted";
            for($i=1;$i<=$ncol;$i++){
                $mail=$names[$i-1];
                if(isset($mail)){
                    $hash=md5(rand(0,1000));
                   $sql1="select * from professor where Email='$mail'";
                   $result1=mysqli_query($conn,$sql1);
                   if(mysqli_num_rows($result1)>0){
                       $row=mysqli_fetch_assoc($result1);
                       $userid=$row['User_ID'];
                       if($type==1 || $type==2){
                            $sqlp="insert into publisher values('$userid','$id','0','$hash')";
                            $resultp=mysqli_query($conn,$sqlp);
                //        echo $sql;
                           if($result){
                            $to='$mail';
                            $subject='Link validation check';
                            $message="PLease click the link http://localhost/Database_Portal/portal/php/linkredirect.php?email=$mail&hash=$hash";
                            $headers='From:"abc@rediff.com'."\r\n";
                            echo $message;
                                if(mail($to,$subject,$message,$headers)){
                                    echo"Message sent successfully";
                                }
                                else{
                                    echo "Message not sent";
                                }
                            }
                            else{
                                echo"query";
                            }
                       }
                       elseif($type==3){
                           $sqlpr="insert into project_own values('$userid','$id','0','$hash')";
                           $resultpr=mysqli_query($conn,$sqlpr);
                           if($result){
                            $to='$mail';
                            $subject='Link validation check';
                            $message="PLease click the link http://localhost/Database_Portal/portal/php/linkredirect.php?email=$mail&hash=$hash";
                            $headers='From:"abc@rediff.com'."\r\n";
                            echo $message;
                                if(mail($to,$subject,$message,$headers)){
                                    echo"Message sent successfully";
                                }
                                else{
                                    echo "Message not sent";
                                }
                            }
                            else{
                                echo"query";
                            }
                       }
                    }
                    else{
                        echo"No user";
                    }
                }
                else{
                    echo"mail empty";
                }
            }
        }
        else{
            echo "insert again";
        }     
    }
?>

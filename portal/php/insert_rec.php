<?php
    $dbhost="localhost";
	$dbuser="root";
	$dbpass="mysql";
    $dbname="database_project_cs355";
    echo "hi";
    
	$conn= mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
    $conn1= new mysqli($dbhost,$dbuser,$dbpass,$dbname);
	if(!$conn){
		die("Connection failed: \n");
	}
    $name = $conn->real_escape_string($_POST["name"]);
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
            $error = "year is required";
        }
        else if($budget=="" && $type==3){
            $error = "budget is required";
        }
        if($error!=""){
            echo $error;
            exit();
        }
        if($type==1){
            $sqlm="insert into publication values('$id','$name','paper','$year')";
        }
        elseif($type==2){
            $sqlm="insert into publication values('$id','$name','journal','$year')";
        }
        if($type==3){
            $sqlm="insert into project values('$id','$name',$budget,'$year')";
            //$sql3="insert into project_own values('$id','$email','1')";
        }
        $resultm=mysqli_query($conn,$sqlm);
        if($resultm){
            
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
                            $message="PLease click the link http://localhost/Database_Portal/portal/php/linkredirect.php?email=$email&hash=$hash";
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
                            $message="PLease click the link http://localhost/Database_Portal/portal/php/linkredirect.php?email=$email&hash=$hash";
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

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
    echo ($names[0]);
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
//        $id="171";
//        $email="mak";
//        if($type==1)
//        $sql="insert into publication values('$id','$name','publication','$year')";
//        if($type==2)
//        $sql="insert into publication values('$id','$name','journal','$year')";
//        if($type==3)
//        $sql="insert into project values('$id','$name',$budget,'$year')";
//        $sql3="insert into project_own values('$id','$email','YES')";
        for($i=1;$i<=$ncol;$i++){
            $to=$names[$i-1];
            echo $to;
            $subject='Submit confirmation';
            $message=" is being entered if its yours please click on the click.  ";
            $headers='From:abc@gmail.com'."\r\n";
            mail($to,$subject,$message,$headers);
            
        }
//        if($ncol>0)
//        {
//            for($i=1;$i<=$ncol;$i++)
//            {
//                $temp=$names[$i-1];
//                $sql2="insert into project_own values('$id','$temp','NO')";
//                $result2 = mysqli_query($conn,$sql2);
//                if(($result2 )>0){
//                    echo  "success";
//                    $to=$names[i-1];
//                    echo $to;
//                    $subject='Submit confirmation';
//                    $message="'$name' is being entered if its yours please click on the click.  ";
//                    $headers='From:abc@gmail.com'."\r\n";
//                    mail($to,$subject,$message,$headers);
//                }
//                else{
//                $error = "Data entered is not correct";
//                }
//            }
//        }
//        echo $sql,$sql2,$sql3;
//        $result = mysqli_query($conn,$sql);
//        $result3 = mysqli_query($conn,$sql3);
//        if(($result )>0){
//                echo  "success";
//        }
//        else{
//            $error = "Data entered is not correct1";
//        }
//        if(($result3 )>0){
//            echo  "success";
//        }
//        else{
//            $error = "Data entered is not correct2";
//        }
//        
//        
//        if($error!=""){
//            echo $error;
//            exit();
//        }
//        else{
//            //echo "success";
//            exit();
//        }
    }
?>

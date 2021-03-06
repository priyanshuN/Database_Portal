<?php 
session_start();
//echo $_SESSION['user_id'];

?>
<html>
    <head>
        <title>Project/Publication upload portal</title>
        <!-- Required meta tags always come first -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js">
        </script>
    </head>
    
    <body>
        <!-- Login Page-->
        
        <div class="container w-25 p-3" id="wrap">
            <!--p><strong>Please login in to continue.</strong></p-->
            <div class='card border-dark'><h6 class='card-header text-center py-4'>Please login in to continue</h6><div class='card-body'>
            <div class="alert alert-danger" role="alert" id="loginAlert" style="display:none;"></div>
            <div class="form-group">
                <input class="form-control" id="email" name="email" type="email" placeholder="priyanshu.cs17@iitp.ac.in">
            </div>
            <div class="form-group">
                <input class="form-control" id="password" name="password" type="password" placeholder="Password" >
            </div>
            <button type="submit" id="Login" class="btn btn-success">Login</button>
            
                <button class="btn btn-link" id="register" type="submit">Register</button>
            
        </div>
            </div>
        </div>
        
        <script type="text/javascript">
            $("#Login").click(function(){
                $.ajax({
                    type:"POST",
                    url : "../php/login_validation.php/?action=login",
                    /*data : "email="+$("#email").val()+"&password="+$("#password").val(),*/
                    data:{
                        email:$("#email").val(),
                        password:$("#password").val()
                    },
                    dataType: "html",
                    success:function(result){
                        if(result != ""){
                            $("#loginAlert").html(result);
                            $("#loginAlert").show();
                        }
                        else{
                            $("#loginAlert").hide();
                            window.location.href = 'isu.php';
                        }
                    }
                })
            });
            $('#register').click(function(){
                window.location.href = 'register.php';
            })
        </script>
    </body>
</html>
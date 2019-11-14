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
        <?php
            if(!isset($_SESSION['user_id'])){
//                header("Location : http://localhost/Database_Portal/portal/Html/login.php");
                echo "<a href='http://localhost/Database_Portal/portal/Html/login.php'><h4 align='center'>Login<p>Please login first to access this page.</p><p>Click on the link to be directed to login page</p></h4></a>";
                die();
            }
        
        ?>
        <button type="submit" class='btn btn-info btn-sm' id='logout'>Logout</button>
        <div class="container" id="wrap">
            <div class='card'><h6 class='card-header text-center py-4'>Click to perform operation</h6><div class='card-body'>
            <button type="submit" class="btn btn-secondary" id="insert">Insert</button>
            <button type="submit" class="btn btn-secondary" id="search">Search</button>
            <button type="submit" class="btn btn-secondary" id="update">Update</button>
            </div>
            </div>
        </div>
        
        <script type="text/javascript">
            $(function(){
               $('#insert').click(function(){
                    window.location.href = 'insert.php';
               }); 
            });
            $(function(){
               $('#search').click(function(){
                    window.location.href = 'search.php';
               }); 
            });
            $(function(){
               $('#update').click(function(){
                    window.location.href = 'update.php';
               }); 
            });
            $(function(){
               $('#logout').click(function(){
                   window.location.href = 'logout.php';
                   
               }) ;
            });
        </script>
    </body>
</html>

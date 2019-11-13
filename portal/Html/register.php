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
        <div class="container" id="wrap">
            <!--p><strong>Please enter details to register.</strong></p-->
            <div class='card border-dark'><h6 class='card-header text-center py-4'>Please enter details</h6><div class='card-body'>
            <div class="alert alert-danger" role="alert" id="loginAlert" style="display:none;"></div>
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" id="name" name="name" type="name" placeholder="Priyanshu Nandan">
            </div>
            <div class="form-group">
                <label for="dept">Select department</label>
                <select class="custom-select" id="dept">
                    <option value="0" selected>Select department</option>
                    <option value="CS">CS</option>
                    <option value="ME">ME</option>
                    <option value="EE">EE</option>
                    <option value="CE">CE</option>
                    <option value="CH">CH</option>
                    <option value="MC">MC</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">Enter Email</label>
                <input class="form-control" id="email" name="email" type="email" placeholder="priyanshu.cs17@iitp.ac.in">
            </div>
            <div class="form-group">
                <label for="password">Enter Strong Password</label>
                <input class="form-control" id="password" name="password" type="password" placeholder="Password">
            </div>
            <button type="submit" id="register" class="btn btn-success">Register</button>
            <button class="btn btn-link" id="login">Login</button>
        </div>
            </div>
        </div>
        <script type="text/javascript">
            $("#register").click(function(){
                $.ajax({
                    type:"POST",
                    url:"../php/register_in.php/?action=register",
                    data:{
                        name:$("#name").val(),
                        email:$('#email').val(),
                        dept:$('#dept').val(),
                        password:$('#password').val()
                    }
                })
                    .done(function(result){
                        if(result!=""){
                            $('#loginAlert').html(result);
                            $('#loginAlert').show();
                        }
                        else{
                            $('#loginAlert').hide();
                        }
                    })
            })
            $('#login').click(function(){
                window.location.href = 'login.php';
            })
        </script>
    </body>
</html>
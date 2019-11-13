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
                echo "<a href='http://localhost/Database_Portal/portal/Html/login.php'>Login</a>";
                die();
            }
        
    ?>
      <button class="btn btn-light" id="home" type="submit">Home</button>
        <button class="btn btn-info" id="logout" type="submit">Logout</button>
    <div class="container w-30 p-3" id="wrap">
        <div class='card'><h6 class='card-header text-center py-4'>Please fill the details</h6><div class='card-body'>
        <div class="form-group">
            <div class="alert alert-danger" id='insertdiv' style="display:none;"></div>
            <label for="type">Select Type of Submission</label>
            <select class="custom-select" id="type">
                <option value="0" selected>Select type</option>
                <option value="1">Paper</option>
                <option value="2">Journal</option>
                <option value="3">Project</option>
            </select>
        </div>
        <div class="form-group">
            <label for="name">Publication/Project Name</label>
            <input class="form-control" id="name" name="name" type="text" placeholder="Submission name">
        </div>
        <div class="form-group">
            <label for="res">Research Area</label>
            <select class="custom-select" id="res">
                <option value="0" selected>Select type</option>
                <option value="DBMS">DBMS</option>
                <option value="ML">ML</option>
                <option value="Blockchain">Blockchain</option>
                <option value="Robotics">Robotics</option>
            </select>
        </div>  
        <div class="form-group">
            <label for="year">Year</label>
            <input class="form-control" id="year" name="year" type="text" placeholder="eg. 2008">
        </div>
        <div class="form-group" id="budg" style="display: none;">
            <label for="budget">Budget</label>
            <input class="form-control" id="budget" name="budget" type="text" placeholder="eg. 200520">
        </div>
        <div class="form-group">
            <label for="ncoll">Enter the number of collaborators.</label>
            <select id="ncoll"></select>
        </div>
        <div class="form-group" id="collab_box" style="display:none;">
            <!--
                <label for="cname">Collaborator Name</label>
                <input class="form-control" id="cname" name="cname" type="text" placeholder="Collaborator Name">
                <label for="cmail">Collaborator Email</label>
                <input class="form-control" id="cmail" name="cmail" type="text" placeholder="collaborator@iitp.ac.in">
-->
        </div>
        <div class="form-group" id="sub">
            <button type="submit" class="btn btn-secondary" id="csubmit">Submit</button>
        </div>
        </div>
        </div>
    </div>

    <script type="text/javascript">
    
        $('#csubmit').click(function (event) {
            event.preventDefault();
            
            var k = parseInt($("#ncoll").val(), 10);
            names = [];
            var el;
            var prefix = 'cmail';
            console.log(k);
            for (var i = 1; i<=k; i++) {
                names[i-1]= document.getElementById(prefix + i).value;
                document.getElementById(prefix + i).value;
                }
            

            console.log(names);
            $.ajax({
                type: "POST",
                url: "../php/insert_rec.php/?action=insert",
                data: {
                    name: $('#name').val(),
                    res:$('#res').val(),
                    year: $('#year').val(),
                    budget: $('#budget').val(),
                    type: $("#type").val(),
                    ncol: $("#ncoll").val(),
                    names: JSON.stringify(names)
                    
                    //    ncol:
                }

            })
                .done(function (result) {
                    if (result != "") {
                        $('#insertdiv').html(result);
                        $('#insertdiv').show();
                    }
                    else {
//                        $('#checkAlert').html(result);
                        $('#insertdiv').hide();
                    }
                })
                .fail(function (xhr, status, error) {
                    var err = xhr.status + ': ' + xhr.statusText;
                    alert('Error : ' + err);
                })
        });

        $(function () {
            $('input[placeholder], textarea[placeholder]').blur();
            $('#type').change(function () {
                var k = $(this).val();
                if (k == '0') {
                    $("#name").attr("placeholder", "Submission Name").blur();
                }
                else if (k == '1') {
                    $("#name").attr("placeholder", "Enter paper name").blur();
                }
                else if (k == '2') {
                    $("#name").attr("placeholder", "Enter journal name").blur();
                }
                else if (k == '3') {
                    $("#name").attr("placeholder", "Enter project name").blur();
                }
            });
        });
        $(function () {
            $("#type").change(function () {
                var k = $(this).val();
                if (k == '3') {
                    $("#budg").show();
                }
                else {
                    $("#budg").hide();
                }
            });
        });
        (function () { // don't leak
            var elm = document.getElementById('ncoll'), // get the select
                df = document.createDocumentFragment(); // create a document fragment to hold the options while we create them
            for (var i = 0; i <= 20; i++) { // loop, i like 42.
                var option = document.createElement('option'); // create the option element
                option.value = i; // set the value property
                option.appendChild(document.createTextNode(i)); // set the textContent in a safe way.
                df.appendChild(option); // append the option to the document fragment
            }
            elm.appendChild(df); // append the document fragment to the DOM. this is the better way rather than setting innerHTML a bunch of times (or even once with a long string)
        }());
        $(function () {
            $("#ncoll").change(function () {
                $("#collab_box").empty();
                var k = parseInt($(this).val(), 10);
                for (var i = 1; i <= k; ++i) {
                    $("#collab_box").append('<label for=cmail' + i + '>Collaborator Email</label><input class="form-control" id=cmail' + i + ' name=cmail' + i + ' type="text" placeholder="collaborator@iitp.ac.in">')
                }
                if (k > 0) {
                    /*$("#sub").append('<button type="submit" class="btn btn-secondary" id="csubmit">Submit</button>');
                    $("#sub").show();*/
                    $("#collab_box").show();
                }
                if (k == 0) {
                    //$("#sub").hide();
                    $("#collab_box").hide();
                }
            });
        });
        $("#home").click(function(){
            window.location.href = 'isu.php'; 
        });
        $("#logout").click(function(){
            window.location.href = 'logout.php'; 
        });
        
    </script>
</body>

</html>
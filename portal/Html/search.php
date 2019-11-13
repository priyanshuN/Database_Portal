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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <!-- jQuery UI library -->
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
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
        <div class="container" id ="wrap">
            <input type="checkbox" id="c1">Name
            <input type="checkbox" id="c2">Paper
            <input type="checkbox" id="c3">Journal
            <input type="checkbox" id="c4">Project
            <input type="checkbox" id="c5">Year
            <input type="checkbox" id="c6">Budget
        </div>
        <div class="container" id="wrap">
            <div class="form-group" style="display:none;" id="dname">
                <label for="name">Name</label>
                <input class="form-control" id="name" name="name" type="text" placeholder="Submission name">
            </div>
            <div class="form-group" style="display:none;" id="dyear">
                <label for="year">Year</label>
                <input class="form-control" id="year" name="year" type="text" placeholder="eg. 2008">
            </div>
            <div class="form-group" id="dbudg" style="display: none;" >
                <label for="budget">Budget</label>
                <input class="form-control" id="budget" name="budget" type="number" placeholder="eg. 200520">
                <p>Want to specify range</p>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="ll">Lower range</label>
                        <input type="number" id="ll" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ul">Upper range</label>
                        <input type="number" id="ul" class="form-control">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-secondary btn-sm" id="csubmit">Submit</button>
            <div id="srec" style="display:none;"></div>
            <br>
            <div class="form-row">
                <div class="form-group col-md-6">
                        <label for="ye">Select year for trend</label>
                        <select class="custom-select" id="ye">
                            <option value="0" selected>Select Year</option>
                            <option value="2019">2019</option>
                            <option value="2018">2018</option>
                            <option value="2017">2017</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="prof">Enter professor Email</label>
                        <input type="email" id="prof" class="form-control">
                    </div>
            </div>
            <button type='submit' class="btn btn-secondary btn-sm" id="btrend">Trend</button>
            <div id="ytrend" style="display:none;"></div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for='deptbudg'>Select department </label>
                    <select class="custom-select" id="deptbudg">
                        <option value="0" selected>Select department</option>
                        <option value="CS">CS</option>
                        <option value="ME">ME</option>
                        <option value="EE">EE</option>
                        <option value="CE">CE</option>
                        <option value="CH">CH</option>
                        <option value="MC">MC</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="budyr">Enter Year</label>
                    <input type="text" id="budyr" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-secondary btn-sm" id="btdeptbud">Submit</button>
            <div id="deptbudbox" style="display:none;"></div>
            <label for='collis'>Enter professor email id for collaborators list</label>
            <div class="form-row">
                <div class="form-group col-md-9">
                    <input type="email" id="collis" placeholder='priyanshu.cs17@iitp.ac.in' class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-secondary" id='collisbtn'>Submit</button>
                </div>
            </div>
            <div id="collisdiv" style="display:none;"></div>
        </div>
        <div id="chart-container">
            <canvas id="graphCanvas"></canvas>
        </div>
        <script type="text/javascript">
         
            $(function(){
                $('#c1').change(function(){
                    var c1=$('#c1').prop('checked');
                    if(c1){
                        $('#dname').show();
                        $('#name').autocomplete({
                            source:"../php/autocomplete.php",
                            select:function(event,ui){
                                event.preventDefault();
                                $('#name').val(ui.item.id);
                                console.log(ui.item.id);
                            }
                        });
                    }
                    else{
                        $('#dname').hide();
                    }
                });
                $('#c5').change(function(){
                    var c5=$('#c5').prop('checked');
                    if(c5){
                        $('#dyear').show();
                    }
                    else{
                        $('#dyear').hide();
                    }
                });
                 /*$('#c4').change(function(){
                    var c4=$('#c4').prop('checked');
                    if(c4){
                        $('#db').show();
                    }
                    else{
                        $('#db').hide();
                    }
                });*/
                $('#c6').change(function(){
                    var c6=$('#c6').prop('checked');
                    if(c6){
                        $('#dbudg').show();
                    }
                    else{
                        $('#dbudg').hide();
                    }
                });
                $('#csubmit').click(function(){
                    var c1=$('#c1').prop('checked');
                    var c2=$('#c2').prop('checked');
                    var c3=$('#c3').prop('checked');
                    var c4=$('#c4').prop('checked');
                    var c5=$('#c5').prop('checked');
                    var c6=$('#c6').prop('checked');
                    
                    if(c1 || c2 || c3 || c4 || c5 || c6){
                        $('#submitAlert').html("Success");
                        $('#submitAlert').show();
                    }
                    else{
                         $('#submitAlert').html("Please check one of the box");
                        $('#submitAlert').show();
                    }
                });
                $('#csubmit').click(function(){
                    var na,pa,jo,pr,ye,bu,lo,up;
                    var c1=$('#c1').prop('checked');
                    var c2=$('#c2').prop('checked');
                    var c3=$('#c3').prop('checked');
                    var c4=$('#c4').prop('checked');
                    var c5=$('#c5').prop('checked');
                    var c6=$('#c6').prop('checked');
                    if(c1){
                        console.log(1);
                        na=$('#name').val();
                    }
                    else{
                        na="";
                    }
                    if(c2){
                        pa='paper';
                    }
                    else{
                        pa="";
                    }
                    if(c3){
                        jo='journal';
                    }
                    else{
                        jo="";
                    }
                    if(c4){
                        pr='project';
                    }
                    else{
                        pr="";
                    }
                    if(c5){
                        ye =$('#year').val();
                    }
                    else{
                        ye="";
                    }
                    if(c6){
                        bu=$('#budget').val();
                        lo=$('#ll').val();
                        up=$('#ul').val();
                        if($('#budget').val()=="")
                            bu=-1;
                        if(lo=="")
                            lo=-1;
                        if(up=="")
                            up=-1;
                    }
                    else{
                        bu=-1;
                        lo=-1;
                        up=-1;
                    }
                    /*if($('#budget').val()=="")
                        console.log(1);
                        console.log($('#budget').val());*/
                    $.ajax({
                       type:'POST',
                        url:'../php/search_d.php/?action=search',
                        data:{
                            name:na,
                            paper:pa,
                            journal:jo,
                            project:pr,
                            year:ye,
                            budget:bu,
                            lower:lo,
                            upper:up
                        }
                    })
                    .done(function(result){
                        if(result!=""){
                            $('#srec').html(result);
                            $('#srec').show();
                        }
                        else{
                           $('#srec').html("No records for the query");
                        }
                    })
                    .fail(function(xhr,status,error){
                        var err=xhr.status + ': ' + xhr.statusText;
                        alert('Error : '+err);
                    })
                    $.ajax({
                       type:'POST',
                        url:'../php/chart.php/?action=chart',
                        data:{
                            name:na,
                            paper:pa,
                            journal:jo,
                            project:pr,
                            year:ye,
                            budget:bu,
                            lower:lo,
                            upper:up
                        }
                    })
                    .done(function(data){
                        console.log(data);
                        var name = [];
                        var marks = [];
                        var data1=JSON.parse(data);
                        console.log(data);
                         for (var i=0;i<data1.length;++i) {
                            name.push(data1[i]['Name']);
                            marks.push(data1[i]['YearofPub']);
                        }
                        console.log(name);
                        console.log(marks);
                        var chartdata = {
                            labels: name,
                            datasets: [
                                {
                                    label: 'Student Marks',
                                    backgroundColor: '#49e2ff',
                                    borderColor: '#46d5f1',
                                    hoverBackgroundColor: '#CCCCCC',
                                    hoverBorderColor: '#666666',
                                    data: marks
                                }
                            ]
                        };

                        var graphTarget = $("#graphCanvas");

                        var barGraph = new Chart(graphTarget, {
                            type: 'bar',
                            data: chartdata
                        });
                    })
                    .fail(function(xhr,status,error){
                        var err=xhr.status + ': ' + xhr.statusText;
                        alert('Error : '+err);
                    })
                });
                $('#btrend').click(function(){
                    $.ajax({
                       type:"POST",
                        url:"../php/yeartrend.php/?action=trend",
                        data:{
                            year:$('#ye').val(),
                            pmail:$('#prof').val()
                        }
                    })
                    .done(function(result){
                        if(result!=""){
                            $('#ytrend').html(result);
                            $('#ytrend').show();
                        }
                        else{
                            $('#ytrend').hide();
                        }
                    })
                });
                $('#btdeptbud').click(function(){
                   $.ajax({
                       type:"POST",
                       url:"../php/deptbudg.php/?action=budget",
                       data:{
                           dept:$('#deptbudg').val(),
                           year:$('#budyr').val()
                       }
                   })
                    .done(function(result){
                        if(result!=""){
                            $('#deptbudbox').html(result);
                           $('#deptbudbox').show();
                       }
                       else{
                           $('#deptbudbox').hide();
                       }
                   })
                });
                $('#collisbtn').click(function(){
                    console.log(1);
                   $.ajax({
                       type:"POST",
                       url:"../php/collab_trend.php/?action=collab",
                       data:{
                           email:$('#collis').val()
                       }
                   })
                    .done(function(result){
                       if(result!=""){
                           $('#collisdiv').html(result);
                            $('#collisdiv').show();
                       }
                       else{
                            $('#collisdiv').hide();
                       }
                   })
                });
                $("#home").click(function(){
                   window.location.href = 'isu.php'; 
                });
                $("#logout").click(function(){
                   window.location.href = 'logout.php'; 
                });
//                var cn56=$('#c1').prop('checked');
//                if(cn56){
//                    console.log(123);
//                    $('#name').autocomplete({
//                        source:"../php/autocomplete.php",
//                        select:function(event,ui){
//                            event.preventDefault();
//                            $('#name').val(ui.item.id);
//                            console.log(ui.item.id);
//                        }
//                    });
//                }
            });
        </script>
    </body>
</html>
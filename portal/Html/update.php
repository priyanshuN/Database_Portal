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
        <div class="container w-50 p-3" id="wrap">
            <div class='card'><h6 class='card-header text-center py-4'>Please enter details to search</h6><div class='card-body'>
            <div class="alert alert-danger" role="alert" id="checkAlert" style="display:none;"></div>
            <div class="form-group">
                <label for='uname'>Enter the name of Publication/Project</label>
                <input class="form-control" id="uname" name="uname" type="text" placeholder="Submission name">
            </div>
            <div class="form-group">
                <label for="type">Select Type </label>
                <select class="custom-select" id="type">
                    <option value="0" selected>Select type</option>
                    <option value="Paper">Paper</option>
                    <option value="Journal">Journal</option>
                    <option value="Project">Project</option>
                </select>
            </div>
             <button id="usubmit" class="btn btn-secondary" type="submit">Check</button>
            <div id="tab" style="display:none;">
                
            </div>
            <br><button id='upd' class='btn btn-secondary' type='submit' style="display:none;">Update</button>
            <div id="updfin" style="display:none;">
            </div>
            </div>
        </div>
        
        <script type="text/javascript">
            $(function(){
                $('#uname').autocomplete({
                            source:"../php/autocomplete.php",
                            select:function(event,ui){
                                event.preventDefault();
                                $('#uname').val(ui.item.value);
                                console.log(ui.item.id);
                            }
                        });
            });
            $('#usubmit').click(function(){
                //console.log(1);
               $.ajax({
                   type:"POST",
                   url:"../php/update_check.php/?action=check",
                   data:{
                       ubname:$('#uname').val(),
                       type:$('#type').val() 
                   }
                })
                .done(function(result){
                    if(result!=""){
                        $('#tab').html(result);
                        $('#tab').show();
                        $('#upd').show();
                    }
                    else{
                        $('#checkAlert').html(result);
                    }
                })
                .fail(function(xhr,status,error){
                    var err=xhr.status + ': ' + xhr.statusText;
                    alert('Error : '+err);
                }) 
                
            });
            $('#upd').click(function(){
                    console.log(1);
//                   alert($('#rectable').rows[0].val()); 
                var tab=document.getElementById('rectable')
                var rl=tab.rows.length;
                if($('#type').val()=='Paper'||$('#type').val()=='Journal'){
                    for(var i=1;i<2;++i){
                        var col=tab.rows.item(i).cells;
                        var cl=col.length;
                        for(var j=1;j<cl;++j){
                            var val=col.item(j).innerHTML;
                            console.log(val);
                        }
                        var id=col.item(0).innerHTML;
                        var una=col.item(1).innerHTML;
                        var yr=col.item(3).innerHTML;
                        var res=col.item(4).innerHTML;
                        $.ajax({
                            type:"POST",
                            url:"../php/update_final.php/?action=update",
                            data:{
                                id:id,
                                type1:$('#type').val(),
                                name:una,
                                year:yr,
                                res:res
                            }
                        })
                        .done(function(result){
                            if(result!=""){
                                $('#updfin').html(result);
                                $('#updfin').show();
                            }
                            else{
                                $('#updfin').hide();
                            }
                        })
                    }
                }
                if($('#type').val()=='Project'){
                    for(var i=1;i<2;++i){
                        var col=tab.rows.item(i).cells;
                        var cl=col.length;
                        for(var j=1;j<cl;++j){
                            var val=col.item(j).innerHTML;
                            console.log(val);
                        }
                        var id=col.item(0).innerHTML;
                        var una=col.item(1).innerHTML;
                        var bud=col.item(2).innerHTML;
                        var yr=col.item(3).innerHTML;
                        var res=col.item(4).innerHTML;
                        $.ajax({
                            type:"POST",
                            url:"../php/update_final.php/?action=update",
                            data:{
                                id:id,
                                type1:'Project',
                                name:una,
                                budget:bud,
                                year:yr,
                                res:res
                            }
                        })
                        .done(function(result){
                            if(result!=""){
                                $('#updfin').html(result);
                                $('#updfin').show();
                            }
                            else{
                                $('#updfin').hide();
                            }
                        })
                    }
                }
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
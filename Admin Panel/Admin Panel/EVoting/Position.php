<?php
	session_start();
	if($_SESSION["username"]=="")
{
	header("Location:index.php");
}
?>
<html>
<title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- Styles -->
    <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/compiled/bootstrap-overrides.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="css/compiled/theme.css" />

    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css' />

    <link rel="stylesheet" href="css/compiled/about.css" type="text/css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/lib/animate.css" media="screen, projection" />
    <link rel="stylesheet" href="css/lib/flexslider.css" type="text/css" media="screen" />

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	</head>
	<body>
 <div class="navbar navbar-inverse navbar-static-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="index.php" class="navbar-brand"><strong>E-Voting App</strong></a>
            </div>
			 <div class="collapse navbar-collapse navbar-ex1-collapse" role="navigation">
                 <ul class="nav navbar-nav navbar-right">
                     <li><a href="index.php">HOME</a></li>
					 <li><a href="UserDetails.php">USER DETAILS</a></li>
					<li class="active"><a href="Position.php">POSITION DETAILS</a></li>
                    <li><a href="Candidate.php">CANDIDATE DETAILS</a></li>
					<li><a href="Forum.php">FORUM DETAILS</a></li>
					<li><a href="Result.php">RESULT DETAILS</a></li>
					<li><a href="ChangePassword.php">CHANGE PASSWORD</a></li>
                   <li><a href="logout.php">LOGOUT</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div id="aboutus">
        <div class="container">
            <div class="section_header">
                <h3>Position Details</h3>
            </div>
            <div class="row">
                <div class="col-sm-12 intro">
			
				<table>
<tr><td><label>Position:</label></td>
<td><input type="text" name="Position" id="txtPosition" class="form-control" values=""></td>
</tr>

<tr><td><input type="submit" name="submit" id="btnSubmit" class="form-control" value="Add" placeholder="Position" onclick="return addPositionDetails()"></td>
</tr>
<tr><td><input type="hidden" id='hdnId'></td></tr></table>
					<table id="tblRule" width='100%' border="2">
						</table>
				
	<script type="text/javascript" src="jquery.min.js"></script>
	<script>
		$(function(){
			PositionDetails();
		});
		
		function PositionDetails(){
		$.post('PositionDetails.php',{}).done(function(data){
			$("#tblRule").html(data);
		});
	  }
	  
	  function addPositionDetails(){
		var Position=$("#txtPosition").val();
		if(Position==""){
			alert("Please Enter Position");
		}
		
		else{
			var submit=$("#btnSubmit").val();
			if(submit=="Add"){
				$.ajax({
					type:"POST",
					url:"addPositionDetails.php",
					data:{Position:Position,submit:submit},
					success:function(response){
					console.log(response);
						if(response=="success"){
							alert("Position Saved Successfully");
							$("#txtPosition").val("");
							PositionDetails();
						}
						else if(response=="Exist"){
						alert("Position Already Exist");
						 $("#txtPosition").val("");
						 PositionDetails();
						}
						else{
							alert("Position Not Saved");
							
							$("#txtPosition").val("");
								PositionDetails();
						}
					}
				});
			}
			else
			{
				$.ajax({
					type:"POST",
					url:"addPositionDetails.php",
					data:{Position:Position,submit:submit,id:$("#hdnId").val()},
					success:function(response){
						console.log(response);
						if(response=="success"){
							alert("Position Details Updated Successfully");
							$("#txtPosition").val("");
						$("#btnSubmit").val("Add");
					PositionDetails();
						}
						else if(response=="Exist"){
						alert("Position Already Exist");
						 $("#txtPosition").val("");
						 $("#btnSubmit").val("Add");
						 PositionDetails();
						}
						else{
							alert("Position Details Not Updated");
							$("#txtPosition").val("");
								$("#btnSubmit").val("Add");
					PositionDetails();
						}
					}
				});
			}
		}
	}
		
	  function updateDetails(id){
		$("#hdnId").val(id);
		$("#txtPosition").val($('#Position'+id).html());
		$("#btnSubmit").val("Edit");
		}
	  
	  function deleteDetails(id){
		$.ajax({
			type:"POST",
			url:"deletePositonDetails.php",
			data:{id:id},
			success:function(response){
				if(response=="success"){
					alert("Position Details Deleted Successfully");
					$("#txtPosition").val("");
					$("#btnSubmit").val("Add");
				PositionDetails();
				}
				else{
					alert("Position Details Not Deleted");
					$("#txtPosition").val("");
					$("#btnSubmit").val("Add");
				PositionDetails();
				}
			}
		});
	  }
	  </script>
	</div>
        </div>
    </div>
 </div>
    <footer id="footer">
        
                
                    
                        <div class="col-md-12">
                            &copy; 2015-2016 E-Voting App. All rights reserved.
                        </div>
                    
            
       
    </footer>
    
    

    <script src="code.jquery.com/jquery-latest.js">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/theme.js"></script>
    <script type="text/javascript" src="js/flexslider.js"></script>
	</body>
	</html>
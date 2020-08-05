<?php
	session_start();
	if($_SESSION["username"]=="")
{
	header("Location:index.php");
}
?>
	<html>
	<head>
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
					 <li class="active"><a href="UserDetails.php">USER DETAILS</a></li>
					<li><a href="Position.php">POSITION DETAILS</a></li>
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
                <h3>User Details</h3>
            </div>
            <div class="row">
                <div class="col-sm-12 intro">
			
		<table>
		
		<tr><td><label>Select Status</label></td><td><select id="status" class="form-control"  name="Status">
	<option value="">Select Status</option>
	<option value="ON">ON</option>
	<option value="OFF">OFF</option>
	</select></td></tr>
		<tr><td><input type="submit" name="submit" id="btnSubmit" class="form-control" value="Update"  onclick="return updateUserDetails()" style='display:none;'></td></tr>
	<tr><td><input type="hidden" id='hdnId'></td></tr></table>
			<table id="tblRule" width='100%' border="2">
				</table>
	<script type="text/javascript" src="jquery.min.js"></script>
	<script>
	$(function(){
			getUserDetails();
		});
		function getUserDetails(){
		$.post('getUserDetails.php',{}).done(function(data){
			$("#tblRule").html(data);
		});
	  }
	  
	  function updateUserDetails(){
		var Status=$("#status").val();
		if(Status==""){
		alert("Please Select Status");
		}
		else{
		var submit=$("#btnSubmit").val();
			if(submit=="Update"){
			$.ajax({
			type:"POST",
					url:"updateUserDetails.php",
					data:{Status:Status,submit:submit,id:$("#hdnId").val()},
					success:function(response){
						console.log(response);
						if(response=="success"){
							alert("User Details Updated Successfully");
							$("#status").val("");
							$("#btnSubmit").attr("Style","display:none");
						getUserDetails();
						}
						else{
							alert("User Details Not Updated");
							$("#status").val("");
							$("#btnSubmit").attr("Style","display:none");
						getUserDetails();
						}
					}
				});
			}
		}
	}
	
	function updateDetails(id){
		$("#hdnId").val(id);
	
		$("#status").val($('#Status'+id).html());
		$("#btnSubmit").attr("Style","display:block");
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



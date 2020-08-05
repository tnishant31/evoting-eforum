<?php
	session_start();
	if($_SESSION["username"]=="")
{
	header("Location:index.php");
}
?>
	<html><head>
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
                      <li><a href="Position.php">POSITION DETAILS</a></li>
                    <li class="active"><a href="Candidate.php">CANDIDATE DETAILS</a></li>
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
                <h3>Candidate Details</h3>
            </div>
            <div class="row">
                <div class="col-sm-12 intro">
			
				<table>
	<tr><td><label>Candidate Name:</label></td>
	<td><input type="text" name="Name" id="txtName" class="form-control" values=""></td>
	</tr>
	<tr><td><label>Candidate Email:</label></td>
	<td><input type="text" name="Email" id="txtEmail" class="form-control" values=""></td>
	</tr>
	<tr><td><label>Candidate Class:</label></td>
	<td><input type="text" name="Class" id="txtClass" class="form-control" values=""></td>
	</tr>
	<tr><td><label>Candidate Division:</label></td>
	<td><input type="text" name="Division" id="txtDivision" class="form-control" values=""></td>
	</tr>
	<tr><td><label>Position:</label></td>
	<td><select id="txtPosition" name="Position" class="form-control">
				<option value="">Select Position</option>
			
				<?php
					include_once('config.php');
					mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
					mysql_select_db(DB_DATABASE);
					$query="select * from position_details";
					$option="";
					$res=mysql_query($query);
					while($row=mysql_fetch_array($res)){
						$option=$option."<option value=".$row[0].">".$row[1]."</option>";
					}
					echo $option;
				?>
				</select></td></tr>
	<tr><td><input type="submit" name="submit" id="btnSubmit" class="form-control" height="50" width="50" value="Add" onclick="return addCandidateDetails()"></td>
	</tr>
	<tr><td><input type="hidden" id='hdnId'></td></tr></table>
					<table id="tblRule" width='100%' border="2">
						</table>
				
	<script type="text/javascript" src="jquery.min.js"></script>
	<script>
		$(function(){
			CandidateDetails();
		});
		
		function fullname_valid(value)
		{
		var validCharactersRegex = /^[A-Z][a-zA-Z]*(.)[A-Z][a-zA-Z]+$/;
		return validCharactersRegex.test(value);
		}
		
		function echeck(str) {

			var at="@";
			var dot=".";
			var lat=str.indexOf(at);
			var lstr=str.length;
			var ldot=str.indexOf(dot);
			if (str.indexOf(at)==-1){
	//alert("Invalid E-mail ID")
			return false;
		}
			if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
	//alert("Invalid E-mail ID")
			return false;
		}
			if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
	//alert("Invalid E-mail ID")
			return false;
		}
			if (str.indexOf(at,(lat+1))!=-1){
	//alert("Invalid E-mail ID")
			return false;
		}
			if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
	//alert("Invalid E-mail ID")
			return false;
		}
			if (str.indexOf(dot,(lat+2))==-1){
	//alert("Invalid E-mail ID")
			return false;
		}
			if (str.indexOf(" ")!=-1){
	//alert("Invalid E-mail ID")
			return false;
		}
			return true;
		}
		
		function CandidateDetails(){
		$.post('CandidateDetails.php',{}).done(function(data){
			$("#tblRule").html(data);
		});
	  }
	  
	  function addCandidateDetails(){
		var Name=$("#txtName").val();
		var Email=$("#txtEmail").val();
		var Class=$("#txtClass").val();
		var Division=$("#txtDivision").val();
		var Position=$("#txtPosition").val();
		if(Name==""){
			alert("Please Enter Name");
		}
		else if(!fullname_valid($("#txtName").val()))
		{
		alert("Please Enter A Valid Name");
		return false;
		}
		else if(Email==""){
			alert("Please Enter Email");
		}
		else if(!echeck($("#txtEmail").val()))
		{
		alert("Please Enter Valid E-mail");
			return false;
			}
		
		else if(Class==""){
			alert("Please Enter Class");
		}
		
		else if(Division==""){
			alert("Please Enter Division");
		}
	
		else if(Position==""){
			alert("Please Enter Position");
		}
		else{
			var submit=$("#btnSubmit").val();
			if(submit=="Add"){
				$.ajax({
					type:"POST",
					url:"addCandidateDetails.php",
					data:{Name:Name,Email:Email,Class:Class,Division:Division,Position:Position,submit:submit},
					success:function(response){
					console.log(response);
						if(response=="success"){
							alert("Candidate Details Saved Successfully");
							$("#txtName").val("");
							$("#txtEmail").val("");
							$("#txtClass").val("");
							$("#txtDivision").val("");
							$("#txtPosition").val("");
						CandidateDetails();
						}
						else if(response=="Exist"){
						alert("Candidate Details Already Exist");
						$("#txtName").val("");
							$("#txtEmail").val("");
							$("#txtClass").val("");
							$("#txtDivision").val("");
							$("#txtPosition").val("");
						CandidateDetails();
						}
						else{
							alert("Candidate Details Not Saved");
							$("#txtName").val("");
							$("#txtEmail").val("");
							$("#txtClass").val("");
							$("#txtDivision").val("");
							$("#txtPosition").val("");
							CandidateDetails();
						}
					}
				});
			}
			else{
			
				$.ajax({
					type:"POST",
					url:"addCandidateDetails.php",
					data:{Name:Name,Email:Email,Class:Class,Division:Division,Position:Position,submit:submit,id:$("#hdnId").val()},
					success:function(response){
						console.log(response);
						if(response=="success"){
							alert("Candidate Details Updated Successfully");
							$("#txtName").val("");
							$("#txtEmail").val("");
							$("#txtClass").val("");
							$("#txtDivision").val("");
							$("#txtPosition").val("");
							$("#btnSubmit").val("Add");
							CandidateDetails();
						}
						else if(response=="Exist"){
						alert("Candidate Details Already Exist");
						$("#txtName").val("");
							$("#txtEmail").val("");
							$("#txtClass").val("");
							$("#txtDivision").val("");
							$("#txtPosition").val("");
						CandidateDetails();
						}
						else{
							alert("Candidate Details Not Updated");
							$("#txtName").val("");
							$("#txtEmail").val("");
							$("#txtClass").val("");
							$("#txtDivision").val("");
							$("#txtPosition").val("");
							$("#btnSubmit").val("Add");
							CandidateDetails();
						}
					}
				});
			}
		}
	}
		
	  function updateDetails(id){
		var Name=$('#Name'+id).html();
		var Email=$('#Email'+id).html();
		var Class=$('#Class'+id).html();
		var Division=$('#Division'+id).html();
		
		
		$("#hdnId").val(id);
		$("#txtName").val(Name);
		$("#txtEmail").val(Email);
		$("#txtClass").val(Class);
		$("#txtDivision").val(Division);
		$("#txtPosition").val($('#lblId'+id).html());
		$("#btnSubmit").val("Edit");
	  }
	  
	  function deleteDetails(id){
		$.ajax({
			type:"POST",
			url:"deleteCandidateDetails.php",
			data:{id:id},
			success:function(response){
				if(response=="success"){
					alert("Candidate Details Deleted Successfully");
						$("#txtName").val("");
							$("#txtEmail").val("");
							$("#txtClass").val("");
							$("#txtDivision").val("");
							$("#txtPosition").val("");
					$("#btnSubmit").val("Add");
					CandidateDetails();
				}
				else{
					alert("Candidate Details Not Deleted");
						$("#txtName").val("");
							$("#txtEmail").val("");
							$("#txtClass").val("");
							$("#txtDivision").val("");
							$("#txtPosition").val("");
					$("#btnSubmit").val("Add");
					CandidateDetails();
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
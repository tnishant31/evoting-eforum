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
					<li><a href="Position.php">POSITION DETAILS</a></li>
                    <li><a href="Candidate.php">CANDIDATE DETAILS</a></li>
					<li class="active"><a href="Forum.php">FORUM DETAILS</a></li>
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
                <h3>Forum Details</h3>
            </div>
            <div class="row">
                <div class="col-sm-12 intro">
			
				<table>
		<tr><td><label>Question:</label></td>
		<td><input type="text" name="Question" id="txtQuestion" class="form-control" values=""></td>
		</tr>

		<tr><td><input type="submit" name="submit" id="btnSubmit" class="form-control"  value="Add" onclick="return addForumDetails();"></td>
		</tr>
			
			<tr><td><input type="hidden" id='hdnId'></td></tr></table>
					<table id="tblRule" width='100%' border="2">
						</table>
				
	
				</div>
			</div>
		</div>
	</div>
    <footer id="footer">
        <div class="col-md-12">
                            &copy; 2015-2016 E-Voting App. All rights reserved.
                        </div>
      </footer>
    <script type="text/javascript" src="jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/theme.js"></script>
    <script type="text/javascript" src="js/flexslider.js"></script>
	<!--<script src="code.jquery.com/jquery-latest.js"></script>-->
	
	<script>
		$(function(){
			ForumDetails();
		});
		
		function ForumDetails(){
		$.post('ForumDetails.php',{}).done(function(data){
			$("#tblRule").html(data);
		});
			}
	  
	  function addForumDetails(){
		var Question=$("#txtQuestion").val();
		if(Question==""){
			alert("Please Enter Question");
		}
		else{
			var submit=$("#btnSubmit").val();
			if(submit=="Add"){
				$.ajax({
					type:"POST",
					url:"addForumDetails.php",
					data:{Question:Question,submit:submit},
					success:function(response){
					console.log("--"+$.trim(response)+"--");
						if($.trim(response)=="success"){
							alert("Saved Successfully");
							$("#txtQuestion").val("");
							ForumDetails();
						}
						else{
							alert(" Not Saved");
							$("#txtQuestion").val("");
								ForumDetails();
						}
					}
				});
			}
			else
			{
				$.ajax({
					type:"POST",
					url:"addForumDetails.php",
					data:{Question:Question,submit:submit,id:$("#hdnId").val()},
					success:function(response){
						console.log(response);
						if($.trim(response)=="success"){
							alert("Updated Successfully");
							$("#txtQuestion").val("");
							$("#btnSubmit").val("Add");
							ForumDetails();
						}
						else{
							alert(" Not Updated");
							$("#txtQuestion").val("");
							$("#btnSubmit").val("Add");
							ForumDetails();
						}
					}
				});
			}
		}
	}
		
	  function updateDetails(id){
		$("#hdnId").val(id);
		$("#txtQuestion").val($('#Question'+id).html());
		$("#btnSubmit").val("Edit");
	  }
	  
	  function deleteDetails(id){
		$.ajax({
			type:"POST",
			url:"deleteForumDetails.php",
			data:{id:id},
			success:function(response){
				if(response=="success"){
					alert("Questions Deleted Successfully");
					$("#txtQuestion").val("");
					$("#btnSubmit").val("Add");
					ForumDetails();
				}
				else{
					alert("Position Details Not Deleted");
					$("#txtQuestion").val("");
					$("#btnSubmit").val("Add");
					ForumDetails();
				}
			}
		});
	  }
		</script>
		</body>
	</html>
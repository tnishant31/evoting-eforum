<?php
	session_start();
	if($_SESSION["username"]=="")
{
	header("Location:index.php");
}
?>
<!DOCTYPE html>
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
                
                <a href="index.php" class="navbar-brand"><strong>E-Voting App</strong></a>
            </div>
			<div class="collapse navbar-collapse navbar-ex1-collapse" role="navigation">
                 <ul class="nav navbar-nav navbar-right">
                   <li><a href="index.php">HOME</a></li>
				   <li><a href="UserDetails.php">USER DETAILS</a></li>
					<li><a href="Position.php">POSITION DETAILS</a></li>
                    <li><a href="Candidate.php">CANDIDATE DETAILS</a></li>
					<li><a href="Forum.php">FORUM DETAILS</a></li>
					<li><a href="Result.php">RESULT DETAILS</a></li>
					<li class="active"><a href="ChangePassword.php">CHANGE PASSWORD</a></li>
                   <li><a href="logout.php">LOGOUT</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div id="aboutus">
        <div class="container">
            <div class="section_header">
                <h3>Change Password</h3>
            </div>
            <div class="row">
                <div class="col-sm-12 intro">
					<table>
					<tr><td>
					<label>Old Password</label></td><td><input type="password" id="oldPassword" name="oldPassword" class="form-control" placeholder="Old Password"></td>
					</tr>
				<tr><td>
					<label>New Password</label></td><td><input type="password" id="newPassword" name="newPassword" class="form-control" placeholder="New Password"></td>
					</tr>
					<tr><td><label>Confirm Password</label></td><td><input type="password" id="confirmpassword" name="confirmpassword" class="form-control" placeholder="Confirm Password"></td>
					</tr>
					<tr><td><input type="submit" name="submit" id="btnSubmit" value="ChangePassword" class="form-control" height="50" width="50" onclick="getChangePwd()"/></td></tr>
					</table>
					<script type="text/javascript" src="jquery.min.js"></script>
	<script>
	function getChangePwd(){
			var oldPassword=$("#oldPassword").val();
			var newPassword=$("#newPassword").val();
			var confirmpassword=$("#confirmpassword").val();
			
			if(oldPassword==""){
				alert("Please Enter Old Password");
			}
			else if(newPassword==""){
				alert("Please Enter New Password");
			}
			else if(confirmpassword==""){
				alert("Please Enter Confirm Password");
			}
			else if(confirmpassword!=newPassword){
				alert("Password Mismatch");
			}
			else{
		
			console.log(confirmpassword);
				$.ajax({
					type:"POST",
					url:"getChangePwd.php",
					data:{oldPassword:oldPassword,newPassword:newPassword},
					success:function(response){
						console.log(response);
						if(response=="success"){
							alert("Password Changed Successfully");
						}
						else{
							alert("Password Not Changed");
						}
					}
				});
			}
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
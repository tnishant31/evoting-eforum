<?php
session_start();
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

	<script type="text/javascript">
		function checklogin(){
	
		if($("#txtEmail").val()==""){
		alert("Please Enter Username");
		}
		else if($("#txtPassword").val()==""){
		alert("Please Enter Password");
		}
		else{
		$.ajax({
			type:"POST",
			url:"checklogin.php",
			data:{email:$("#txtEmail").val(),password:$("#txtPassword").val()},
			success:function(response){
				//console.log(response);
				if(response=="Success"){
					window.location.href="homepage.php";
				}
				else{
			alert("Invalid Username/password");
				}
			}
		});
	}
	
}

</script>
</head>
<body>
     <div class="navbar navbar-inverse navbar-static-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                
                <a href="index.php" class="navbar-brand"><strong><center>E-Voting</center></strong></a>
            </div>
			
        </div>
    </div>

    <div id="aboutus">
        <div class="container">
            <div class="section_header">
                <h3>Please Login....</h3>
            </div>
            <div class="row">
                <div class="col-sm-12 intro">
					<table>
						<tr>
							<td><label>Enter Username:</label></td>
							<td><input type="text" id="txtEmail" class="form-control" name="email" value="" placeholder="Username"></td>
						</tr>
						<tr>
							<td><label>Enter Password:</label></td>
							<td><input type="password" name="password" class="form-control" id="txtPassword" value="" placeholder="Password"></td>
						</tr>
						<tr>
							<td><input type="submit" value="Login" name="submit" class="form-control" onclick="return checklogin();"></td>
							<td></td>
						</tr>
					</table>
				</div>
			</div>
    </div>
</div>
    <footer id="footer">
		<div class="col-md-12">
			&copy; 2015-2016 E-Voting. All rights reserved.
		</div>
    </footer>
	<script src="code.jquery.com/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/theme.js"></script>
    <script type="text/javascript" src="js/flexslider.js"></script>
</body>
</html>
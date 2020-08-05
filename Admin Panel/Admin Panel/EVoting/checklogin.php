<?php
session_start();
	include('config.php');
	mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
	mysql_select_db(DB_DATABASE);
	$qry="Select count(*) from admin_login where email='".$_REQUEST["email"]."' and password='".$_REQUEST["password"]."'";
		//echo $qry;
	$count=0;
	$res=mysql_query($qry);
	while($row=mysql_fetch_array($res)){
		$count=$row[0];
	if($count>0){
		$_SESSION["username"]=$_REQUEST["email"];
		
	echo "Success";
	
		
	}
	else{
		echo "Error";
	}
	}
?>

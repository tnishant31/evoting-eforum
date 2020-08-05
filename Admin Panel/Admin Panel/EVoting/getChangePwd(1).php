<?php
	session_start();
	include_once('config.php');
	mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
	mysql_select_db(DB_DATABASE);
	$password=$_REQUEST['oldPassword'];
	$newPassword=$_REQUEST['newPassword'];
	
	$query="select password from admin_login where email='".$_SESSION['username']."'";

		$res=mysql_query($query);
		$row=mysql_fetch_array($res);
		$oldPassword=$row[0];
		if($oldPassword=$password){
	$query="update admin_login set password='".$newPassword."' where email='".$_SESSION['username']."'";

	if(mysql_query($query)){
		echo "success";
	}
	else{
		echo "Error";
	}
	}

?>

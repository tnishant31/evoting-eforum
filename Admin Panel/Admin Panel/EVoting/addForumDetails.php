<?php
	include_once('config.php');
	mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
	mysql_select_db(DB_DATABASE);
	
	$question=$_REQUEST["Question"];
	$type=$_REQUEST["submit"];
	
	if($type=="Add"){
		$query="insert into forum_details(Question) values('".$question."')";
	}
	else{
	$id=$_REQUEST['id'];
		$query="UPDATE forum_details set Question='".$question."' where id=".$id;
	}
	
	if(mysql_query($query)){
		echo "success";
	}
	else{
		echo "Error";
	}
?>

 
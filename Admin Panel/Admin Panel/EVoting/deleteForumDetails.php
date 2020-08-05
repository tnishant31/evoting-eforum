<?php 
	include_once('config.php');
	mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
	mysql_select_db(DB_DATABASE);
	$id=$_REQUEST['id'];
	
	
	$query="delete from forum_details where id=".$id;
	//echo $query;
	if(mysql_query($query)){
		echo "success";
	}
	else{
		echo "Error";
	}
?>
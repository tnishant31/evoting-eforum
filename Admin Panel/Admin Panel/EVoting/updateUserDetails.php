<?php 
	include_once('config.php');
	mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
	mysql_select_db(DB_DATABASE);
	
	$id=$_REQUEST['id'];
	$Status=$_REQUEST['Status'];
	$type=$_REQUEST['submit'];
	if($type=='Update'){
	$query="UPDATE User_Details set Status='".$Status."' where id=".$id;
	
}
	if(mysql_query($query)){
		echo "success";
	}
	else{	
		echo "Error";
	}
?>

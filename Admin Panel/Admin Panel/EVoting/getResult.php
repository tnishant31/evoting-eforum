<?php
session_start();
	include('config.php');
	mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
	mysql_select_db(DB_DATABASE);
	$qry="Select count(Name) from candidate_details where Position='".$_REQUEST["Position"]."' and id='".$_REQUEST["id"]."'";
	//echo $qry;
	$count=0;
	$res=mysql_query($qry);
	while($row=mysql_fetch_array($res)){
		$count=$row[0];

	if(mysql_query($query)){
		echo "success";
	}
	else{	
		echo "Error";
	}
		

?>

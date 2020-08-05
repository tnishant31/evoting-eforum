<?php 
	include_once('config.php');
	mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
	mysql_select_db(DB_DATABASE);

	$Position=$_REQUEST['Position'];
	$submit=$_REQUEST['submit'];
	$query="";
	if($submit=='Add'){
		$qry="select count(*) from position_details where Position='".$Position."' ";
	$res=mysql_query($qry);
	$count=mysql_fetch_array($res);
	if($count[0]==0){
		$query="insert into position_details(Position) values('".$Position."')";
		
	if(mysql_query($query)){
		$res="success";
		}
		else{
		$res="Error";
		}
		}
		else{
		$res="Exist";
		}
	}
	else{
	$id=$_REQUEST['id'];
	
		$qry="select count(*) from position_details where Position='".$Position."' and id<>".$id;
	$res=mysql_query($qry);
	$count=mysql_fetch_array($res);
	if($count[0]==0){
		$query="UPDATE position_details set Position='".$Position."' where id=".$id;
	//echo $query;
	if(mysql_query($query)){
		$res="success";
		}
		else{
		$res="Error";
		}
		}
		else{
		$res="Exist";
			}
		}
	echo $res;
?>

<?php 
	include_once('config.php');
	mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
	mysql_select_db(DB_DATABASE);

	$Name=$_REQUEST['Name'];
	$Email=$_REQUEST['Email'];
	$Class=$_REQUEST['Class'];
	$Division=$_REQUEST['Division'];
	$Position=$_REQUEST['Position'];
	$submit=$_REQUEST['submit'];
	$query="";
	if($submit=='Add'){
	$qry="select count(*) from candidate_details where Name='".$Name."'";
		$res=mysql_query($qry);
	$count=mysql_fetch_array($res);
	if($count[0]==0){
	
		$query="insert into candidate_details(Name,Email,Class,Division,Position) values('".$Name."','".$Email."','".$Class."','".$Division."','".$Position."')";
		
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
	$qry="select count(*) from candidate_details where Name='".$Name."' and id<>".$id;
	$res=mysql_query($qry);
	$count=mysql_fetch_array($res);
	if($count[0]==0){
	$query="UPDATE candidate_details set Name='".$Name."',Email='".$Email."',Class='".$Class."',Division='".$Division."',Position='".$Position."' where id=".$id;
	
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

<?php 
	include_once('config.php');
	mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
	mysql_select_db(DB_DATABASE);
	
		$qry="Select position from position_details where id='".$_REQUEST["position"]."'";
	$result=mysql_query($qry);
	$row=mysql_fetch_array($result);
	$positon=$row[0];
	
	
		$query="select count(*) from result where position='".$_REQUEST["position"]."'";
	$res=mysql_query($query);
	$row=mysql_fetch_array($res);
	$table="";
	$table.="<tr>";
	$table.="<th colspan='2'>Voting Result For Position:".$positon."</th>";
	$table.="</tr>";
	$table.="<tr>";
	$table.="<th>Total Votes</th>";
	$table.="<th>".$row[0]."</th>";
	$table.="</tr>";
	
	$candidate_name=array();
	$candidate_id=array();
		$query="Select name,id from candidate_details where position='".$_REQUEST["position"]."'";
	$res=mysql_query($query);
	while($row=mysql_fetch_array($res)){
		$candidate_name[]=$row[0];
		$candidate_id[]=$row[1];
	}
	
	for($i=0;$i<count($candidate_name);$i++){
		$query="Select Count(*) from result where position='".$_REQUEST["position"]."' and CandidateID=".$candidate_id[$i];
		$res=mysql_query($query);
		while($row=mysql_fetch_array($res)){
			$table.="<tr>";
			$table.="<td>".$candidate_name[$i]."</td>";
			$table.="<td>".$row[0]."</td>";
			$table.="</tr>";
		}	
	}
	echo $table;
?>

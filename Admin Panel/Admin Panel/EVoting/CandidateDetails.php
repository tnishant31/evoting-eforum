<?php 
	include_once('config.php');
	mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
	mysql_select_db(DB_DATABASE);
	
	$query="select * from candidate_details";
	$res=mysql_query($query);
	$table="";
	$table.="<tr>";
	$table.="<th>SrNo</th>";
	$table.="<th>Name</th>";
	$table.="<th>Email</th>";
	$table.="<th>Class</th>";
	$table.="<th>Division</th>";
	$table.="<th>Position</th>";
	$table.="<th>Update</th>";
	$table.="<th>Delete</th>";
	$table.="</tr>";
	$i=1;
	while($row=mysql_fetch_array($res)){
		$table.="<tr>";
		$table.="<td id='id".$row['id']."'>".$i."</td>";
		$table.="<td id='Name".$row['id']."'>".$row['Name']."</td>";
		$table.="<td id='Email".$row['id']."'>".$row['Email']."</td>";
		$table.="<td id='Class".$row['id']."'>".$row['Class']."</td>";
		$table.="<td id='Division".$row['id']."'>".$row['Division']."</td>";
		$table.="<td ><label id='lblId".$row['id']."' style='display:none;'>".$row['Position']."</label>".getPosition($row['Position'])."</td>";
		$table.="<td><a href='javascript:void();' onclick='updateDetails(".$row['id'].")''>Update</a></td>";
		$table.="<td><a href='javascript:void();' onclick='deleteDetails(".$row['id'].")''>Delete</a></td>";
		
	$table.="</tr>";
	$i++;
	}
	echo $table;
	
				function getPosition($id){
		$query="select Position from position_details where id=".$id;
		//echo $query;
		$res=mysql_query($query);
		$row=mysql_fetch_array($res);
		return $row[0];
	}
?>

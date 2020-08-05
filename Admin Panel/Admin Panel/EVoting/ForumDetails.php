<?php 
	include_once('config.php');
	mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
	mysql_select_db(DB_DATABASE);
	
	$query="select 	* from forum_details";
	$res=mysql_query($query);
	$table="";
	$table.="<tr>";
	$table.="<th>SrNo</th>";
	$table.="<th>Question</th>";
	$table.="<th>Update</th>";
	$table.="<th>Delete</th>";
	$table.="</tr>";
	$i=1;
	while($row=mysql_fetch_array($res)){
		$table.="<tr>";
		$table.="<td id='id".$row['id']."'>".$i."</td>";
		$table.="<td id='Question".$row['id']."'>".$row['Question']."</td>";
		$table.="<td><a href='javascript:void();' onclick='updateDetails(".$row['id'].")'>Update</a></td>";
		$table.="<td><a href='javascript:void();' onclick='deleteDetails(".$row['id'].")'>Delete</a></td>";
		
	$table.="</tr>";
	$i++;
	}
	echo $table;
?>

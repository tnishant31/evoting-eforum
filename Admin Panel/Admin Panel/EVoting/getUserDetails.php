<?php 
	include_once('config.php');
	mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
	mysql_select_db(DB_DATABASE);
	
	$query="select 	* from User_Details";
	$res=mysql_query($query);
	$table="";
	$table.="<tr>";
	$table.="<th>SrNo</th>";
	$table.="<th>Name</th>";
	$table.="<th>Email</th>";
	$table.="<th>Contact</th>";
	$table.="<th>Address</th>";
	$table.="<th>Class</th>";
	$table.="<th>Division</th>";
	$table.="<th>Status</th>";
	$table.="<th>Update</th>";
	$table.="</tr>";
	$i=1;
	while($row=mysql_fetch_array($res)){
		$table.="<tr>";
		$table.="<td id='id".$row['id']."'>".$i."</td>";
		$table.="<td id='Name".$row['id']."'>".$row['Name']."</td>";
		$table.="<td id='Email".$row['id']."'>".$row['Email']."</td>";
		$table.="<td id='Contact".$row['id']."'>".$row['Contact']."</td>";
		$table.="<td id='Address".$row['id']."'>".$row['Address']."</td>";
		$table.="<td id='Class".$row['id']."'>".$row['Class']."</td>";
		$table.="<td id='Division".$row['id']."'>".$row['Division']."</td>";
		$table.="<td id='Status".$row['id']."'>".$row['Status']."</td>";
		$table.="<td><a href='javascript:void();' onclick='updateDetails(".$row['id'].")''>Update</a></td>";
		
	$table.="</tr>";
	$i++;
	}
	echo $table;
?>

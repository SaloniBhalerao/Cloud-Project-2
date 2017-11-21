<?php include "../inc/dbinfo.inc"; ?>
<?php

   $connection = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD);
   if (mysqli_connect_errno()) echo "Failed to connect to MySQL: ".mysqli_connect_error();
   session_start();
   $database = mysqli_select_db($connection,DB_DATABASE);
   $u = mysqli_real_escape_string($connection,$_SESSION['User_name']);  
   $result = mysqli_query($connection, "SELECT * FROM event_details order by Id;");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event Details</title>
	<style>
    table, th, td {
    border: 1px solid black;
    }
    </style>
    </head>
    <body bgcolor='silver'>
	<br></br>
	<center><h1>Event Details</h1></br>
	<center>
        <table cellspacing="10">
		<thead>
		<tr>		
		    <th>Organistaion Name</th>
            <th>Event Name</th>
            <th>Event Address</th>
            <th>Event City</th>			
		    <th>Event State</th>
			<th>Event Zipcode</th>
			<th>Email</th>			
			<th>Event Date</th>	
			<th>Event Time</th>
			<th>Food available</th>			
        </tr>
		</thead>
		<tbody>		
		<?php while($query_data = mysqli_fetch_row($result)) { ?>
		<tr>
		<td><?php echo $query_data[1]; ?></td>
		<td><?php echo $query_data[2]; ?></td>
		<td><?php echo $query_data[3]; ?></td>
		<td><?php echo $query_data[4]; ?></td>
		<td><?php echo $query_data[5]; ?></td>
		<td><?php echo $query_data[6]; ?></td>
		<td><?php echo $query_data[7]; ?></td>
		<td><?php echo $query_data[8]; ?></td>	
		<td><?php echo $query_data[9]; ?></td>	
        <td><?php echo $query_data[10]; ?></td>	
		</tr>
		<?php } ?>
		<tbody>
		</table>
	</center>
    </body>
</html>
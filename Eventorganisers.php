<?php include "/var/www/inc/dbinfo.inc"; ?>
<?php
  
  require '/var/app/current/app/start.php';
  
  
  use Aws\S3\Exception\S3Exception;

    if(isset($_FILES['file1'])){
     
	$file = $_FILES['file1'];
 
	// Details of the file
	$file_name = $file['name'];
	$tmp_file_name = $file['tmp_name'];
 
	$extensin = explode('.', $file_name);
	$extensin = strtolower(end($extensin));
	
	// Temporary file details
    $key = md5(uniqid());
    $tmp_filename = "{$key}.{$extensin}";
    $tmp_filepath = "files/{$tmp_filename}";
 
    // Move the file to the destination
    move_uploaded_file($tmp_file_name, $tmp_filepath);
	
	try { 
            $s3->putObject([
            'Bucket' => $config['s3']['bucket'],
            'Key' => "Uploads/{$file_name}",
            'Body' => fopen($tmp_filepath, 'rb'),
			'ACL' => 'public-read',
			'version' => '2017-08-14'
        ]);
 
        // Remove the file from the folder
        unlink($tmp_filepath);
 
    } 
	
	//If exception is generated catch it.
	catch (S3Exception $e)
	{
	echo $e;
    die("Error in uploading the file");
	}  
}
   $connection = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD);
   if (mysqli_connect_errno()) echo "Failed to connect to MySQL: ".mysqli_connect_error();
   session_start();
   $database = mysqli_select_db($connection,DB_DATABASE);
   
   session_start();
   $no = htmlentities($_POST['id']);
   $no1= mysqli_real_escape_string($connection, $no);
   $o = mysqli_real_escape_string($connection, $_SESSION["org_name"]);
   $u = mysqli_real_escape_string($connection, $_SESSION["user_name"]);
   $fi = mysqli_real_escape_string($connection, $file_name);  
   $num = (int)$no1;         
   
   if($_POST['upload1'])
   {	    
        $query = "UPDATE `event_details` SET Food_availability='Ready to pickup', File_name='$fi' where User_name='$u' and ID=$num;"; 
        echo "<script type='text/javascript'>alert('Event updated successfully!!')</script>";
		if(!mysqli_query($connection, $query)) echo("<p>Error updating event details!!</p>");
		
   } 
   $result = mysqli_query($connection, "SELECT * FROM event_details");     
?>

<?php
          
		    require 'app/start.php';      
			$connection = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD);
            if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
            $database = mysqli_select_db($connection,DB_DATABASE);
			
            if($_POST['delete1'])
			{  			
			$id2 = htmlentities($_POST['id1']);
			$id3 = mysqli_real_escape_string($connection,$id2);
			$num= (int)$id3; 
			$filename1="select File_name FROM event_details where ID=$num"; 
			$query = "Delete FROM event_details where ID=$num;";
			$result = mysqli_query($connection, $query);
								
				if (isset($_POST['delete1'])) {
                    $s3->deleteObject([ 
                    'Bucket' => $config['s3']['bucket'],
                    'Key' => "Uploads/{$filename1}"
                    ]);
					
				}
            echo "<script type='text/javascript'>alert('Event deleted successfully!!')</script>";				
			}
            $result = mysqli_query($connection, "SELECT * FROM event_details"); 	
                   		
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event Details</title>
	<style>
	.button {
    background-color: #008CBA;
    border-radius: 12px;
    color: silver;
    padding: 6px 14px;    
    text-decoration: none;
    display: inline-block;
    font-size: 18px;
    margin: 4px 2px;
    cursor: pointer;
	font-family: "Times New Roman";
	position: fixed;
    bottom: 30px;
    left: 90px;	
    }
	.button1 {
    background-color: #008CBA;
    border-radius: 12px;
    color: silver;
    padding: 6px 14px;    
    text-decoration: none;
    display: inline-block;
    font-size: 18px;
    margin: 4px 2px;
    cursor: pointer;
	font-family: "Times New Roman";
	position: fixed;
    bottom: 30px;
    right: 90px;	
    }
    table, th, td {
    border: 1px solid black;
    }
    </style>
    </head>
    <body bgcolor='silver'>
	<center><h1 style="background-color:#008CBA;text-align:center;padding:12px 16px;color:silver;">Want to view?</h1></center>
	<center><img src="https://s3-us-west-1.amazonaws.com/projreqfiles2017/EventDetails.png" height="175" width="450"></center>
	<br></br>
	<center>
        <table cellspacing="10">
		<thead>
		<tr>	
		    <th>Event No</th>
		    <th>Event Name</th>
            <th>Event Address</th>
            <th>Event City</th>			
		    <th>Event State</th>
			<th>Event Zipcode</th>
			<th>Event Date</th>	
			<th>Event Time</th>
			<th>Food Availabilty</th>	
            <th>File Name</th>	
			<th>View</th>  
        </tr>
		</thead>
		<tbody>		
		<?php while($query_data = mysqli_fetch_row($result)){?>
		<tr>
        <td><?php echo $query_data[0]; ?></td>	
		<td><?php echo $query_data[3]; ?></td>
		<td><?php echo $query_data[4]; ?></td>
		<td><?php echo $query_data[5]; ?></td>
		<td><?php echo $query_data[6]; ?></td>
		<td><?php echo $query_data[7]; ?></td>
		<td><?php echo $query_data[8]; ?></td>
		<td><?php echo $query_data[9]; ?></td>	
		<td><?php echo $query_data[10]; ?></td>	
        <td><?php echo $query_data[11]; ?></td>	
        <td><a href="<?php if ($query_data[11]=='Not specified') echo $s3->getObjectUrl($config['s3']['bucket'],"Uploads/Filename.jpg"); else echo $s3->getObjectUrl($config['s3']['bucket'], "Uploads/{$query_data[11]}");?>"> View File</a></td>
		</tr>		
		<?php } ?>		
		<tbody>
		</table>
	    </center>
		<center>
		<h4>Please enter the event no and choose a file for the updation of Event details!!</h4>
		<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="post" enctype="multipart/form-data">
        <input type="text" name="id" style="width:35px;"/>
		<input type="file" name="file1"/>
		<input type="submit" name="upload1"/>
 		</form>
		<h4>Please enter the event no for the deletion of Event details!!</h4>
		<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="post" enctype="multipart/form-data">
        <input type="text" name="id1" style="width:35px;"/>
		<input type="submit" name="delete1" value="Delete"/>
 		</form>
		
		</center>
	</body>
</html>

<!DOCTYPE html>
<html lang="en">
<form action="Donate.php">
<input type="submit" value="Back" class="button">
</form>
</html>

<!DOCTYPE html>
<html lang="en">
<form action="index.php">
<input type="submit" value="Logout" class="button1">
</form>
</html>


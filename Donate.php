<?php include "/var/www/inc/dbinfo.inc"; ?>
<?php

require '/var/app/current/app/start.php';

use Aws\S3\Exception\S3Exception;
    
	if(!empty($_FILES['file1']) && isset($_FILES['file1'])){
		
		echo("<p>Going inside</p>");
     
	    $file = $_FILES['file1'];
 
		// Details of the file
		$file_name = $file['name'];
		$tmp_file_name = $file['tmp_name'];
 
		$extensin = explode('.', $file_name);
	    $extensin = strtolower(end($extensin));
	
	    // Temporary file details
        $key = md5(uniqid());
		$tmp_filename = "{$key}.{$extensin}";
		$tmp_filepath = "/var/app/current/files/{$tmp_filename}";
 
		// Move the file to the destination
		move_uploaded_file($tmp_file_name, $tmp_filepath);
 
		try { 
            $s3->putObject([
            'Bucket' => $config['s3']['bucket'],
            'Key' => "Uploads/{$file_name}",
            'Body' =>  fopen($tmp_filepath, 'rb'),
            'ACL' => 'public-read'
			]);
 
			// Remove the file from the folder
			unlink($tmp_filepath);
		} 
	
		//If exception is generated catch it.
		catch (S3Exception $e) {
			//die("Error in uploading the file");
		}     
	}
    
	$connection = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD);
    if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

    $database = mysqli_select_db($connection,DB_DATABASE);
	
	
	$e1 = htmlentities($_POST['eventname']);
	$a1 = htmlentities($_POST['eventaddress']);
	$c1 = htmlentities($_POST['eventcity']);
	$s1 = htmlentities($_POST['eventstate']);
	$z1 = htmlentities($_POST['eventzipcode']);
	$d1 = htmlentities($_POST['eventdate']);
	$t1 = htmlentities($_POST['eventtime']); 
	 
	session_start();
	$o = mysqli_real_escape_string($connection, $_SESSION["org_name"]);
	$u = mysqli_real_escape_string($connection, $_SESSION["user_name"]);
	$e = mysqli_real_escape_string($connection, $e1);
	$a = mysqli_real_escape_string($connection,	$a1);
	$c = mysqli_real_escape_string($connection,	$c1);
	$s = mysqli_real_escape_string($connection,	$s1);
	$z = mysqli_real_escape_string($connection,	$z1);	
    $d = mysqli_real_escape_string($connection,	$d1);
	$t = mysqli_real_escape_string($connection,	$t1);	
          
	
	if($_POST['eventname'])
    {		
			$result = mysqli_query($connection,"insert into event_details 
			(`Organisation_name`,`User_name`,`Event_name`,`Event_address`,`Event_city`,`Event_state`,`Event_zipcode`,`Event_date`,`Event_time`,`Food_availability`,`File_name`)values 
			('$o','$u','$e','$a','$c','$s','$z','$d','$t','Not available','Not specified');");
			echo "<script type='text/javascript'>alert('Event Added successfully!!')</script>";
			if(!$result) echo("<p>Error adding event details!!</p>");
	}
?>



<html>
<body bgcolor="Silver">
<style>
.button {
    background-color: #008CBA;
    border-radius: 12px;
    color: silver;
    padding: 12px 20px;    
    text-decoration: none;
    display: inline-block;
    font-size: 18px;
    margin: 4px 2px;
    cursor: pointer;
	font-family: "Times New Roman";
}
</style>
<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="post" enctype="multipart/form-data">
<center><h1 style="background-color:#008CBA;text-align:center;padding:12px 16px;color:silver;">Want to post event details?</h1></center>
<center><img src="https://s3-us-west-1.amazonaws.com/projreqfiles2017/Donate.png" height="215" width="450">
</img>
<br></br>
<table>
    <tr>
      <td align="left">Event Name:</td>
      <td align="left"><input type="text" name="eventname" /></td>
    </tr>
    <tr>
	  <td align="left">Event Address:</td>
      <td align="left"><input type="text" name="eventaddress" /></td>
    </tr>
	<tr>
      <td align="left">Even City:</td>
      <td align="left"><input type="text" name="eventcity" /></td>
    </tr>
	<tr>
      <td align="left">Event State:</td>
      <td align="left"><input type="text" name="eventstate" /></td>
    </tr>
	<tr>
      <td align="left">Event Zipcode:</td>
      <td align="left"><input type="text" name="eventzipcode" /></td>
    </tr>	    
	<tr>
      <td align="left">Event Date:</b></td>
      <td align="left"><input type="text" name="eventdate" /></td>
    </tr>
	<tr>
      <td align="left">Event Time:</b></td>
      <td align="left"><input type="text" name="eventtime" /></td>
    </tr>
</table> 
<br></br>
  <input type="submit" value="Post" class="button">
</form>
<form action="Eventorganisers.php">
<input type="submit" value="View Existing Events" class="button">
</form>
</center>
</body>
</html>






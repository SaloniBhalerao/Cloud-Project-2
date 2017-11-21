<?php include "../inc/dbinfo.inc"; ?>
<?php
use Aws\S3\Exception\S3Exception;
 
require 'app/start.php';


    if(isset($_FILES['file'])){
     
	$file = $_FILES['file'];
 
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
            'Body' =>  fopen($tmp_filepath, 'rb'),
            'ACL' => 'public-read'
        ]);
 
        // Remove the file from the folder
        unlink($tmp_filepath);
 
    } 
	
	//If exception is generated catch it.
	catch (S3Exception $e) {
    die("Error in uploading the file");
         
    }
	
	$connection = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD);
    if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

    $database = mysqli_select_db($connection,DB_DATABASE);	
	session_start();
	
	
	
	$o = mysqli_real_escape_string($connection, $_SESSION['orgname']);
	$e = mysqli_real_escape_string($connection, $_SESSION['eventname']);
	$a = mysqli_real_escape_string($connection,	$_SESSION['eventaddress']);
	$c = mysqli_real_escape_string($connection,	$_SESSION['eventcity']);
	$s = mysqli_real_escape_string($connection,	$_SESSION['eventstate']);
	$z = mysqli_real_escape_string($connection,	$_SESSION['eventzipcode']);
	$m = mysqli_real_escape_string($connection,	$_SESSION['email']);
    $d = mysqli_real_escape_string($connection,	$_SESSION['eventdate']);
	$t = mysqli_real_escape_string($connection,	$_SESSION['eventtime']);	
    $f = mysqli_real_escape_string($connection, $_SESSION['foodavailable']);
	
	$result = mysqli_query($connection,"insert into event_details (`Organisation_name`,`Event_name`,`Event_address`,`Event_city`,`Event_state`,`Event_zipcode`,`Email`,`Event_date`,`Event_time`,`Food_available`)values 
	('$o','$e','$a','$c','$s','$z','$m','$d','$t','$f');");
	
	if(!mysqli_query($connection, $query)) echo("<p>Error adding employee data.</p>");
}

?>

<html>
<body bgcolor="Gray">
<center><img src="https://s3-us-west-1.amazonaws.com/projreqfiles2017/Donate.png" height="250" width="600"></center>
</img>
<center>
<br></br>
<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="post" enctype="multipart/form-data">
  <table>
    <tr>
      <td align="right">Organisation Name:</b></td>
      <td align="left"><input type="text" name="orgname" /></td>
    </tr>
	<tr>
      <td align="right">Event Name:</td>
      <td align="left"><input type="text" name="eventname" /></td>
    </tr>
    <tr>
	  <td align="right">Event Address:</b></td>
      <td align="left"><input type="text" name="eventaddress" /></td>
    </tr>
	<tr>
      <td align="right">Even City:</b></td>
      <td align="left"><input type="text" name="eventcity" /></td>
    </tr>
	<tr>
      <td align="right">Event State:</b></td>
      <td align="left"><input type="text" name="eventstate" /></td>
    </tr>
	<tr>
      <td align="right">Event Zipcode:</b></td>
      <td align="left"><input type="text" name="eventzipcode" /></td>
    </tr>	
    <tr>
      <td align="right">Email:</td>
      <td align="left"><input type="text" name="email" /></td>
    </tr>
	<tr>
      <td align="right">Event Date:</b></td>
      <td align="left"><input type="text" name="eventdate" /></td>
    </tr>
	<tr>
      <td align="right">Event Time:</b></td>
      <td align="left"><input type="text" name="eventtime" /></td>
    </tr>
    <tr>
      <td align="right">Food available:</b></td>
      <td align="left"><input type="text" name="foodavailable" /></td>
    </tr>
	<tr>	
      <td align="right">Food details:</b></td>
	  <td align="left"><input type="file" name="file"></td>
    </tr>	
  </table> 
  <br></br>
  <input type="submit" value="Submit">
</form>
</body>
</html>
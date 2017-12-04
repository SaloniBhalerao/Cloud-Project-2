<?php include "/var/www/inc/dbinfo.inc"; ?>
<?php require "/var/app/current/vendor/autoload.php"; ?>
<?php use Aws\Credentials\CredentialProvider;
global $success,$errMessage;
?>

<!DOCTYPE html>

<html lang="en">
    <head> 
		<meta name="viewport" content="width=device-width, initial-scale=1">


		<!-- Website CSS style -->
		   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>     
		<!-- Website Font style -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/register.css">
		<!-- Google Fonts -->
		
		<title>Social Organisation registration</title>
	</head>
	<body>
	<?php
 $client = require_once __DIR__ . '/cognito.php';  
/* Connect to MySQL and select the database. */
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
  $database = mysqli_select_db($connection, DB_DATABASE);
  /* Ensure that the event_organiser_details table exists. */
  VerifyUsersTable($connection, DB_DATABASE);
	   $org_name = htmlentities($_POST['org_name']);
  $user_name = htmlentities($_POST['user_name']);
  $first_name = htmlentities($_POST['first_name']);
  $last_name = htmlentities($_POST['last_name']);
  $email = htmlentities($_POST['email']);
  $phone_no = htmlentities($_POST['phone_no']);
  $user_password = htmlentities($_POST['user_password']);
  $confirm = htmlentities($_POST['confirm']);
  $type='social';
 $errEmail='';
$errMessage='';
		if (isset($_POST['submit'])) {
	
		// Check if email has been entered and is valid
		if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$errEmail = 'Please enter a valid email address';
		}
		 if ($user_password != $confirm) {
			$errMessage = 'Passwords do not match';
  		}
		if (!$errEmail && !$errMessage ) {
		//Check if message has been entered
		         if (!empty($_POST['email'])) {
    if (!empty($_POST['submit'])) {
        //Visit  https://console.aws.amazon.com/cognito/signin/ to get your own UserPoolId and ClientId
        try {
            $result = $client->signUp([
                'ClientId' => '4k7br61ru7pmh0esqabqi8b9u4',
                'Username' => $_POST['email'],
                'Password' => $_POST['user_password'],

                'UserAttributes' => [[
                    'Name' => 'email',
                    'Value' => $_POST['email'],
                ]
],
            ]);

            header("Location: loginpage.php?confirm=true&email=" . urlencode($_POST['email']));
        } catch (\Aws\Exception\AwsException $e) {
           echo $e->getAwsErrorMessage();
           printf('<pre><code>%s</code></pre>', $e->getAwsErrorMessage());
        }
    }
}
  
		AddUser($connection,$org_name,$user_name,$first_name,$last_name,$email,$phone_no,$user_password,$type);
		  $success="Registration successful! Proceed to login page";
		}
	}
	?>

		<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" >Food4Need</a>
    </div>

  </div>
</nav>
<div class="container">
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title"><center>Sign up as Social organisation</center> </h3>
			 			</div>
			 			<div class="panel-body">
			    			<form method="post" action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>">
			    		  
			    		    	<div class="form-group">
			    		    	<div class="input-group">     
			    		        <span class="input-group-addon">Organisation name</span>
			    		    
			    				<input type="text" name="org_name" id="org_name" class="form-control input-sm" placeholder="Organisation name" value="<?php echo htmlspecialchars($_POST['org_name']); ?>" required>
			    			</div>
			    			</div>

			    		    	<div class="form-group">
			    		    	<div class="input-group">     
			    		        <span class="input-group-addon">Number of people supported</span>
			    		    
			    				<input type="number" name="org_num" id="org_num" class="form-control input-sm" placeholder="Number of people supported" required>
			    			</div>
			    			</div>
			    			<div class="form-group">
			    		    	<div class="input-group">     
			    		        <span class="input-group-addon">Address </span>
			    		    
			    				<input type="textarea" name="org_addr" id="org_addr" class="form-control input-sm" placeholder="" required>
			    			</div>
			    			</div>
			    				<div class="form-group">
			    				    	<div class="input-group">     
			    		        <span class="input-group-addon">User name</span>
			    		    
			    				<input type="text" name="user_name" id="user_name" class="form-control input-sm" placeholder="Enter your user name" value="<?php echo htmlspecialchars($_POST['user_name']); ?>" required>
			    				</div>
			    			</div>
			    			
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    					<div class="input-group">     
			    		        <span class="input-group-addon">First name</span>
			                <input type="text" name="first_name" id="first_name" class="form-control input-sm" placeholder="First Name" value="<?php echo htmlspecialchars($_POST['first_name']); ?>" required>
			    					</div>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    					    	<div class="input-group">     
			    		        <span class="input-group-addon">Last name</span>
			    						<input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name" value="<?php echo htmlspecialchars($_POST['last_name']); ?>" required>
			    						</div>
			    					</div>
			    				</div>
			    			</div>
                            <div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    			<div class="form-group">
			    			    	<div class="input-group">     
			    		        <span class="input-group-addon">Email</span>
			    				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="example@domain.com" value="<?php echo htmlspecialchars($_POST['email']); ?>" required>
			    		    </div>
			    			</div>
			    			</div>
			    			
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    			<div class="form-group">
			    			    	<div class="input-group">     
			    		        <span class="input-group-addon">Mobile</span>
			    				<input type="number" name="phone_no" id="phone_no" class="form-control input-sm" placeholder="Phone number" value="<?php echo htmlspecialchars($_POST['phone_no']); ?>" required>
			    				</div>
			    			</div>
			    			    </div>
                            </div>
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    					    	<div class="input-group">     
			    		        <span class="input-group-addon">Password</span>
			    						<input type="password" name="user_password" id="user_password" class="form-control input-sm" placeholder="Password" value="<?php echo htmlspecialchars($_POST['user_password']);  ?>" required>
			    					</div>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    					    	
			    					    	<div class="input-group">   
			    					    	<span class="input-group-addon">Confirm </span>
			    						<input type="password" name="confirm" id="confirm" class="form-control input-sm" placeholder="Confirm Password"  value="<?php echo htmlspecialchars($_POST['confirm']); ?>" required>
			    						<?php echo "<p class='text-danger'>$errMessage </p>";?>
			    					</div>
			    					</div>
			    				</div>
			    				<div class="form-group">
								<div class="col-sm-10 col-sm-offset-2">
									<?php echo $success; ?>	
									</div>
					</div>
			    			</div>
			    			
			    			<input type="submit" value="Register" id="submit" name="submit" value="Register" class="btn btn-info center-block">
			    		
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>
    <?php
  mysqli_free_result($result);
  mysqli_close($connection); ?> 
    </body>
  
     <?php /* Add an employee to the table. */ 
 function AddUser($connection,$org_name,$user_name,$first_name,$last_name,$email,$phone_no,$user_password,$type) {
   $org_name = mysqli_real_escape_string($connection, $org_name);
   $user_name = mysqli_real_escape_string($connection, $user_name);
   $first_name = mysqli_real_escape_string($connection, $first_name);
   $last_name = mysqli_real_escape_string($connection, $last_name);
   $email = mysqli_real_escape_string($connection, $email);	
   $phone_no = mysqli_real_escape_string($connection, $phone_no);	
   $user_password = mysqli_real_escape_string($connection, $user_password);
   $type = mysqli_real_escape_string($connection, $type);
   
   $query = "INSERT INTO `users` (`org_name`,`user_name`,`first_name`,`last_name`,`email`,`phone_no`,`user_password`,`type`) VALUES ('$org_name','$user_name','$first_name','$last_name','$email','$phone_no','$user_password','$type');";
   if(!mysqli_query($connection, $query))
       echo("<p>Error adding User data.</p>");
   else
       echo("<p> Registration Successful.Please proceed to Login.</p>");

} 
/* Check whether the table exists and, if not, create it. */ 
function VerifyUsersTable($connection, $dbName) {
  if(!TableExists("users", $connection, $dbName))
  {
  
	 $query = "CREATE TABLE `users` (
		`org_name` varchar(20) NULL,
		`user_name` varchar(20) NOT NULL,
        `first_name` varchar(80) NOT NULL,
        `last_name` varchar(20) NOT NULL,
        `email` varchar(20) NOT NULL,
        `phone_no` integer NOT NULL,
		`user_password` varchar(45) NOT NULL,
        `type` varchar(15) NOT NULL,
         PRIMARY KEY (`user_name`)
      ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1"; 
     if(!mysqli_query($connection, $query)) echo("<p>Error creating table.</p>");
  }
}
/* Check for the existence of a table. */ function TableExists($tableName, $connection, $dbName) {
  $t = mysqli_real_escape_string($connection, $tableName);
  $d = mysqli_real_escape_string($connection, $dbName);
  $checktable = mysqli_query($connection,
      "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME = '$t' AND TABLE_SCHEMA = '$d'");
  if(mysqli_num_rows($checktable) > 0) return true;
  return false;
}

	
?>

</html>
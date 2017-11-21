<?php include "../inc/dbinfo.inc"; ?>
<?php require "../vendor/autoload.php"; ?>
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
		<link rel="stylesheet" href="css/style.css">
		<!-- Google Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

		<title>Food donor registration</title>
	</head>
	<body>
	<?php
  /* Connect to MySQL and select the database. */
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
  $database = mysqli_select_db($connection, DB_DATABASE);
  /* Ensure that the event_organiser_details table exists. */
  VerifyUsersTable($connection, DB_DATABASE);
  /* If input fields are populated, add a row to the Employees table. */
  $user_name = htmlentities($_POST['name']);
  $user_email = htmlentities($_POST['userEmail']);
  $password = htmlentities($_POST['password']);
  $confirm = htmlentities($_POST['confirm']);
  if (isset($_POST["submit"])) {
	/*	$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$confirm = $_POST['confirm']; */
		
		// Check if name has been entered
		if (!$_POST['name']) {
			$errName = 'Please enter your name';
		}
		
		// Check if email has been entered and is valid
		if (!$_POST['userEmail'] || !filter_var($_POST['userEmail'], FILTER_VALIDATE_EMAIL)) {
			$errEmail = 'Please enter a valid email address';
		}
		
		//Check if message has been entered
		if (!$_POST['password']) {
			$errPassword = 'Please enter your password';
		}
	
// If there are no errors, send the email
if (!$errName && !$errEmail && !$errPassword ) {
	 AddUser($connection, $user_name, $user_email,$password);
         echo "<meta http-equiv='refresh' content='0'>";
}
	}
  /*if (strlen($user_name) || strlen($user_email) || strlen($password)) {
    AddUser($connection, $user_name, $user_email,$password);
  } */
?>
		<div class="container">
			<div class="row main">
				<div class="main-login main-center">
				<h5>Sign up to food4need and register your events</h5>
					<form class="" method="post" action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>">
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label"> User Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="name" id="name"  placeholder="Enter your user name" value="<?php echo htmlspecialchars($_POST['name']); ?>"/>
									<?php echo "<p class='text-danger'>$errName</p>";?>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label"> Email address</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="userEmail" id="email"  placeholder="Enter your Email" value="<?php echo htmlspecialchars($_POST['email']); ?>"/>
								    <?php echo "<p class='text-danger'>$errEmail</p>";?>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password" value="<?php echo htmlspecialchars($_POST['password']);  ?>" />
									<?php echo "<p class='text-danger'>$errPassword</p>";?>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="confirm" id="confirm"  placeholder="Confirm your Password"/>
								</div>
							</div>
						</div>

						<div class="form-group ">
							<input id="submit" name="submit" type="submit" value="Register" class="btn btn-primary">
						</div>
						
					</form>
				</div>
			</div>
		</div>
<?php
  mysqli_free_result($result);
  mysqli_close($connection); ?> 
	
	</body>
</html>
 <?php /* Add an employee to the table. */ 
 function AddUser($connection, $User_name,$User_Email,$User_password) {
   $uname = mysqli_real_escape_string($connection, $User_name);
   $email = mysqli_real_escape_string($connection, $User_Email);
   $pwd = mysqli_real_escape_string($connection, $User_password);
   $query = "INSERT INTO `food_donor` (`User_name`, `User_Email`,`User_password`) VALUES ('$uname', '$email','$pwd');";
   if(!mysqli_query($connection, $query))
       echo("<p>Error adding User data.</p>");
   else
       echo("<p> Registration Successful.Please proceed to Login.</p>");

} 
/* Check whether the table exists and, if not, create it. */ 
function VerifyUsersTable($connection, $dbName) {
  if(!TableExists("food_donor", $connection, $dbName))
  {
   /*  $query = "CREATE TABLE `Users` (
         `Fname` varchar(45) DEFAULT NULL,
         `Lname` varchar(45) DEFAULT NULL,
         `Uname` varchar(45) DEFAULT NULL,
         `Email` varchar(45) DEFAULT NULL,
         `Password` varchar(45) DEFAULT NULL,
         PRIMARY KEY (`Uname`)
       ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1"; */
	  /* $query = "CREATE TABLE `food_donor` (
        `ID` int(11) NOT NULL AUTO_INCREMENT,
        `User_name` varchar(20) NULL,
		`User_Email` varchar(20) NOT NULL,
        `User_password` varchar(45) NOT NULL,
		 PRIMARY KEY (`User_Email`)
      ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1"; */
	 $query = "CREATE TABLE `food_donor` (
        `ID` int(11)NOT NULL ,
        `User_name` varchar(20) NULL,
		`User_Email` varchar(20) NOT NULL,
        `User_password` varchar(45) NOT NULL,
		 PRIMARY KEY (`User_Email`),
		KEY(`ID`)
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

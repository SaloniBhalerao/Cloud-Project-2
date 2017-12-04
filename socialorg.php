<?php include "/var/www/inc/dbinfo.inc"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=yes">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta http-equiv="content-language" content="en" />
    <meta charset="utf-8">
    <title>Food Pickup Locations</title>
     <style>
      table{
      border-collapse:collapse;
      border-spacing: 50px 0;
      width:100%;
      color:#2895cc;
      font-family:"Roboto", sans-serif;
      font-size:15px;
      text-align:left;
      }
     th
     {
      background-color:#2895cc;
      color:white;
     }
     tr:nth-child(even){background-color: #f2f2f2}
     h2{
    display: block;
    font-size: 1.17em;
    margin-top: 2em;
    margin-bottom: 1em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
    text-align:left;
    float:left;
   }
  select{
    display: block;
    font-size: 1.17em;
    margin-top: 2em;
    margin-bottom: 1em;
    margin-left: 1em;
    margin-right: 0;
    font-weight: bold;
    text-align:left;
    float:left;
   }
input{
 display: block;
    font-size: 1.17em;
    margin-top: 2em;
    margin-bottom: 1em;
    margin-left: 1em;
    margin-right: 0;
    font-weight: bold;
    text-align:left;
    float:left;
   }
  </style>
  <style type="text/css">
   .contents { background-color:#EDF4F8; padding:8px; border:2px dashed #C2DAE7;margin-top:5em;margin-bottom:1em; }
   .contents p span { display:block;float:left; margin-left:0px; width:110px; color:gray; font-weight:bold;}
   .contents p select {float:left; margin-left:90px;}
   .contents p {clear:both;overflow:hidden;}
  </style>
   <?php
            $address = '396 Ano Nuevo Ave, Sunnyvale,California'; // Your address
            $prepAddr = str_replace(' ','+',$address);
            $geocode=file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&sensor=false');
            $output= json_decode($geocode);
             $lat = $output->results[0]->geometry->location->lat;
             $long = $output->results[0]->geometry->location->lng;
            // echo $address.'<br>Lat: '.$lat.'<br>Long: '.$long;
    ?>
  </head>
  <body>
  <h1> Welcome Social Organization</h1>
    <div id="map" style="width:100%;height:200px;"></div>
    <script>
      function initMap() {
        var myLat = <?php echo $lat; ?>;
        var myLong =<?php echo $long; ?>;
        var myLatLng = {lat:myLat, lng:myLong};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
          center: myLatLng
        });
        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'Google'
        });
      }
   </script>
   <script async defer
    src="https://maps.googleapis.com/maps/api/js?key&callback=initMap">
    </script>
   <div class="contents">
   <p><span><h2>Select the nearest Food Pickup Location:</h2></span> 
   <form name="nameOfForm" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
  <?php
  /* Connect to MySQL and select the database. */
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
  $database = mysqli_select_db($connection, DB_DATABASE);
  $result = mysqli_query($connection, "SELECT DISTINCT Event_city,ID FROM event_details group by Event_city");
    $select= '<select name="selectLoco" id="selectLoco">';
    $select.='<option value="All">All</option>';
    while($query_data = mysqli_fetch_row($result))
    {
       $select.='<option value="'.$query_data[1].'">'.$query_data[0].'</option>';
    }
 $select.='</select>';
 echo $select;
 echo "</t>";
 
 ?>
  <input type="submit" name="submit" value="Submit" /> </form>
 </p>
</div>
<h3>Select the option to pickup food and click on update </h3>
<h3>Download and view the food list made available by the event Organizer</h3>  
<form name="tableForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<?php 
  if($_GET){
  echo "<table>";
  echo "<tr>";
  echo "<th>Event ID </th>";
  echo "<th>Organization Name</th>";
  echo "<th>Event Name </th>";
  echo "<th>Event Address </th>";
  echo "<th>Event City </th>";
  echo "<th>Event State </th>";
  echo "<th>Zip Code </th>";
  echo "<th>Event Data </th>";
  echo "<th>Event Time </th>";
  echo "<th>Food Available </th>";
  echo "<th>Check for  Pickup  </th>";
  echo "<th>Download File </th>";
  echo "</tr>";
 /* Connect to MySQL and select the database. */
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
  $database = mysqli_select_db($connection, DB_DATABASE);
  $result1 = mysqli_query($connection ,"SELECT *  FROM event_details where  ID='" . $_GET['selectLoco'] . "'");
   while($query_data = mysqli_fetch_row($result1))
   {
    if($query_data[0] == $_GET['selectLoco'] ){
     $city =  $query_data[5];}
  }
  if($_GET['selectLoco']== "All"){
  $result = mysqli_query($connection, "SELECT * FROM event_details");}
  else{
  $result = mysqli_query($connection, "SELECT * FROM event_details where Event_city ='" . $city . "'");}
  while($query_data = mysqli_fetch_row($result))
  {
  echo "<tr><td>".$query_data[0]."</td><td>".$query_data[1]."</td><td>".
  $query_data[3]."</td><td>".$query_data[4]."</td><td>".$query_data[5]."</td><td>".
  $query_data[6]."</td><td>".$query_data[7]."</td><td>".
  $query_data[8]."</td><td>".$query_data[9]."</td><td>".$query_data[10].
  "</td><td>"."<input type='checkbox' name='id[]' value='" . $query_data[0] . "'/>".
  "</td><td>";
    $furl = "https://s3-us-west-1.amazonaws.com/foodfiles2017/Uploads/".$query_data[11];
    echo "<a href=\"$furl\">$query_data[11]</a>";
  echo "</br>";  
}
 
echo "</table>";
}
?>
<input type='submit' value='Update'></form>
<?php
if(gettype($_POST['id'])=="array"){
        foreach($_POST['id'] as $val){
         $id_c = $val;
         $query2 = "UPDATE event_details SET Food_availability = 'Marked For Pickup' where ID = $id_c AND Food_Availability = 'Ready to pickup'";
         $result2 = mysqli_query($connection,$query2);
         //echo "<h2>Food is marked for Pickup</h2>";
         $result3 = mysqli_query($connection ,"SELECT *  FROM event_details where  ID= $id_c");
  
while($query_data = mysqli_fetch_row($result3))
   {
     if($query_data[0] == $id_c ){
      $result4= mysqli_query($connection,"SELECT * from users where  user_name = '$query_data[2]'");
       while($query_data == mysqli_fetch_row($result4))
       {
        $email_address =  $query_data[4];
       }
     $organization_name = $query_data[0];
     }
   }

 require './vendor/autoload.php'; $mail = new PHPMailer; $mail->isSMTP();$mail->setFrom('anuksebastian@gmail.com','Admin'); $mail->addAddress('anuksebastian@gmail.com', 
'Admin'); $mail->Username = 'AKIAJVPHEDNCVUKPPAHQ'; $mail->Password = ''; $mail->Host = 'email-smtp.us-east-1.amazonaws.com'; $mail->Subject = 'Amazon SES test (SMTP interface accessed using PHP)'; 
$mail->Body = '<h1>Email Test</h1>
    <p>This email was sent through the
    <a href="https://aws.amazon.com/ses">Amazon SES</a> SMTP
    interface using the <a href="https://github.com/PHPMailer/PHPMailer">
    PHPMailer</a> class.</p>'; $mail->SMTPAuth = true; $mail->SMTPSecure = 'tls'; $mail->Port = 587; $mail->isHTML(true); $mail->AltBody = "Email Test\r\nThis email was sent through 
the
    Amazon SES SMTP interface using the PHPMailer class."; /*if(!$mail->send()) {
    echo "Email not sent. " , $mail->ErrorInfo , PHP_EOL;
} else {
    echo "Email sent!" , PHP_EOL;} 
      }*/
    }
}
?>
</html>

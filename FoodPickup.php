<?php include "../inc/dbinfo.inc"; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Food Pickup Locations</title>
    <h1> Food Pickup Locations </h1>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 75%;
        width :100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 75%;
        width:100%
        margin: 0;
        padding: 0;
      }
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
    <div id="map"></div>
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
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD90PWGvt1tTP4mS_tE2tKAHrkE1Y14o4Y&callback=initMap">
    </script>
  </body>
</html>

<?php
  session_start();
  /* Connect to MySQL and select the database. */
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

  $database = mysqli_select_db($connection, DB_DATABASE);

$result = mysqli_query($connection, "SELECT * FROM event_details");
echo "<table border =1>";
while($query_data = mysqli_fetch_row($result))
{
  //echo "<tr><td>".$query_data[0]."</td><td>".$query_data[1]."</td><td>".$query_data[2]."</td><td>".$query_data[3]."</td><td>".$query_data[4]."</td><td>".$query_data[5]."</td><td>".$query_d$
  echo "<tr><td>".$query_data[0]."</td><td>".$query_data[1]."</td><td>".$query_data[2]."</td><td>".$query_data[3]."</td><td>".$query_data[4]."</td><td>".$query_data[5]."</td><td>".$query_data[6]."</td><td>".$query_data[7]."</td><td>".$query_data[8]."</td><td>".$query_data[9]."</td><td>".$query_data[10]."</td><td><button id=".$data['button']." name=\"button\">Update</button></td></br>";
  echo "</br>";
}
echo "</table>";
?>


<!DOCTYPE html>
<html>

<head>
  
  <title>Food4Need.org</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/indexpagetheme.css">
</head>


<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#myPage">Food4Need</a>
    </div>
	 <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
         <li><a href="#myPage">HOME</a></li>
        <li><a href="#tour">ABOUT US</a></li>
        <li><a href="#contact">CONTACT</a></li>
	<li><a href="#" data-toggle="modal" data-target="#theModal" data-backdrop="static">CHAT WITH US</a>
    </li>
    </ul>

    <ul class="nav navbar-nav navbar-right">
	 <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#signup"><span class="glyphicon glyphicon-user"></span>Sign up <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="eventOrgRegistration.php">Signup as Event Organiser</a></li>
          <li><a href="socialOrgRegistration.php">Signup as Social Organisation</a></li>
         
        </ul>
      </li>
      <li><a href="loginpage.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
	</div>
  </div>
</nav>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="https://s3-us-west-1.amazonaws.com/projfoodfiles2017/intro1.jpg" alt="Help" width="500" height="500">
        <div class="carousel-caption">
          <h3>Care</h3>
          <p>We help in creating a better world</p>
        </div>      
      </div>

      <div class="item">
        <img src="https://s3-us-west-1.amazonaws.com/projfoodfiles2017/intro2.jpg" alt="donate" width="500" height="500">
        <div class="carousel-caption">
          <h3>Give</h3>
          <p>Giving is making a difference in others life</p>
        </div>      
      </div>
    
      <div class="item">
        <img src="https://s3-us-west-1.amazonaws.com/projfoodfiles2017/intro3.jpg" alt="share" width="500" height="500">
        <div class="carousel-caption">
          <h3>Share</h3>
          <p>You grow when you start sharing</p>
        </div>      
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>

<!-- Container (The Band Section) -->
<div id="band" class="container text-center">

</div>

<!-- Container (TOUR Section) -->
<div id="tour" class="bg-1">
  <p align="justify">
  People waste an unfathomable amount of food! <br/>According to the Guardian report released roughly fifty percent of all produce in the United States is thrown away, for example around 60 million tons worth of produce annually, an amount constituting "one-third of all foodstuff". Wasted food is also the biggest occupant in American landfills, the Environmental Protection agency has found when it comes to catering food for attendees at events, the food is always ordered in excess. On the other hand, there are many people in the society, who are in need for food and this excess food from the above events can fulfill their needs. Controlling food wastage is one of the concerning issues for any nation; therefore we have taken a pledge to march towards reduction of food wastage and providing it to the needy. 
  </p>
</div>

<!-- Container (Contact Section) -->
<div id="contact" class="container">
  <h3 class="text-center">Contact</h3>
  <p class="text-center"><em>We encourage your contribution</em></p>

  <div class="row">
    <div class="col-md-4">
      <p>Have any doubts?</p>
      <p><span class="glyphicon glyphicon-map-marker"></span>San Jose, US</p>
      <p><span class="glyphicon glyphicon-phone"></span>Phone: +00 1515151515</p>
      <p><span class="glyphicon glyphicon-envelope"></span>Email: admin@food4need.org</p>
    </div>
    <div class="col-md-8">
      <div class="row">
    
	<form name="contactForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	   <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name"  placeholder="Name" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" value="" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea>
      <br>
      <div class="row">
        <div class="col-md-12 form-group">
          <input class="btn pull-right" type="submit" id="submit" value="submit"/>
        </div>
      </div>
	</form>
    </div>
  </div>
  <br>
  <h3 class="text-center">From The People</h3>  

<div id="myCarousel1" class="carousel slide text-center" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
    <h4>"This organisation is the best. They help in serving the needy!"<br><span style="font-style:normal;">Michael Roe, Trustee, Childcare.org</span></h4>
    </div>
    <div class="item">
      <h4>"They updates provided by them helps me to deliver food soon... WOW!!"<br><span style="font-style:normal;">Paul, Volunteer, foodpickup.com</span></h4>
    </div>
    <div class="item">
      <h4>"I can easily post the event and give the food easily"<br><span style="font-style:normal;">Armana Bing, Event Organiser</span></h4>
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>




<div id="googleMap" style="padding:10px;height:250px"></div>

  <div id="theModal" class="modal fade text-center" >
    <div class="modal-dialog" style="height:80%">
      <div class="modal-content">
   	<div class="modal-header" style="padding:5px">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title">Chat with food4need.org </h4>
        </div> 
	<div id="bot" class="modal-body">
      		<script>
 		    document.getElementById("bot").innerHTML='<object type="text/html" data="chatbot.html" style="width:500px;height:300px;overflow-y:auto"></object>';
		</script>
	    </div>
	<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>      
    </div>
  </div>
</div>
<script>
function myMap() {
var myCenter = new google.maps.LatLng(37.3382, -121.8863);
var mapProp = {center:myCenter, zoom:12, scrollwheel:false, draggable:false, mapTypeId:google.maps.MapTypeId.ROADMAP};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
var marker = new google.maps.Marker({position:myCenter});
marker.setMap(map);
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD90PWGvt1tTP4mS_tE2tKAHrkE1Y14o4Y&callback=myMap"></script>

<!--<div id="googleMap">
<img src="sjmap.png"> 

</div> -->
<!-- Footer -->
<footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p>2017&copy;www.food4need.org </p> 
</footer>

<script>
$(document).ready(function(){
  // Initialize Tooltip
  $('[data-toggle="tooltip"]').tooltip(); 
 /* function goToByScroll(id){
    $('html,body').animate({scrollTop: $("#"+id).offset().top},'slow');
} */
  
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {

      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
      //  window.location.hash = hash;
      });
    } // End if
  });
})
</script>
<?php echo $email ?>
</body>
</html>



<?php
use Aws\Ses\SesClient;
use Aws\Ses\Exception\SesException;

//echo "<p>$email</p>";
//echo "hello world";
//  if (isset($_POST['submit'])) {
if(!empty($_POST['email']))
{
$email=$_POST['email'];
echo $email;
// Replace path_to_sdk_inclusion with the path to the SDK as described in 
// http://docs.aws.amazon.com/aws-sdk-php/v3/guide/getting-started/basic-usage.html
define('REQUIRED_FILE','/var/app/current/vendor/autoload.php'); 
                                                  
// Replace sender@example.com with your "From" address. 
// This address must be verified with Amazon SES.
define('SENDER', 'admin@food4need.org');           

// Replace recipient@example.com with a "To" address. If your account 
// is still in the sandbox, this address must be verified.
define('RECIPIENT', $email);    
// Specify a configuration set. If you do not want to use a configuration
// set, comment the following variable, and the 
// 'ConfigurationSetName' => CONFIGSET argument below.


// Replace us-west-2 with the AWS Region you're using for Amazon SES.
define('REGION','us-west-2'); 

define('SUBJECT','Thanks for writing to us-www.food4need.org');

define('HTMLBODY','<h1> Greetings from Food4need.org</h1>.<p>Thank you for contacting us and sending your queries.We will get back to you as early as possible. For more details visit<a> www.food4need.org</a></p>');
define('TEXTBODY','Thank you for contacting us and sending your queries.We will get back to you as early as possible. For more details visit www.food4need.org.');

define('CHARSET','UTF-8');

require REQUIRED_FILE;


$client = SesClient::factory(array(
    'version'=> 'latest',     
    'region' => REGION
));

try {
     $result = $client->sendEmail([
    'Destination' => [
        'ToAddresses' => [
            RECIPIENT,
        ],
    ],
    'Message' => [
        'Body' => [
            'Html' => [
                'Charset' => CHARSET,
                'Data' => HTMLBODY,
            ],
			'Text' => [
                'Charset' => CHARSET,
                'Data' => TEXTBODY,
            ],
        ],
        'Subject' => [
            'Charset' => CHARSET,
            'Data' => SUBJECT,
        ],
    ],
    'Source' => SENDER,
    // If you are not using a configuration set, comment or delete the
    // following line
  //  'ConfigurationSetName' => CONFIGSET,
]);
     $messageId = $result->get('MessageId');
     echo("Email sent! Message ID: $messageId"."\n");

} catch (SesException $error) {
     echo("The email was not sent. Error message: ".$error->getAwsErrorMessage()."\n");
}
}
//}
?>


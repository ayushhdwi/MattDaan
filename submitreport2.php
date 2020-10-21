<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="stylesheets/form.css">
  <link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	<title>Enter Report</title>
</head>


<body>

<nav class="navbar">
		<div class="logo">
			<a href="index.php"><img class="logopic" src="img/logo.png"></a>
		</div>
		<ul class="butlist">
			<span class="butres">
				<li><a href="about.php">ABOUT</a></li>
				<li><a href="news.php">NEWSFEED</a></li>
				<li style="float:left;"><a href="news.php">MATT&nbsp;DAAN</a></li>
			</span>
		</ul>
	</nav>


<div style="color:transparent; padding-bottom:30px;">
  a
</div>

<div class="container">
  <div class="col1">
  <form id="contact" action="includes/complaintform2.inc.php" method="post" enctype="multipart/form-data" name="report">
    <h3 class="submithead">Submit a Report</h3>
    <h4>Fill up the form</h4>
    <fieldset>
      <input placeholder="Your name"  type="text" tabindex="1" required="true" autofocus name="name">
    </fieldset>
    <fieldset>
      <input placeholder="Your Email Address" type="email" tabindex="2" required="true" name="email">
    </fieldset>
    <fieldset>
      <input placeholder="Your VoterID" type="text" tabindex="3" required="true" name="voterid">
    </fieldset>
    <fieldset>
    	<input placeholder="Your Response" type="text" tabindex="3" required="true" name="response">
    </fieldset>
    <fieldset>
    	<input type="file" accept="image/*" name="imageUpload">
    </fieldset>
      <input style="opacity: 0" type="text" id="lat" name="lat" novalidate>
      <input style="opacity: 0" type="text" id="lng" name="lng" novalidate>
    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Send OTP</button>
    </fieldset>
   </form>
  </div>
    <!--<button id="get_loc" onclick="chooseLoc();return;">Get your location</button>-->
    <div class="col2">
    <button type="button" id="get_loc" onclick="chooseLoc();return;">Get your Location</button>
    <div id="map"></div>
  </div>
  


</div>
<script>
var map;
var coords;
var yourMarker;
var lat=0;
var lng=0;
function getLoc(){

  lat=yourMarker.getPosition().lat();
  lng=yourMarker.getPosition().lng();
  document.getElementById("lat").value=lat;
  document.getElementById("lng").value=lng;
  console.log(document.getElementById("lat").value);
  console.log(document.getElementById("lng").value);
}

function chooseLoc(){
  navigator.geolocation.getCurrentPosition(function(pos){
      coords={lat:pos.coords.latitude,lng:pos.coords.longitude};
      console.log(coords);
      yourMarker = new google.maps.Marker({position: coords,title:"You",icon:'http://earth.google.com/images/kml-icons/track-directional/track-0.png', map: map});
      getLoc();
    }, function(error){
      alert("Choose your location");
      console.log(error)
      yourMarker = new google.maps.Marker({position: {lat:20.5937,lng:78.9629},title:"You",icon:'http://earth.google.com/images/kml-icons/track-directional/track-0.png', map: map,draggable:true});
      getLoc();
      }, {
        enableHighAccuracy: true,
        timeout: 5000,
        maximumAge: 0
      });
}
function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {zoom: 4, center: {lat:20.5937,lng:78.9629}});
}
</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQX9reaTqze5_cxq1sMlU_uQIkLt1n4ZY&callback=initMap">
</script>
</body>
</html>

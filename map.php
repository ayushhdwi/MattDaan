<!doctype html>
<html lang="en">
<meta charset="utf-8">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="stylesheets/map.css">
  <title>Map Hotspots</title>
  <link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
</head>
<body>
<nav class="navbar">
		<div class="logo">
			<a href="index.php"><img class="logopic" alt="MattDaan Logo" src="img/logo.png"></a>
		</div>
		<ul class="butlist">
			<span class="butres">
				<li><a href="about.php">ABOUT</a></li>
				<li><a href="news.php">NEWSFEED</a></li>
				<li style="float:left;"><a href="news.php">MATT&nbsp;DAAN</a></li>
			</span>
		</ul>
	</nav>
  
<div class="main">
  <div class="col1">
    <div class="info">
      <div class="infohead">
        Election Malpractice Hotspots
      </div>
      <div class="infotext">
        The map shows the locations where incidents have been reported by other users. 
        Click on 'Go to your location' to check the incidents around you, and stay safe during election time.
        <button id="gotohome" onclick="gohome();return;">Go to your location</button>
      </div>
    </div>
  </div>

  <div class="col2">
    <div id="map"></div>
  </div>

</div>

<script>
  let map;
  coords={};
  let heatmapData=[];
  let icons=[
    'http://maps.google.com/mapfiles/ms/icons/green-dot.png',
    'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
    'http://maps.google.com/mapfiles/ms/icons/red-dot.png'
  ]

  function gohome(){
    map.panTo(coords);
  }
  
  function initMap() {
    navigator.geolocation.getCurrentPosition(pos => {
      
      // Gets your coordinates
      coords={
        lat:pos.coords.latitude,
        lng:pos.coords.longitude
      };

      // prints your coordinates on console
      console.log(coords);
      
      map = new google.maps.Map(document.getElementById('map'), {zoom: 12, center: coords});
      
      // Marking your location
      let yourMarker = new google.maps.Marker({
        position: coords,
        title:"You",
        icon:'http://earth.google.com/images/kml-icons/track-directional/track-0.png',
        map: map});
      
      // list of latitude and longitudes
      let list=[
        {coords:{lat:13,lng:79},type:'murder',priority:6},
        {coords:{lat:14,lng:79},type:'booth-capturing',priority:2},
        {coords:{lat:28,lng:77},type:'threatening',priority:4},
        {coords:{lat:19,lng:72},type:'impersonat',priority:2},
        {coords:{lat:12,lng:77},type:'murder',priority:4},
        {coords:{lat:17,lng:78},type:'bribery',priority:2}
      ];
      // adding list data to heatmap data
      for(i=0;i<list.length;i++){
          heatmapData.push({
            location:new google.maps.LatLng(list[i].coords.lat,list[i].coords.lng),
            weight:list[i].priority})
      }
      // adds markers to map
      addMarkers(list);
      },
      error => {
        coords={lat:20.5937,lng:78.9629};
        map = new google.maps.Map(document.getElementById('map'), {zoom: 4, center: coords});
        let yourMarker = new google.maps.Marker({position: coords,title:"You",icon:'http://earth.google.com/images/kml-icons/track-directional/track-0.png', map: map});
        let list=[{coords:{lat:13,lng:79},type:"Ladai",priority:5},{coords:{lat:11,lng:79},type:"twenty",priority:1},{coords:{lat:14,lng:76},type:"Fuck off",priority:2}]
        // adds markers to Map
        addMarkers(list);
        console.log("This Browser Doesnt support geolocation");
      },
      {
        enableHighAccuracy: true,
        timeout: 5000,
        maximumAge: 0
      }
    );
    console.log("Marking")
  }

  function checkHeatMap(){
    let heatmap = new google.maps.visualization.HeatmapLayer({data: heatmapData});
    console.log(heatmap);
    heatmap.setMap(heatmap);
  }

  function addMarkers(list){
    for(let i=0;i<list.length;i++){
      if(list[i].priority<=2){
        let newMarker = new google.maps.Marker({
          icon:icons[0],
          position: list[i].coords,
          title:list[i].type,
          map: map});
      } 
      else if(list[i].priority<=4) {
        let newMarker = new google.maps.Marker({
          icon:icons[1],
          position: list[i].coords,
          title:list[i].type,
          map: map});
      } 
      else {
        let newMarker = new google.maps.Marker({
          icon:icons[2],
          position: list[i].coords,
          title:list[i].type,
          map: map});
      }
      console.log(list[i])
    }
  }
</script>

<script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDx4nj_IkiIKVnd06Fhmah12CF7rwDmLzg&libraries=visualization">
</script>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDx4nj_IkiIKVnd06Fhmah12CF7rwDmLzg&callback=initMap">
</script>

</body>
</html>

<!-- Map API key : AIzaSyDx4nj_IkiIKVnd06Fhmah12CF7rwDmLzg -->
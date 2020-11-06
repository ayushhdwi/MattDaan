<?php
include_once 'includes/dbh.inc.php';

$year = '2020';
$t1n = "SELECT count(*) as c from complains where year(date) ='".$year."' and crime_type = 'impersonat';";
$t2n = "SELECT count(*) as c from complains where year(date) ='".$year."' and crime_type = 'booth-capturing';";
$t3n = "SELECT count(*) as c from complains where year(date) ='".$year."' and crime_type = 'murder';";
$t4n = "SELECT count(*) as c from complains where year(date) ='".$year."' and crime_type = 'blackmail';";
$t5n = "SELECT count(*) as c from complains where year(date) ='".$year."' and crime_type = 'bribe';";
$t6n = "SELECT count(*) as c from complains where year(date) ='".$year."' and crime_type = 'other';";

$tq1n = mysqli_query($conn,$t1n);
$tq2n = mysqli_query($conn,$t2n);
$tq3n = mysqli_query($conn,$t3n);
$tq4n = mysqli_query($conn,$t4n);
$tq5n = mysqli_query($conn,$t5n);
$tq6n = mysqli_query($conn,$t6n);
$c1=0;
$c2=0;
$c3=0;
$c4=0;
$c5=0;
$c6=0;
while($row= @mysqli_fetch_array($tq1n)){
	$c1= $row[0];
	}
while($row= @mysqli_fetch_array($tq2n)){
	$c2= $row[0];
	}
while($row= @mysqli_fetch_array($tq3n)){
	$c3= $row[0];
	}
while($row= @mysqli_fetch_array($tq4n)){
	$c4= $row[0];
	}
while($row= @mysqli_fetch_array($tq5n)){
	$c5= $row[0];
	}
while($row= @mysqli_fetch_array($tq6n)){
	$c6= $row[0];
	}

echo '
<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="stylesheets/charts.css"/>
	<link rel="stylesheet" type="text/css" href="stylesheets/hover.css"/>
	<link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	<title>Crime Stats</title>
	<script>
		function genChart(){
		document.getElementsByClassName("selectopts")[0].style.display="none"
		document.getElementById("chartContainer").style.display="block"
		document.getElementById("barchartContainer").style.display="block"
		let data=[
		{ y: '.$c1.', label: "Impersonation" },
		{ y: '.$c2.', label: "Booth-Capturing" },
		{ y: '.$c3.', label: "Murder" },
		{ y: '.$c4.', label: "BlackMail" },
		{ y: '.$c5.', label: "Bribe" },
		{ y: '.$c6.', label: "other" }
		];
		let datapoints=[];
		let datapoints2=[];
		datapoints2=data;
		let total=0;
		for(let i=0;i<data.length;i++){
		total+=data[i].y
		}
		for(let i=0;i<data.length;i++){
		datapoints.push({y:data[i].y/total*100,label:data[i].label})
		}

		var chart = new CanvasJS.Chart("chartContainer", {
			theme: "light2", // "light1", "light2", "dark1", "dark2"
			exportEnabled: true,
			animationEnabled: true,
			title: {
				text: "Heading"
			},
			data: [{
				type: "pie",
				startAngle: 25,
				toolTipContent: "<b>{label}</b>: {y}%",
				showInLegend: "true",
				legendText: "{label}",
				indexLabelFontSize: 16,
				indexLabel: "{label} - {y}%",
				dataPoints: datapoints
			}]
		});
		chart.render();
		var barchart = new CanvasJS.Chart("barchartContainer", {
			animationEnabled: true,
			theme: "light2", // "light1", "light2", "dark1", "dark2"
			title:{
				text: "Electoral crimes"
			},
			axisY: {
				title: "Number of crimes"
			},
			data: [{
				type: "column",
				showInLegend: true,
				legendMarkerColor: "grey",
				legendText: "Number of crimes",
				dataPoints: datapoints2
			}]
		});
		barchart.render();

		}
	</script>
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
	<div class="selectopts">
		
		<div class="dropdown">
			<select class="selyr">
				<option class="yropt" value="2020">2020</option>
				<option class="yropt" value="2019">2019</option>
				<option class="yropt" value="2018">2018</option>
			</select>
		</div>
		
		<div class="getbut">
			<button id="generate_chart" onclick="genChart();return;">Get charts</button>
		</div>
	</div>

	<div id="chartContainer" style="height: 400px; width: 90%;"></div>
	<div id="barchartContainer" style="height: 400px; width: 90%;"></div>

</div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>';
?>
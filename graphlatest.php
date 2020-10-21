<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="stylesheets/charts.css"/>
	<link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	<script>
		function genChart(){
			document.getElementById("generate_chart").style.display="none"
			document.getElementById("chartContainer").style.display="block"
			document.getElementById("barchartContainer").style.display="block"
			document.getElementById("heading").innerHTML="The statistical data for the malpractices in the current year using Pie Chart and Bar Graph."

			let data=[{ y: '.$c1.', label: "Murder" },
			{ y: '.$c2.', label: "Impersonation" },
			{ y: '.$c3.', label: "Bribery" },
			{ y: '.$c4.', label: "Booth-Capturing" },
			{ y: '.$c5.', label: "Threatening" },
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
					text: "Electoral Crimes (by percentage)"
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
					text: "Total Electoral crimes"
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

	<p class="charttext" id="heading">Display the statistical data for the malpractices in the current year using Pie Chart and Bar Graph.</p>
	<button id="generate_chart" onclick="genChart();return;">Get charts</button>
	<div id="chartContainer" style="height: 400px; width: 90%;"></div>
	<div id="barchartContainer" style="height: 400px; width: 90%;"></div>

	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	
	<?php
		include_once 'includes/dbh.inc.php';

		$year = '2019';
		$query = "SELECT * FROM complains where year ='".$year."';";
		$t1n = "SELECT count(*) as c from complains where year ='".$year."' and type = 'murder';";
		$t2n = "SELECT count(*) as c from complains where year ='".$year."' and type = 'impersonation';";
		$t3n = "SELECT count(*) as c from complains where year ='".$year."' and type = 'bribery';";
		$t4n = "SELECT count(*) as c from complains where year ='".$year."' and type = 'booth-capturing';";
		$t5n = "SELECT count(*) as c from complains where year ='".$year."' and type = 'threatening';";
		$tq1n = mysqli_query($conn, $t1n);
		$tq2n = mysqli_query($conn, $t2n);
		$tq3n = mysqli_query($conn, $t3n);
		$tq4n = mysqli_query($conn, $t4n);
		$tq5n = mysqli_query($conn, $t5n);
		$c1=0;
		$c2=0;
		$c3=0;
		$c4=0;
		$c5=0;
		while ($row= mysqli_fetch_row($tq1n)) {
			$c1= $row[0];
		}
		while ($row= mysqli_fetch_row($tq2n)) {
			$c2= $row[0];
		}
		while ($row= mysqli_fetch_row($tq3n)) {
			$c3= $row[0];
		}
		while ($row= mysqli_fetch_row($tq4n)) {
			$c4= $row[0];
		}
		while ($row= mysqli_fetch_row($tq5n)) {
			$c5= $row[0];
		}
	?>
</body>
</html>
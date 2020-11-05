<?php
	$otp = $_COOKIE['otp'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="stylesheets/otp.css">
	<link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	<title>Enter Report</title>
</head>

<body >
	<nav class="navbar">
		<div class="logo">
			<a href="index.php"><img class="logopic" alt="logo" src="img/logo.png"></a>
		</div>
		<ul class="butlist">
			<span class="butres">
				<li><a href="about.php">ABOUT</a></li>
				<li><a href="news.php">NEWSFEED</a></li>
				<li style="float:left;"><a href="news.php">MATT&nbsp;DAAN</a></li>
			</span>
		</ul>
	</nav>

	<div class="container">
	<form id="check_otp" action="verify.php" method="post">
		<input id="text_field" type="text" placeholder="Enter your OTP" name="otp">
		<input id="verify_but" type="submit" value="Verify OTP">
	</form>
	</div>

	<div id="resp_modal" class="modal">
	<div class="modal-body">
		<span class="close">&times;</span>
		<p id="response"></p>
	</div>
	</div>

	<?php
	if(isset($_POST['otp'])){
		$ootp = $_POST['otp'];
		if($otp==$ootp){
		echo '
			<script>
			document.getElementsByClassName("modal")[0].style.display = "block";
			document.getElementById("response").innerHTML="The OTP entered is correct. Your report has been submitted. Close the dialog box to go to home page.";	
		';
	}
		else{
			echo '
			<script>
			document.getElementsByClassName("modal")[0].style.display = "block";
			document.getElementById("response").innerHTML="The OTP entered is incorrect. Your report has not been submitted. Close the dialog box to go to home page.";
			';
	}
		echo'
			document.getElementsByClassName("close")[0].onclick = function() {
			document.getElementsByClassName("modal")[0].style.display = "none";
			window.location.href="/dashboard/mystuff/matt_daan1/submitreport2.php"
			}
			window.onclick = function(event) {
			if (event.target == modal) {
				document.getElementsByClassName("modal")[0].style.display = "none";
				window.location.href="//dashboard/mystuff/matt_daan1/submitreport2.php"
			}
			}
			</script>
			</body>
			</html>';
	}
	?>
</body>
</html>
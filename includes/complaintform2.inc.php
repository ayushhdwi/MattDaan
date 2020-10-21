<?php
	include_once('dbh.inc.php');
	$words = array(
		array("impersonation","impersonate","impersonated","characterization","simulation","falsifying"),
		array("capture","capturing","booth-capturing","hijacked","captured","confiscated"),
		array("murder","kill","murdered","killed","killing","murdering"),
		array("blackmail","blackmailing","blackmailed","threatening","threaten","threatened"),
		array("bribe","bribery","corrupt","corruption","paying","pay")
	);



	$freq = array(0,0,0,0,0);

	function updateFreq($word){
		for($i=0;$i<6;$i++){
			for($j=0;$j<6;$j++){
				$arrayString = $words[$i][$j];
				if(strcmp($word,$arrayString)==0){
					$freq[$i]+=1;
				}
			}
		}
	}


	$name = $_POST['name'];	
	$email = $_POST['email'];
	$voterid = $_POST['voterid'];
	$responseOrg = $_POST['response'];
	$response = strtolower($responseOrg." "); 
	$leng = strlen($response);
	$lat = $_POST['lat'];
	$lon = $_POST['lng'];
	$prev = 0;

	
	for($i=0;$i<$leng;$i++){
		if($response{$i}==' '){
			$l = $i - $prev;
			$extword = substr($response, $prev,($i-$prev));
			for($j=0;$j<5;$j++){
			for($k=0;$k<6;$k++){
				$arrayString = $words[$j][$k];
				if(strcmp($extword,$arrayString)==0){
					$freq[$j]+=1;
				}
			}
			}
			echo "<i>".$extword."</i>"."<br>";
			$prev = $i;
		}
	}

	$max = $freq[0];
	$ind = 0;

	for($i=1;$i<5;$i++){
		if($freq[$i]>$max){
			$max = $freq[$i];
			$ind = $i;
		}	
	}
	if(($ind == 0)){
		if($freq[0]!=0)
			$type = 'impersonation';
		else
			$type = 'other';
	}
	else if(($ind ==1))
		$type = 'booth-capturing';
	else if($ind == 2)
		$type = 'murder';
	else if($ind ==3)
		$type = 'blackmail';
	else if($ind == 4)
		$type = 'bribe';

	


	if(isset($_POST['submit'])) {
		//Process the image that is uploaded by the user
		$target_dir = "../uploads/";
		$target_file = $target_dir . basename($_FILES["imageUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

		if (move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $target_file)) {
			echo "The file ". basename( $_FILES["imageUpload"]["name"]). " has been uploaded.\n";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}

		$image=basename( $_FILES["imageUpload"]["name"]."12345",".jpg");
		echo $image."\n"; // used to store the filename in a variable

		$query = "INSERT INTO COMPLAINS values(NULL,'".$voterid."','".$email."','".$responseOrg."','".$type."','".'uploads/'.basename($_FILES["imageUpload"]["name"])."','vellore',sysdate(),year(sysdate()),'".$lat."','".$lon."');";

		mysqli_query($conn,$query);
	
		echo "Your add has been submited, you will be redirected to your account page in 3 seconds....\n";
		//header( "Refresh:3; url=../index.php", true, 303);
		header('LOCATION: ../report.php?email='.$email);
	}
?>
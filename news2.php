<?php
include_once 'includes/dbh.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="stylesheets/news.css">
  <link rel="stylesheet" type="text/css" href="stylesheets/hover.css"/>
  <link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
  <title>Enter Report</title>
</head>


<body>

<nav class="navabar">
  <div class="logo">
    <a href="index.php"><img class="logopic" src="img/logo.png"></a>
  </div>
  <ul class="butlist">
    <span class="butres">
      <li class="hvr-glow">
        <a href="#">ABOUT</a>
      </li>
      <li class="hvr-glow">
        <a href="news.php">NEWSFEED</a>
      </li>
    </span>
  </ul>
</nav>

<p class="newshead">NewsFeed</p>
<span class="dropdown">
<p class="dropdowntext">Filter by type of incident</p>
<span class="dd">
<form method="POST" action="news2.php">
<select class="selinc" name="filter">
  <option class="incopt" value="murder">Murder</option>
  <option class="incopt" value="impersonation">Impersonation</option>
  <option class="incopt" value="booth-capturing">Booth Capturing</option>
  <option class="incopt" value="threatening">Threatening</option>
  <option class="incopt" value="bribery">Bribery</option>
</select>
<input id="filter_but" type="submit" value="Filter">
</form>
</span>
</span>

<div class="feed">
  <?php
  $filter = $_POST['filter'];
  $query = "SELECT date,location,type FROM complains where type='".$filter."' order by date desc;";
  $run_query = @mysqli_query($conn,$query);
  while($row= @mysqli_fetch_row($run_query)){
    
    $date=$row[0];
    $location=$row[1];
    $type=$row[2];
    echo('
        <div class="feedbox">
        <ul class="feedlist">
      <li>
        <span class="fieldhead">Date and time:</span><span class="fielddata">'.$type.'</span>
      </li>
      <li>
        <span class="fieldhead">Date and time:</span><span class="fielddata">'.$date.'</span>
      </li>
      <li>
        <span class="fieldhead">Location:</span><span class="fielddata">'.$location.'</span>
      </li>
    </ul>
  </div>

      ');

  }

  ?>
</div>  
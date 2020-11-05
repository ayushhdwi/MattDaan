<?php
  include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="stylesheets/news.css">
  <link rel="stylesheet" type="text/css" href="stylesheets/hover.css"/>
  <link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
  <title>Newsfeed</title>
</head>

<body>
  <nav class="navabar">
    <div class="logo">
      <a href="index.php"><img class="logopic" alt="logo" src="img/logo.png"></a>
    </div>
    <ul class="butlist">
      <span class="butres">
        <li class="hvr-glow">
          <a href="about.html">ABOUT</a>
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
      <form method="POST" action="news.php">
        <select class="selinc" name="filter">
          <option class="incopt" value="impersonation">Impersonation</option>
          <option class="incopt" value="booth-capturing">Booth Capturing</option>
          <option class="incopt" value="murder">Murder</option>
          <option class="incopt" value="blackmail">Threatening</option>
          <option class="incopt" value="bribe">Bribery</option>
          <option class="incopt" value="other">Other</option>
        </select>
        <input id="filter_but" type="submit" value="filter">
      </form>
    </span>
  </span>

  <div class="feed">
    <?php
    if(isset($_POST['filter'])) {
      $filter = $_POST['filter'];
      $query = "SELECT date, crime_type FROM complains where crime_type='".$filter."';";
      $run_query = mysqli_query($conn,$query);
      while($row= mysqli_fetch_row($run_query)) {
        $date=$row[0];
        $type=$row[1];
        // $location=$row[1];
        echo '
          <div class="feedbox">
            <ul class="feedlist">
              <li>
                <span class="fieldhead">Crime Type : </span><span class="fielddata">'.$type.'</span>
              </li>
              <li>
                <span class="fieldhead">Date : </span><span class="fielddata">'.$date.'</span>
              </li>
            </ul>
          </div>
        ';
      }
    }
    ?>
  </div>
  </body>
  </html>
<html>
<head>
<script src="../js/sorttable.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>TV Show Listings</title>
<style>
tr:nth-child(even) {
    background-color: #EEE;
}
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;
}
</style>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                  <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Kreg's Plex</a>
    </div>
        <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
      <li class="active"><a href="../controller/controller.php?action=default">Home</a></li>
      <li class="active"><a href="../controller/controller.php?action=showMovies">Show All</a></li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Filter by Genre
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="../controller/controller.php?action=showTVAdventure">Adventure</a></li>
          <li><a href="../controller/controller.php?action=showTVCartoon">Cartoon</a></li>
          <li><a href="../controller/controller.php?action=showTVComedy">Comedy</a></li>
          <li><a href="../controller/controller.php?action=showTVCooking">Cooking</a></li>
          <li><a href="../controller/controller.php?action=showTVCrime">Crime</a></li>
          <li><a href="../controller/controller.php?action=showTVDrama">Drama</a></li>
          <li><a href="../controller/controller.php?action=showTVEducational">Educational</a></li>
          <li><a href="../controller/controller.php?action=showTVHistory">History</a></li>
          <li><a href="../controller/controller.php?action=showTVHorror">Horror</a></li>
          <li><a href="../controller/controller.php?action=showTVPolitical">Political</a></li>
          <li><a href="../controller/controller.php?action=showTVReality">Reality</a></li>
          <li><a href="../controller/controller.php?action=showTVSciFi">Sci-Fi</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Filter by Channel
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="../controller/controller.php?action=showABC">ABC</a></li>
          <li><a href="../controller/controller.php?action=showAMC">AMC</a></li>
          <li><a href="../controller/controller.php?action=showBBC">BBC</a></li>
          <li><a href="../controller/controller.php?action=showCartoonNetwork">Cartoon Network</a></li>
          <li><a href="../controller/controller.php?action=showComedyCentral">Comedy Central</a></li>
          <li><a href="../controller/controller.php?action=showDiscoveryChannel">Discovery Channel</a></li>
          <li><a href="../controller/controller.php?action=showFX">FX</a></li>
          <li><a href="../controller/controller.php?action=showFoodNetwork">Food Network</a></li>
          <li><a href="../controller/controller.php?action=showFox">Fox</a></li>
          <li><a href="../controller/controller.php?action=showHBO">HBO</a></li>
          <li><a href="../controller/controller.php?action=showIFC">IFC</a></li>
          <li><a href="../controller/controller.php?action=showMTV">MTV</a></li>
          <li><a href="../controller/controller.php?action=showNBC">NBC</a></li>
          <li><a href="../controller/controller.php?action=showNickelodeon">Nickelodeon</a></li>
          <li><a href="../controller/controller.php?action=showShowtime">Showtime</a></li>
          <li><a href="../controller/controller.php?action=showSpikeTV">Spike TV</a></li>
          <li><a href="../controller/controller.php?action=showUSA">USA</a></li>
        </ul>
      </li>
            <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Filter by Show Ended
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="../controller/controller.php?action=showEnded">Yes</a></li>
          <li><a href="../controller/controller.php?action=showNotEnded">No</a></li>
        </ul>
      </li>
    </ul>
    </div>
  </div>
</nav>
<center><h1>TV Show Listings</h1></center>
<br>
<p>Shows In Database: <?php echo $total ?></p>
<br>
<br>
<table class="sortable">
<tr>
	<th>Name</th>
	<th>Seasons Owned</th>
	<th>Total Seasons</th>
	<th>Genre</th>
	<th>Channel</th>
	<th>Actors</th>
	<th>Show Ended</th>
	<th>Date Added</th>
</tr>
<?php foreach ($results as $row){
$showName = $row['Name'];
$seasonsOwned = $row['SeasonsOwned'];
$seasonsTotal = $row['SeasonsTotal'];
$showGenre = $row['Genre'];
$showChannel = $row ['Channel'];
$showActors = $row['Actors'];
$showEnded = $row['ShowEnded'];
$showAdded = $row['DateAdded'];
$showIMDB = $row['IMDB']; ?>
<?php echo '<tr><td><a target="_blank" href="'.$showIMDB. '">'. $showName. '</a>'. '</td>' .
'<td>' . $seasonsOwned . '</td>' .
'<td>' . $seasonsTotal . '</td>' .
'<td>' . $showGenre . '</td>' .
'<td>' . $showChannel . '</td>' .
'<td>' . $showActors . '</td>' .
'<td>' . $showEnded . '</td>' . 
'<td>' . $showAdded . '</td></tr>'; ?>
<?php } ?>

</body>
</html>
<html>
<head>
<title>Kreg's Plex Database</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="../js/sorttable.js"></script>
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
a {
	padding-left: 10px;
}

span.line {
  display: inline-block;
}
</style>
  </head>
<body>
<center><img src="../images/logo.png" style="width:300px; height:200px;"></center>
<br>
<center>
<span class="line"><a href="../controller/controller.php?action=showMovies" class="btn-lg btn-success" >See all movies</a></span><br><br><br>
<span class="line"><a href="../controller/controller.php?action=showShows" class="btn-lg btn-success" >See all TV shows</a></span><br><br><br>
<span class="line"><a href="../controller/controller.php?action=makeRequest" class="btn-lg btn-success" >Make a request</a></span><br><br><br>
</center>
<br>
<div style="text-align: center;">
<div style="display: inline-block; text-align: left;">
<form action = "../controller/controller.php?action=searchMovie" method="post"><center><strong>Search Movies</strong></center><br><input type="text" name="movieSearch"><input type="submit"></form>
<br>
<form action = "../controller/controller.php?action=searchShow" method="post"><center><strong>Search TV Shows</strong></center><br><input type="text" name="showSearch"><input type="submit"></form>
</div>
</div>
<br>
<br>
<h1><center>Recent Movie Additions</center></h1>
<center><table class="sortable">
<tr>
	<th>Name</th>
	<th>Year</th>
	<th>Genre</th>
	<th>Rating</th>
	<th>Studio</th>
	<th>Length</th>
	<th>Director</th>
	<th>Actors</th>
  <th>Date Added</th>
</tr>
<?php foreach ($results as $row){
$movieName = $row['Name'];
$movieYear = $row['Year'];
$movieGenre = $row['Genre'];
$movieRating = $row['Rating'];
$movieStudio = $row ['Studio'];
$movieLength = $row['Length'];
$movieDirector = $row['Director'];
$movieActors = $row['Actors']; 
$movieDate = $row['DateAdded'];
$movieIMDB = $row['IMDB'];?>
<?php echo '<tr><td><a target="_blank" href="'.$movieIMDB. '">'. $movieName. '</a>'. '</td>' .
'<td>' . $movieYear . '</td>' .
'<td>' . $movieGenre . '</td>' .
'<td>' . $movieRating . '</td>' .
'<td>' . $movieStudio . '</td>' .
'<td>' . $movieLength . '</td>' .
'<td>' . $movieDirector . '</td>' .
'<td>' . $movieActors . '</td>' . 
'<td>' . $movieDate . '</td> </tr>'; ?>
<?php } ?></center>
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
<h1><center>Recent TV Show Additions</center></h1>
<br>
<?php foreach ($results2 as $row){
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
'<td>' . $showAdded . '</tr>'; ?>
<?php } ?>
<br>
<br>
</body>
</html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="../js/sorttable.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Filter by Year
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="../controller/controller.php?action=show1970">1970s</a></li>
          <li><a href="../controller/controller.php?action=show1980">1980s</a></li>
          <li><a href="../controller/controller.php?action=show1990">1990s</a></li>
          <li><a href="../controller/controller.php?action=show2000">2000s</a></li>
          <li><a href="../controller/controller.php?action=show2010">2010s</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Filter by Genre
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="../controller/controller.php?action=showAction">Action</a></li>
          <li><a href="../controller/controller.php?action=showAdventure">Adventure</a></li>
          <li><a href="../controller/controller.php?action=showAnimated">Animated</a></li>
          <li><a href="../controller/controller.php?action=showAnime">Anime</a></li>
          <li><a href="../controller/controller.php?action=showComedy">Comedy</a></li>
          <li><a href="../controller/controller.php?action=showCrime">Crime</a></li>
          <li><a href="../controller/controller.php?action=showDocumentary">Documentary</a></li>
          <li><a href="../controller/controller.php?action=showDrama">Drama</a></li>
          <li><a href="../controller/controller.php?action=showFamily">Family</a></li>
          <li><a href="../controller/controller.php?action=showHorror">Horror</a></li>
          <li><a href="../controller/controller.php?action=showRomance">Romance</a></li>
          <li><a href="../controller/controller.php?action=showSciFi">Sci-Fi</a></li>
          <li><a href="../controller/controller.php?action=showSports">Sports</a></li>
        </ul>
      </li>
            <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Filter by Rating
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="../controller/controller.php?action=showG">G</a></li>
          <li><a href="../controller/controller.php?action=showPG">PG</a></li>
          <li><a href="../controller/controller.php?action=showPG13">PG-13</a></li>
          <li><a href="../controller/controller.php?action=showR">R</a></li>
          <li><a href="../controller/controller.php?action=showNR">NR</a></li>
        </ul>
      </li>
    </ul>
    </div>
  </div>
</nav>
<center><h1>Movie Listings</h1></center>
<br>
<p>Movies In Database: <?php echo $total ?></p>
<br>
<table class="sortable">
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
<?php } ?>

</body>
</html>
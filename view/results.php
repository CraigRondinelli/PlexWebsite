<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Khula" rel="stylesheet">
<script src="../js/sorttable.js"></script>
<title>Search Results</title>
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
<center><h1>Search Results</h1></center>
<br>
<br>
<a href="../controller/controller.php?action=default" class="btn-lg btn-success" >Home</a>
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
</tr>
<?php foreach ($results as $row){
$movieName = $row['Name'];
$movieYear = $row['Year'];
$movieGenre = $row['Genre'];
$movieRating = $row['Rating'];
$movieStudio = $row ['Studio'];
$movieLength = $row['Length'];
$movieDirector = $row['Director'];
$movieActors = $row['Actors']; ?>
<?php echo '<tr><td>' . $movieName . '</td>' .
'<td>' . $movieYear . '</td>' .
'<td>' . $movieGenre . '</td>' .
'<td>' . $movieRating . '</td>' .
'<td>' . $movieStudio . '</td>' .
'<td>' . $movieLength . '</td>' .
'<td>' . $movieDirector . '</td>' .
'<td>' . $movieActors . '</td></tr>'; ?>
<?php } ?>
<br>
<br>
</body>
</html>
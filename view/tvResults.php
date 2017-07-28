<html>
<head>
<script src="../js/sorttable.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Khula" rel="stylesheet">
<title>TV Show Search Results</title>
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
<center><h1>TV Show Search Results</h1></center>
<br>
<br>
<a href="../controller/controller.php?action=default" class="btn-lg btn-success" >Home</a>
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
</tr>
<?php foreach ($results as $row){
$showName = $row['Name'];
$seasonsOwned = $row['SeasonsOwned'];
$seasonsTotal = $row['SeasonsTotal'];
$showGenre = $row['Genre'];
$showChannel = $row ['Channel'];
$showActors = $row['Actors'];
$showEnded = $row['ShowEnded']; ?>
<?php echo '<tr><td>' . $showName . '</td>' .
'<td>' . $seasonsOwned . '</td>' .
'<td>' . $seasonsTotal . '</td>' .
'<td>' . $showGenre . '</td>' .
'<td>' . $showChannel . '</td>' .
'<td>' . $showActors . '</td>' .
'<td>' . $showEnded . '</td></tr>'; ?>
<?php } ?>

</body>
</html>
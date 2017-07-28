<html>
<head>
<title>Requests</title>
<script src="../js/sorttable.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>Movie Listings</title>
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
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<center><h1>Make a Request</h1></center>
<form action="../controller/controller.php?action=addRequests" method="post">
Name:<input name="requestName" type="text" required>
<br>
Type:<select name="requestType" required>
<option disabled>Movie or TV Show...</option>
<option value="Movie">Movie</option>
<option value="TV Show">TV Show</option>
</select>
<br>
Season (if applicable):<input name="requestSeason" type="text">
<br>
Email:<input name="requestEmail" type="text">
<br>
<em>Enter your email and you will be notified once it is complete.</em>
<br>
<input type="submit" class="btn btn-success">
</form>
<br>
<a href="../controller/controller.php?action=default" class="btn-lg btn-success" >Home</a>
<h1><center>Current Requests</center></h1>
<br>
<table class="sortable">
<tr>
	<th>Name</th>
	<th>Type</th>
	<th>Season</th>

</tr>
<?php foreach ($results as $row){
$requestName = $row['Name'];
$requestType = $row['Type'];
$requestSeason = $row['Season']; ?>

<?php echo '<tr><td>' . $requestName . '</td>' .
'<td>' . $requestType . '</td>' .
'<td>' . $requestSeason . '</td></tr>'; ?>
<?php } ?>
</body>
</html>

<html>
<head>
<title>Add Movie or Show</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<center><h1>Add Movie</h1></center>
<form action="../controller/controller.php?action=addMovie" method="post">
Movie Name:<input name="movieName" type="text">
<br>
Movie Year:<input name="movieYear" type="text">
<br>
Movie Genre:<input name="movieGenre" type="text">
<br>
Movie Rating:<input name="movieRating" type="text">
<br>
Movie Studio:<input name="movieStudio" type="text">
<br>
Length:<input name="movieLength" type="text">
<br>
Director:<input name="movieDirector" type="text">
<br>
Actors:<input name="movieActors" type="text">
<br>
IMDB:<input name="movieIMDB" type="text">
<br>
<input type="submit">
</form>
<hr>
<br>
<center><h1>Add Show</h1></center>
<form action="../controller/controller.php?action=addShow" method="post">
Show Name:<input name="showName" type="text">
<br>
Seasons Owned:<input name="seasonsOwned" type="text">
<br>
Total Seasons:<input name="seasonsTotal" type="text">
<br>
Genre:<input name="showGenre" type="text">
<br>
Channel:<input name="showChannel" type="text">
<br>
Actors:<input name="showActors" type="text">
<br>
Show Ended:<input name="showEnded" type="text">
<br>
IMDB:<input name="showIMDB" type="text">
<br>
<input type="submit">
</form>
<br>
<br>
<form action="../controller/controller.php?action=sendRequestEmail" method="post">
<input type="submit" value="Send Request Emails">
</form>
<br>
<form action="../controller/controller.php?action=sendUpdateEmail" method="post">
<input type="submit" value="Send Update Emails">
</form>
</body>
</html>

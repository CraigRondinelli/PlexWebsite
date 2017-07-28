 <?php
 function getDataBaseConnection(){
    $dsn = 'mysql:host=localhost;dbname=KregPlex';
    $username = 's_crondinell';
    $password = '1337Zorz';

    try{
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e){
        $errorMessage = $e->getMessage();
        include '../view/home.php';
        die;
    }
    return $db;
}

function submitMovie($movieName, $movieYear, $movieGenre, $movieRating, $movieStudio, $movieLength, $movieDirector, $movieActors, $movieIMDB){
    $db = getDataBaseConnection();
    $query = 'INSERT INTO Movies (Name, Year, Genre, Rating, Studio, Length, Director, Actors, IMDB) VALUES (:Name, :Year, :Genre, :Rating, :Studio, :Length, :Director, :Actors, :IMDB)';
    $statement = $db->prepare($query);

    $statement->bindValue(':Name', $movieName);
    $statement->bindValue(':Year', $movieYear);
    $statement->bindValue(':Genre', $movieGenre);
    $statement->bindValue(':Rating', $movieRating);
    $statement->bindValue(':Studio', $movieStudio);
    $statement->bindValue(':Length', $movieLength);
    $statement->bindValue(':Director', $movieDirector);
    $statement->bindValue(':Actors', $movieActors);
    $statement->bindValue(':IMDB', $movieIMDB);

    $success = $statement->execute();
    $statement->closeCursor();

    if($success){
        return $statement->rowCount();
    }
    else {
        logSQLError($statement->errorInfo());
        echo 'Did not work';
    }
}

function submitShow($showName, $seasonsOwned, $seasonsTotal, $showGenre, $showChannel, $showActors, $showEnded, $showIMDB)
{
   $db = getDataBaseConnection();
   $query = 'INSERT INTO TV (Name, SeasonsOwned, SeasonsTotal, Genre, Channel, Actors, ShowEnded, IMDB) VALUES (:Name, :SeasonsOwned, :SeasonsTotal, :Genre, :Channel, :Actors, :ShowEnded, :IMDB)';
   $statement = $db->prepare($query);

   $statement->bindValue(':Name', $showName);
   $statement->bindValue(':SeasonsOwned', $seasonsOwned);
   $statement->bindValue(':SeasonsTotal', $seasonsTotal);
   $statement->bindValue(':Genre', $showGenre);
   $statement->bindValue(':Channel', $showChannel);
   $statement->bindValue(':Actors', $showActors);
   $statement->bindValue(':ShowEnded', $showEnded);
   $statement->bindValue(':IMDB', $showIMDB); 
   $success = $statement->execute();
   $statement->closeCursor();

   if($success){
    return $statement->rowCount();
}
else {
    logSQLError($statement->errorInfo());
    echo 'Did not work';
}            
}

function requestSubmit($requestName, $requestType, $requestSeason, $requestEmail)
{
    $db = getDataBaseConnection();
    $query = 'INSERT INTO Requests (Name, Type, Season, Email) VALUES (:Name, :Type, :Season, :Email)';
    $statement = $db->prepare($query);

    $statement->bindValue(':Name', $requestName);
    $statement->bindValue(':Type', $requestType);
    $statement->bindValue(':Season', $requestSeason);
    $statement->bindValue(':Email', $requestEmail);
    $success = $statement->execute();
    $statement->closeCursor();

    if($success){
        return $statement->rowCount();
    }
    else {
        logSQLError($statement->errorInfo());
        echo 'Did not work';
    }   
}

function displayMovies()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM Movies';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function displayRecentMovies()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM Movies WHERE DateAdded >= DATE_ADD(NOW(), INTERVAL -7 DAY) LIMIT 10';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function displayRecentShows()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE DateAdded >= DATE_ADD(NOW(), INTERVAL -7 DAY) LIMIT 10';
        $statement = $db->prepare($query);
        $statement->execute();
        $results2 = $statement->fetchAll();
        $statement->closeCursor();
        return $results2;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function displayRequests()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM Requests';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function displayShows()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function countMovies()
{
   try{
    $db = getDataBaseConnection();
    $query = 'SELECT COUNT(*) FROM Movies';
    $statement = $db->prepare($query);
    $statement->execute();
    $total = $statement->fetchColumn(0);
    $statement->closeCursor();
        return $total;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }   
}

function countShows()
{
   try{
    $db = getDataBaseConnection();
    $query = 'SELECT COUNT(*) FROM TV';
    $statement = $db->prepare($query);
    $statement->execute();
    $total = $statement->fetchColumn(0);
    $statement->closeCursor();
        return $total;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }   
}

function searchMovie($search)
{
   try{
    $db = getDataBaseConnection();
    $query = 'SELECT DISTINCT * FROM Movies WHERE (Rating LIKE :Search) OR Name LIKE :Search OR Year LIKE :Search OR Genre LIKE :Search OR Studio LIKE :Search OR Length LIKE :Search OR Director LIKE :Search OR Actors LIKE :Search';
    $statement = $db->prepare($query);
    $statement->bindValue (':Search', "%$search%");
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }  
}

function searchShow($search)
{
   try{
    $db = getDataBaseConnection();
    $query = 'SELECT DISTINCT * FROM TV WHERE Name LIKE :Search OR Genre LIKE :Search OR Channel LIKE :Search OR Actors LIKE :Search';
    $statement = $db->prepare($query);
    $statement->bindValue (':Search', "%$search%");
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
        return $results2;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }  
}

function show1970()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM Movies WHERE Year BETWEEN 1970 AND 1979';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function show1980()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM Movies WHERE Year BETWEEN 1980 AND 1989';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function show1990()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM Movies WHERE Year BETWEEN 1990 AND 1999';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function show2000()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM Movies WHERE Year BETWEEN 2000 AND 2009';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}
function show2010()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM Movies WHERE Year BETWEEN 2010 AND 2019';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showAction()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM Movies WHERE Genre = "Action"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showAdventure()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM Movies WHERE Genre = "Adventure"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showAnimated()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM Movies WHERE Genre = "Animated"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showAnime()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM Movies WHERE Genre = "Anime"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showComedy()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM Movies WHERE Genre = "Comedy"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showCrime()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM Movies WHERE Genre = "Crime"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showDocumentary()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM Movies WHERE Genre = "Documentary"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showDrama()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM Movies WHERE Genre = "Drama"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showFamily()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM Movies WHERE Genre = "Family"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showHorror()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM Movies WHERE Genre = "Horror"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showRomance()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM Movies WHERE Genre = "Romance"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showSciFi()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM Movies WHERE Genre = "Sci-Fi"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showSports()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM Movies WHERE Genre = "Sports"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showG()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM Movies WHERE Rating = "G"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showPG()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM Movies WHERE Rating = "PG"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showPG13()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM Movies WHERE Rating = "PG-13"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showR()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM Movies WHERE Rating = "R"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showNR()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM Movies WHERE Rating = "NR"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showTVAdventure()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE Genre = "Adventure"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showTVCartoon()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE Genre = "Cartoon"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showTVComedy()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE Genre = "Comedy"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showTVCooking()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE Genre = "Cooking"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showTVCrime()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE Genre = "Crime"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showTVDrama()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE Genre = "Drama"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showTVEducational()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE Genre = "Educational"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showTVHistory()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE Genre = "History"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showTVHorror()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE Genre = "Horror"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showTVPolitical()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE Genre = "Political"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showTVReality()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE Genre = "Reality"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showTVSciFi()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE Genre = "Sci-Fi"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showABC()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE Channel = "ABC"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showAMC()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE Channel = "AMC"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showBBC()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE Channel = "BBC"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showCartoonNetwork()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE Channel = "Cartoon Network"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showComedyCentral()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE Channel = "Comedy Central"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showDiscoveryChannel()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE Channel = "Discovery Channel"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showFX()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE Channel = "FX"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showFoodNetwork()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE Channel = "Food Network"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showFox()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE Channel = "Fox"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showHBO()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE Channel = "HBO"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showIFC()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE Channel = "IFC"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showMTV()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE Channel = "MTV"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showNBC()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE Channel = "NBC"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showNickelodeon()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE Channel = "Nickelodeon"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showShowtime()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE Channel = "Showtime"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showSpikeTV()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE Channel = "Spike TV"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showUSA()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE Channel = "USA"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showEnded()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE ShowEnded = "Y"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function showNotEnded()
{
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT * FROM TV WHERE ShowEnded = "N"';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;    //Assoc array of rows
    } catch (PDOException $e) {
        include '../view/errorPage.php';
        die;
    }
}

function requestEmail(){
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT Email FROM Requests';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;
    } catch (PDOException $e){
        include '../view/errorPage.php';
        die;
    }
}

function requestInfo(){
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT Name FROM Requests WHERE Email = Email';
        $statement = $db->prepare($query);
        $statement->execute();
        $results2 = $statement->fetchAll();
        $statement->closeCursor();
        return $results2;
    } catch (PDOException $e){
        include '../view/errorPage.php';
        die;
    }
}

function deleteRequest()
{
   try{
    $db = getDataBaseConnection();
    $query = 'DELETE FROM Requests WHERE Email IS NOT NULL OR Type="TV Show"';
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
} catch (PDOException $e) {
    include '../view/errorPage.php';
    die;
}   
}
function updateEmail(){
    try{
        $db = getDataBaseConnection();
        $query = 'SELECT Email FROM Updates';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;
    } catch (PDOException $e){
        include '../view/errorPage.php';
        die;
    }
}

function addUpdateEmails($updateEmail)
{
    $db = getDataBaseConnection();
    $query = 'INSERT INTO Updates (Email) VALUES (:Email)';
    $statement = $db->prepare($query);

    $statement->bindValue(':Email', $updateEmail);


    $success = $statement->execute();
    $statement->closeCursor();

    if($success){
        return $statement->rowCount();
    }
    else {
        logSQLError($statement->errorInfo());
        echo 'Did not work';
    }
}
?>

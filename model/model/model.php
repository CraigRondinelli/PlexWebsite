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

    function submitMovie($movieName, $movieYear, $movieGenre, $movieRating, $movieStudio, $movieLength, $movieDirector, $movieActors){
        $db = getDataBaseConnection();
        $query = 'INSERT INTO Movies (Name, Year, Genre, Rating, Studio, Length, Director, Actors) VALUES (:Name, :Year, :Genre, :Rating, :Studio, :Length, :Director, :Actors)';
        $statement = $db->prepare($query);

        $statement->bindValue(':Name', $movieName);
        $statement->bindValue(':Year', $movieYear);
        $statement->bindValue(':Genre', $movieGenre);
        $statement->bindValue(':Rating', $movieRating);
        $statement->bindValue(':Studio', $movieStudio);
        $statement->bindValue(':Length', $movieLength);
        $statement->bindValue(':Director', $movieDirector);
        $statement->bindValue(':Actors', $movieActors);

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

    function submitShow($showName, $seasonsOwned, $seasonsTotal, $showGenre, $showChannel, $showActors, $showEnded)
    {
     $db = getDataBaseConnection();
     $query = 'INSERT INTO TV (Name, SeasonsOwned, SeasonsTotal, Genre, Channel, Actors, ShowEnded) VALUES (:Name, :SeasonsOwned, :SeasonsTotal, :Genre, :Channel, :Actors, :ShowEnded)';
     $statement = $db->prepare($query);

     $statement->bindValue(':Name', $showName);
     $statement->bindValue(':SeasonsOwned', $seasonsOwned);
     $statement->bindValue(':SeasonsTotal', $seasonsTotal);
     $statement->bindValue(':Genre', $showGenre);
     $statement->bindValue(':Channel', $showChannel);
     $statement->bindValue(':Actors', $showActors);
     $statement->bindValue(':ShowEnded', $showEnded); 
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

    function requestSubmit($requestName, $requestType, $requestSeason)
    {
        $db = getDataBaseConnection();
        $query = 'INSERT INTO Requests (Name, Type, Season) VALUES (:Name, :Type, :Season)';
        $statement = $db->prepare($query);

        $statement->bindValue(':Name', $requestName);
        $statement->bindValue(':Type', $requestType);
        $statement->bindValue(':Season', $requestSeason);
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

    ?>
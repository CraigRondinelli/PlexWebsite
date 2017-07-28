<?php
require_once '../model/model.php';
require_once 'Mail.php';

        if (isset($_POST['action'])) {  // check get and post
          $action = $_POST['action'];
        } else if (isset($_GET['action'])) {
          $action = $_GET['action'];
        } else {
            include('../view/home.php');  // default action
            exit();
          }
          switch ($action) {  
            case 'addMovie':
            movieSubmit();
            include '../view/add.php';
            break;
            case 'addShow':
            showSubmit();
            include '../view/add.php';
            break;
            case 'showMovies':
            allMovies();
            break;
            case 'showShows':
            allShows();
            break;
            case 'makeRequest':
            showResults();
            break;
            case 'addRequests':
            addRequests();
            break;
            case 'searchMovie':
            movieSearch();
            break;
            case 'searchShow':
            showSearch();
            break;
            case 'show1970':
            get1970();
            break;
            case 'show1980':
            get1980();
            break;
            case 'show1990':
            get1990();
            break;
            case 'show2000':
            get2000();
            break;
            case 'show2010':
            get2010();
            break;
            case 'showAction':
            getAction();
            break;
            case 'showAdventure':
            getAdventure();
            break;
            case 'showAnimated':
            getAnimated();
            break;
            case 'showAnime':
            getAnime();
            break;
            case 'showComedy':
            getComedy();
            break;
            case 'showCrime':
            getCrime();
            break;
            case 'showDocumentary':
            getDocumentary();
            break;
            case 'showDrama':
            getDrama();
            break;
            case 'showFamily':
            getFamily();
            break;
            case 'showHorror':
            getHorror();
            break;
            case 'showRomance':
            getRomance();
            break;
            case 'showSciFi':
            getSciFi();
            break;
            case 'showSports':
            getSports();
            break;
            case 'showG':
            getG();
            break;
            case 'showPG':
            getPG();
            break;
            case 'showPG13':
            getPG13();
            break;
            case 'showR':
            getR();
            break;
            case 'showNR':
            getNR();
            break;
            case 'showTVAdventure':
            getShowAdventure();
            break;
            case 'showTVCartoon':
            getShowCartoon();
            break;
            case 'showTVComedy':
            getShowComedy();
            break;
            case 'showTVCooking':
            getShowCooking();
            break;
            case 'showTVCrime':
            getShowCrime();
            break;
            case 'showTVDrama':
            getShowDrama();
            break;
            case 'showTVEducational':
            getShowEducational();
            break;
            case 'showTVHistory':
            getShowHistory();
            break;
            case 'showTVHorror':
            getShowHorror();
            break;
            case 'showTVPolitical':
            getShowPolitical();
            break;
            case 'showTVReality':
            getShowReality();
            break;
            case 'showTVSciFi':
            getShowSciFi();
            break;
            case 'showABC':
            getABC();
            break;
            case 'showAMC':
            getAMC();
            break;
            case 'showBBC':
            getBBC();
            break;
            case 'showCartoonNetwork':
            getCartoonNetwork();
            break;
            case 'showComedyCentral':
            getComedyCentral();
            break;
            case 'showDiscoveryChannel':
            getDiscoveryChannel();
            break;
            case 'showFX':
            getFX();
            break;
            case 'showFoodNetwork':
            getFoodNetwork();
            break;
            case 'showFox':
            getFox();
            break;
            case 'showHBO':
            getHBO();
            break;
            case 'showIFC':
            getIFC();
            break;
            case 'showMTV':
            getMTV();
            break;
            case 'showNBC':
            getNBC();
            break;
            case 'showNickelodeon':
            getNickelodeon();
            break;
            case 'showShowtime':
            getShowtime();
            break;
            case 'showSpikeTV':
            getSpikeTV();
            break;
            case 'showUSA':
            getUSA();
            break;
            case 'showEnded':
            getEnded();
            break;
            case 'showNotEnded':
            getNotEnded();
            break;
            case 'sendRequestEmail':
            sendRequestEmails();
            break;
            case 'updateEmail':
            addUpdateEmail();
            break;
            case 'sendUpdateEmail':
            sendUpdateEmails();
            break;
            default:
            recentMovies();   // default
          }

          function movieSubmit()
          {  
           $movieName = $_POST['movieName'];
           $movieYear = $_POST['movieYear'];
           $movieGenre = $_POST['movieGenre'];
           $movieRating = $_POST['movieRating'];
           $movieStudio = $_POST['movieStudio'];
           $movieLength = $_POST['movieLength'];
           $movieDirector = $_POST['movieDirector'];
           $movieActors = $_POST['movieActors'];
           $movieIMDB = $_POST['movieIMDB'];

           submitMovie($movieName, $movieYear, $movieGenre, $movieRating, $movieStudio, $movieLength, $movieDirector, $movieActors, $movieIMDB);

           echo 'Entry added successfully.';
         }

         function showSubmit()
         {  
          $showName = $_POST['showName'];
          $seasonsOwned = $_POST['seasonsOwned'];
          $seasonsTotal = $_POST['seasonsTotal'];
          $showGenre = $_POST['showGenre'];
          $showChannel = $_POST['showChannel'];
          $showActors = $_POST['showActors'];
          $showEnded = $_POST['showEnded'];
          $showIMDB = $_POST['showIMDB'];

          submitShow($showName, $seasonsOwned, $seasonsTotal, $showGenre, $showChannel, $showActors, $showEnded, $showIMDB);

          echo 'Entry added successfully.';
        }

        function addRequests()
        {
          $requestName = $_POST['requestName'];
          $requestType = $_POST['requestType'];
          $requestSeason = $_POST['requestSeason'];
          $requestEmail = $_POST['requestEmail'];

          requestSubmit($requestName, $requestType, $requestSeason, $requestEmail);
          $results = displayRequests();

          echo 'Request confirmed!';

          include '../view/requests.php';
        }

        function allMovies()
        {
          $results = displayMovies();
          $total = countMovies();
          include '../view/allMovies.php';
        }

        function recentMovies()
        {
          $results = displayRecentMovies();
          $results2 = displayRecentShows();
          include '../view/home.php';
        }

        function allShows()
        {
          $results = displayShows();
          $total = countShows();
          include '../view/allShows.php';
        }

        function showResults()
        {
          $results = displayRequests();

          include '../view/requests.php';
        }

        function movieSearch()
        {
          $search = $_POST['movieSearch'];
          $results = searchMovie($search);
          include '../view/movieResults.php';

        }

        function showSearch()
        {
          $search = $_POST['showSearch'];
          $results = searchShow($search);
          include '../view/tvResults.php';
        }

        function get1970()
        {
          $results = show1970();
          include '../view/allMovies.php';
        }

        function get1980()
        {
          $results = show1980();
          include '../view/allMovies.php';
        }

        function get1990()
        {
          $results = show1990();
          include '../view/allMovies.php';
        }
        function get2000()
        {
          $results = show2000();
          include '../view/allMovies.php';
        }
        function get2010()
        {
          $results = show2010();
          include '../view/allMovies.php';
        }

        function getAction()
        {
          $results = showAction();
          include '../view/allMovies.php';
        }

        function getAdventure()
        {
          $results = showAdventure();
          include '../view/allMovies.php';
        }

        function getAnimated()
        {
          $results = showAnimated();
          include '../view/allMovies.php';
        }

        function getAnime()
        {
          $results = showAnime();
          include '../view/allMovies.php';
        }

        function getComedy()
        {
          $results = showComedy();
          include '../view/allMovies.php';
        }

        function getCrime()
        {
          $results = showCrime();
          include '../view/allMovies.php';
        }

        function getDocumentary()
        {
          $results = showDocumentary();
          include '../view/allMovies.php';
        }

        function getDrama()
        {
          $results = showDrama();
          include '../view/allMovies.php';
        }

        function getFamily()
        {
          $results = showFamily();
          include '../view/allMovies.php';
        }

        function getHorror()
        {
          $results = showHorror();
          include '../view/allMovies.php';
        }

        function getRomance()
        {
          $results = showRomance();
          include '../view/allMovies.php';
        }

        function getSciFi()
        {
          $results = showSciFi();
          include '../view/allMovies.php';
        }

        function getSports()
        {
          $results = showSports();
          include '../view/allMovies.php';
        }

        function getG()
        {
          $results = showG();
          include '../view/allMovies.php';
        }

        function getPG()
        {
          $results = showPG();
          include '../view/allMovies.php';
        }

        function getPG13()
        {
          $results = showPG13();
          include '../view/allMovies.php';
        }

        function getR()
        {
          $results = showR();
          include '../view/allMovies.php';
        }

        function getNR()
        {
          $results = showNR();
          include '../view/allMovies.php';
        }

        function getShowAdventure()
        {
          $results = showTVAdventure();
          include '../view/allShows.php';
        }
        function getShowCartoon()
        {
          $results = showTVCartoon();
          include '../view/allShows.php';
        }
        function getShowComedy()       
        {
          $results = showTVComedy();
          include '../view/allShows.php';
        }
        function getShowCooking()       
        {
          $results = showTVCooking();
          include '../view/allShows.php';
        }
        function getShowCrime()     
        {
          $results = showTVCrime();
          include '../view/allShows.php';
        }
        function getShowDrama()      
        {
          $results = showTVDrama();
          include '../view/allShows.php';
        }
        function getShowEducational()      
        {
          $results = showTVEducational();
          include '../view/allShows.php';
        }
        function getShowHistory()       
        {
          $results = showTVHistory();
          include '../view/allShows.php';
        }
        function getShowHorror()     
        {
          $results = showTVHorror();
          include '../view/allShows.php';
        }
        function getShowPolitical()   
        {
          $results = showTVPolitical();
          include '../view/allShows.php';
        }
        function getShowReality()    
        {
          $results = showTVReality();
          include '../view/allShows.php';
        }
        function getShowSciFi()      
        {
          $results = showTVSciFi();
          include '../view/allShows.php';
        }

        function getABC()      
        {
          $results = showABC();
          include '../view/allShows.php';
        }
        function getAMC()       
        {
          $results = showAMC();
          include '../view/allShows.php';
        }
        function getBBC()         
        {
          $results = showBBC();
          include '../view/allShows.php';
        }
        function getCartoonNetwork()       
        {
          $results = showCartoonNetwork();
          include '../view/allShows.php';
        }
        function getComedyCentral()
        {
          $results = showComedyCentral();
          include '../view/allShows.php';
        }
        function getDiscoveryChannel()         
        {
          $results = showDiscoveryChannel();
          include '../view/allShows.php';
        }
        function getFX()      
        {
          $results = showFX();
          include '../view/allShows.php';
        }
        function getFoodNetwork()    
        {
          $results = showFoodNetwork();
          include '../view/allShows.php';
        }
        function getFox()      
        {
          $results = showFox();
          include '../view/allShows.php';
        }
        function getHBO()       
        {
          $results = showHBO();
          include '../view/allShows.php';
        }
        function getIFC()      
        {
          $results = showIFC();
          include '../view/allShows.php';
        }
        function getMTV()       
        {
          $results = showMTV();
          include '../view/allShows.php';
        }
        function getNBC()        
        {
          $results = showNBC();
          include '../view/allShows.php';
        }
        function getNickelodeon()        
        {
          $results = showNickelodeon();
          include '../view/allShows.php';
        }
        function getShowtime()
        {
          $results = showShowtime();
          include '../view/allShows.php';
        }
        function getSpikeTV()       
        {
          $results = showSpikeTV();
          include '../view/allShows.php';
        }
        function getUSA()
        {
          $results = showUSA();
          include '../view/allShows.php';
        }
        function getEnded()        
        {
          $results = showEnded();
          include '../view/allShows.php';
        }
        function getNotEnded()       
        {
          $results = showNotEnded();
          include '../view/allShows.php';
        }
        function sendRequestEmails()
        {
          $results = requestEmail();
          $results2 = requestInfo();

            for($i =0, $f=0; $i<count($results), $f<count($results2); $i++, $f++)
            {


                $options = array();
                $options['host'] = 'ssl://smtp.gmail.com';
                $options['port'] = 465;
                $options['auth'] = true;
                $options['username'] = 'cis411server@gmail.com';
                $options['password'] = 'pleasework';
                $mailer = Mail::factory('smtp', $options);

                $headers = array ();
                $headers['From'] = 'CraigFlix <CIS411Server@gmail.com>';
                $headers['Subject'] = 'Your request is now on CraigFlix!';
                $headers['Content-type'] = 'text/html';

                $message = "<html><p>Hello!<br>Your recent request of " . $results2[$f]['Name'] . " is now on CraigFlix!";
                $recipients = ($results[$i]);


                $result = $mailer->send($recipients, $headers, $message);

                deleteRequest();
              }
            }
        ?>
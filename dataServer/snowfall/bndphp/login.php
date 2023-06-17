<?php
    // Requires connector to get values from databases.
    require_once("./connector.php");

    // Get data (method POST) from form.
    $fUsername = $_POST["uname"];
    $fPassword = $_POST["passwd"];

    // Instances the class so it can use its methods.
    $dbConnection = new databaseConnection;

    // Opens connection to database.
    $dbConnection->openConnection("localhost", "admin", "1234", "snowfall");

    // Procedural query to.
    $stmt = $dbConnection->prepare("SELECT * FROM users WHERE uname='$fUsername';");
    $stmt->execute();

    // Get the data and then prints it to the screen.
    foreach($stmt as $queryData) {
        $arrIndexPointer = count($queryData) - 2;
        
        for ($i = 0; $i < $arrIndexPointer; $i++) {
            $dbUsername = $queryData[2];
            $dbPassword = $queryData[3];
        }
    }

    // If the database username is not the same as form username, deny login.
    if(isset($dbUsername)) {
        if ($dbUsername == $fUsername && password_verify($fPassword, $dbPassword) == true) {
            if(!isset($_COOKIE['logAs'])) {
                $usernameCookie = $fUsername;
                $valueCookie = "logAs";

                setcookie($valueCookie, $usernameCookie, time() + (86400 * 90), "/");
            } else {
                $usernameCookie = $fUsername;
                $valueCookie = "logAs";

                setcookie($valueCookie, $usernameCookie, time() + (86400 * 90), "/");

                unset($_COOKIE['logAs']);
            }
            
            header("Location: https://www.snowfall.net/bndphp/order.php");
            die();
        } else {
            echo "Wrong username or password";
        }
    } else {
        echo "Wrong credentials";
    }
?>

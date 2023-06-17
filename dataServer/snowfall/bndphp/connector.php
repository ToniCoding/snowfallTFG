<?php
    // This file is in charge of making a connection to the server's database.
    class databaseConnection {
        public function openConnection($serverName, $username, $password, $database) {
            try {
                global $dbConnection;
                $dbConnection = new PDO("mysql:host=$serverName;dbname=$database", $username, $password);

                $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "An error ocurred in the connection to database.<br/>Reason: " . $e;
            }
        }

        // "Returns" argument must be integer.
        public function sendQuery($query) {
            $resolvedQuery = $dbConnection->prepare($query);
            return $resolvedQuery->execute();
        }

        // Function that closes the database connection if any.
        public function closeConnection() {
            $dbConnection = null;
        }
    };
?>

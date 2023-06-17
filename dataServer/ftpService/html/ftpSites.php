<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/ftpStyles.css">
    <title>Sitios disponibles</title>
</head>
<body>
        <div class="upperWrapper">
            <div class="logo">
                <p><i><a href="../index.html">SnowFall - Site Manager</a></i></p>
            </div>
            <div class="navBar">
                <nav>
                    <ul>
                        <li><strong><a href="">Sitios</a></strong></li>
                        <li><a href="https://www.snowfall.net/html/login.html">Nuevo sitio</a></li>
                        <li><a href="https://ftp.snowfall.net/html/soporte.html">Soporte</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    <hr><h3 style="margin: 1rem 0rem 0rem 0rem; text-align: center;">- S I T I O S &nbsp; A C T I V O S -</h3><br><hr>
    <?php
        // Requires connector.
        require_once("../php/connector.php");

        // Creates a new connection instance.
        $dbConnection = new databaseConnection;
        $dbConnection->openConnection("localhost", "admin", "1234", "snowfall");

        // Gets the user that is logged in with cookies.
        $userLoggedIn = $_COOKIE['logAs'];

        // Fetch all the data from user sites.
        $query = "SELECT * FROM orders WHERE userLogged='$userLoggedIn' AND active=1;";
        $result = $dbConnection->query($query);

        while ($registry = $result->fetch(PDO::FETCH_OBJ)) {
            echo "<br/>";
            echo "<span style='color: cyan; padding-left: 15px;'>ID de la orden </span> - " . $registry->orderId . "<br/>";
            echo "<span style='color: cyan; padding-left: 15px;'>Email del responsable </span> - " . $registry->email . "<br/>";
            echo "<span style='color: cyan; padding-left: 15px;'>Nombre </span> - " . $registry->firstName . "<br/>";
            echo "<span style='color: cyan; padding-left: 15px;'>Apellido </span> - " . $registry->secondName . "<br/>";
            echo "<span style='color: cyan; padding-left: 15px;'>Plan activo </span> - " . $registry->planRequested . "<br/>";
            echo "<span style='color: cyan; padding-left: 15px;'>Nombre del sitio</span> - " . $registry->sitename . "<br/>";
	    echo "<br/>";
        }
    ?>

        <hr><h3 style="margin: 1rem 0rem 0rem 0rem; text-align: center;">- S I T I O S &nbsp; I N A C T I V O S -</h3><br><hr>
    <?php
        // Requires connector.
        require_once("../php/connector.php");

        // Creates a new connection instance.
        $dbConnection = new databaseConnection;
        $dbConnection->openConnection("localhost", "admin", "1234", "snowfall");

        // Gets the user that is logged in with cookies.
        $userLoggedIn = $_POST['logAs'];

        // Fetch all the data from user sites.
        $query = "SELECT * FROM orders WHERE userLogged='$userLoggedIn' AND active=0;";
        $result = $dbConnection->query($query);

        while ($registry = $result->fetch(PDO::FETCH_OBJ)) {
            echo "<br/>";
            echo "<span style='color: cyan; padding-left: 15px;'>ID de la orden </span> - " . $registry->orderId . "<br/>";
            echo "<span style='color: cyan; padding-left: 15px;'>Email del responsable </span> - " . $registry->email . "<br/>";
            echo "<span style='color: cyan; padding-left: 15px;'>Nombre </span> - " . $registry->firstName . "<br/>";
            echo "<span style='color: cyan; padding-left: 15px;'>Apellido </span> - " . $registry->secondName . "<br/>";
            echo "<span style='color: cyan; padding-left: 15px;'>Plan activo </span> - " . $registry->planRequested . "<br/>";
            echo "<br/>";
        }
    ?>
</body>
</html>

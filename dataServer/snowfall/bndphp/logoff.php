<?php
    // This file is used as a logoff and redirect to the login page.
    // Unset the cookie that saves user logged.
    unset($_COOKIE['logAs']);

    // Redirect the location to login form.
    header("Location: https://www.snowfall.net/html/login.html");

    // End connection.
    die();
?>

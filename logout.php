<?php
    session_start();
    unset($_SESSION["username"]);
    session_destroy();
?>

<a href="index.php">Log in again</a>
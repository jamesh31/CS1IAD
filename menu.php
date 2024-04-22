<?php
    session_start();
    if (!isset($_SESSION["username"])) {
        header("Location:index.php");
        exit();
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="AProject" content="width=device-width, initial-scale=1">
        <title>AProject - Menu</title>
        <link rel="stylesheet" type="text/css" href="AProject.css">
    </head>
    <body id="MainBody" class="Outline">
        <header>
            <h1 id="MainTitle">AProject</h1>
        </header>
        <div id="ButtonsBox" class="Outline">
            <a href="create.php"><button name="CreateProjectButton" class="MenuButtons">Create a project.</button></a>
            <a href="projectview.php"><button name="ProjectViewButton" class="MenuButtons">View and Search for projects.</button></a>
            <a href="logout.php"><button name="LogoutButton" class="MenuButtons">Logout.</button></a>
        </div>
    </body>
</html>
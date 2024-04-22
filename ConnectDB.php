<?php
    $dbHost = 'localhost';
    $dbName = 'u_230219014_aproject';
    $dbUsername = 'u-230219014';
    $dbPassword = '27h22bbOScO8rFq';

    try {
        $db = new PDO("mysql:dbname=$dbName;host=$dbHost", $dbUsername, $dbPassword);
        echo "Connected to db";
    } catch (PDOException $ex) {
        echo "Couldnt connect to db";
        echo "Error: $ex";
        exit;
    }
?>




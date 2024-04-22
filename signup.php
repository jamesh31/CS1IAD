<?php
    require_once("ConnectDB.php");

    if (isset($_POST["submitted"])) {
        if (isset($_POST["SignupUsername"])) {
            $username = $db->quote($_POST["SignupUsername"]);
        }
    
        if (!empty(($_POST["SignupPassword"]))) {
            $password = $db->quote(password_hash($_POST["SignupPassword"], PASSWORD_BCRYPT));
        }
    
        if (!empty(($_POST["SignupEmail"]))) {
            $email = $db->quote($_POST["SignupEmail"]);
        }
    
        try {
            $sql = "INSERT INTO users (username, password, email) VALUES ($username, $password, $email)";
            $db->exec($sql);
            echo "User created";
        } catch (PDOException) {
            echo "Error - user not created";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="AProject" content="width=device-width, initial-scale=1">
        <title>AProject - Signup</title>
        <link rel="stylesheet" type="text/css" href="AProject.css">
    </head>
    <body class=>
        <div id="Signup" class="Outline">
            <h2>Sign-up</h2>
            <form id="SignupForm" method="post">
                <label for="Email">Email: </label><br>
                <input type="email" id="SignupEmail" name="SignupEmail" required><br><br>
                <label for="ConfirmEmail">Confirm Email: </label><br>
                <input type="email" id="SignupEmail" name="ConfirmEmail" required><br><br>
                <label for="Username">Username: </label><br>
                <input type="text" id="SignupUsername" name="SignupUsername" required><br><br>
                <label for="Password">Password: </label><br>
                <input type="password" id="SignupPassword" name="SignupPassword" minlength="6" required><br><br>
                <input type="submit" id="SignupSubmit" name="SignupSubmitButton" value="Sign-Up"><br><br>
                <input type="hidden" name="submitted" value="true">
            </form>
            <a href="index.php">
                <button id="BackButton">Go Back</button>
            </a>
        </div>
    </body>
    <script src="SignupValidation.js"></script>
</html>


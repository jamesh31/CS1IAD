<?php
    if (isset($_POST["LoginSubmitted"])) {
        if (isset($_POST["LoginUsername"], $_POST["LoginPassword"])) {
            require_once("ConnectDB.php");
            try {
                $username = $_POST["LoginUsername"];
                $password = $_POST["LoginPassword"];
                $sql = "SELECT password, uid FROM users WHERE username = ?";
                $stat = $db->prepare($sql);
                $stat->execute(array($username));
                if ($stat->rowCount()>0) {
                    $row=$stat->fetch();
                    if (password_verify($password, $row["password"])) {
                        session_id($row["uid"]);
                        session_start();
                        $_SESSION["username"] = $username;
                        header("Location:menu.php");
                        exit();
                    } else {
                        echo "<p style='color: red;'>Incorrect Password</p>";
                    }
                }
            } catch (PDOException $ex) {
                echo "Login Failed \n $ex";
            }
        } else {
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="AProject" content="width=device-width, initial-scale=1">
        <title>AProject</title>
        <link rel="stylesheet" type="text/css" href="AProject.css">
    </head>
    <body id="MainBody" class="Outline">
        <header>
            <h1 id="MainTitle">AProject</h1>
        </header>
        <main>
            <div>
                <div id="Login" class="Outline">
                    <h2>Log-in</h2>
                    <form id="LoginForm" method="post">
                        <label for="Username">Username: </label><br>
                        <input type="text" id="LoginUsername" name="LoginUsername" required><br><br>
                        <label for="Password">Password: </label><br>
                        <input type="password" id="LoginPassword" name="LoginPassword" minlength="6" required><br><br>
                        <input type="submit" id="LoginSubmit" name="LoginSubmitButton" value="Log-In"><br><br>
                        <input type="hidden" name="LoginSubmitted" value="true">
                    </form>
                </div>
                <div id="SignupPrompt" class="Outline">
                    <a href="signup.php">
                        <button id="SignupButton">Signup Here</button>
                    </a>
                </div>
            </div>
        </main>
    </body>
</html>
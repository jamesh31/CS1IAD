<?php
    Class Project {

        private $name;
        private $startDate;
        private $endDate;
        private $phase;
        private $descr;
        private $userid;

        public function __construct($db) {
            if (isset($_POST)) {
                $this->name = $_POST["ProjectName"];
                $this->startDate = $_POST["ProjectStartDate"];
                $this->endDate = $_POST["ProjectEndDate"];
                $this->phase = $_POST["ProjectPhase"];
                $this->descr = $_POST["ProjectDescription"];
                $this->userid = session_id();
                $this->create($db);
            }
        }

        public function create($db) {
            $sql = "INSERT INTO projects (`title`, `start_date`, `end_date`, `phase`, `description`, `uid`) VALUES (?, ?, ?, ?, ?, ?)";
            try {
                if ($this->userid != "") {
                    $stat = $db->prepare($sql);
                    $stat->execute(array($this->name, $this->startDate, $this->endDate, $this->phase, $this->descr, $this->userid)); 
                    echo "Project created in database!";
                } else {
                    echo "<p style='color: red;'>Session id not set.</p>";
                }
            } catch (PDOException $ex) {
                echo "Couldnt create project in db.".$ex;
            }
        }
    }

    session_start();
    echo $_SESSION["username"];

    require_once("ConnectDB.php");

    if (isset($_POST["submitted"])) {
        $proj = new Project($db);
        unset($proj);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="AProject" content="width=device-width, initial-scale=1">
        <title>AProject - Create</title>
        <link rel="stylesheet" type="text/css" href="AProject.css">
    </head>
    <body id="MainBody" class="Outline">
        <header>
            <h1 id="MainTitle">AProject</h1>
        </header>
        <div id="CreateProjectBody" class="Outline">
            <h2>Create a project</h2>
            <form id="CreateForm" method="post">
                <label for="ProjectName">Project Name:  </label>
                <input type="text" name="ProjectName" required> <br><br>
                <label for="ProjectStartDate">Start Date:  </label>
                <input type="date" id="ProjectStartDate" name="ProjectStartDate" required> <br><br>
                <label for="ProjectEndDate">End Date:  </label>
                <input type="date" id="ProjectEndDate" name="ProjectEndDate" required> <br><br>
                <label for="ProjectPhase">Current Phase:  </label>
                <select name="ProjectPhase" id="ProjectPhase" required default="design">
                    <option value="design">Design</option>
                    <option value="development">Development</option>
                    <option value="testing">Testing</option>
                    <option value="deployment">Deployment</option>
                    <option value="complete">Complete</option>
                </select> <br><br>
                <label for="ProjectDescription">Description</label><br>
                <textarea name="ProjectDescription" cols="30" rows="10" required></textarea> <br><br>
                <input type="submit" name="ProjectSubmitButton" value="Create Project">
                <input type="hidden" name="submitted" value="true">
            </form>
            <a href="menu.php">
                <button id="BackButton">Go Back</button> <br><br>
            </a>
        </div>
    </body>
    <script href="ProjectCreateValidation.js"></script>
</html>
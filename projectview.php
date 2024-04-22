<?php
class Search {

    private $searchBy;
    private $db;
    private $search;
    private $currentRows;
    private $numRows;

    public function __construct($db) {
        if (isset($_POST)) {
            $this->db = $db;
            $this->searchBy = $_POST["SearchChoice"];
            $this->search = $_POST["SearchBar"];
            if ($this->search != "") {
            $this->searchDb();
            }
        }
    }

    public function searchDb() {
        try {
            $sql = "SELECT projects.pid, projects.title, projects.start_date, projects.end_date, projects.phase, projects.description, users.username
            FROM (projects LEFT JOIN users ON projects.uid = users.uid) WHERE ? = ?";
            $stat = $this->db->prepare($sql);
            $stat->execute(array($this->searchBy, $this->search));
            if ($stat->rowCount() > 0) {
                $this->numRows = $stat->rowCount();
            } else {
                echo "This search has no results";
            }
        } catch (PDOException) {
            echo "Please enter a search term";
        }
    }

    public function toTable() {
        // column names are hard coded.
        echo '<table class="SearchTable">
        <tr class="SearchTableHeadings">
        <th>Project ID</th>
        <th>Title</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Phase</th>
        <th>Description</th>
        <th>Username of Creator</th>
        </tr>';
        // For every row selected by the sql statement
        for ($i=0; $i<$this->numRows; $i++) {
            $row = $stat->fetch();
            echo '<tr>';
            for ($x=0; $x<7; $x++) {
                echo '<td>'.$row[$x].'</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    }
}

try {
    if (isset($_POST) && $_POST["submitted"]) {
        require_once("ConnectDB.php");
        $search = new Search($db);
    }
} catch (\Throwable $ex) {
    ;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="AProject" content="width=device-width, initial-scale=1">
        <title>AProject - View Projects</title>
        <link rel="stylesheet" type="text/css" href="AProject.css">
    </head>
    <body id="MainBody" class="Outline">
        <header>
            <h1 id="MainTitle">AProject</h1>
        </header>
        <div id="" class="Outline">
            <a href="menu.php">
                <button id="BackButton">Go Back</button> <br><br>
            </a>
            <form action="projectview.php" method="post">
                <label for="SearchChoice">Search by</label>
                <select name="SearchChoice">
                    <option value="projects.title">Project Title</option>
                    <option value="users.username">Username</option>
                </select>
                <input name="SearchBar" type="text"> <br><br>
                <input type="submit" name="SearchSubmit" value="Search">
                <input type="hidden" name="submitted" value="true">
            </form> <br><br><br><br>
            <?php $search->toTable()?>
        </div>
    </body>
</html>
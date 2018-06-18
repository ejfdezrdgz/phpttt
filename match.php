<?php
session_start();
include "sql.php";
include "sessioner.php";

if (isset($_GET["id"])) {
    $mId = $_GET["id"];
    $uid = $_SESSION["uid"];
    $turn = rand(1, 2);
    $query = "UPDATE matches SET playerB = $uid, turn = $turn WHERE id = $mId";
    $connection = $mysqli->query($query);
    if ($connection) {
        $_SESSION["matchid"] = $mId;
        header("Location: match.php");
    } else {
        header("Location: lobby.php");
    }
}

if (isset($_GET["fid"])) {
    $mId = $_GET["fid"];
    $_SESSION["matchid"] = $mId;
    header("Location: match.php");
}

if ($_SESSION["matchid"]) {
    $mId = $_SESSION["matchid"];
}

$query = "SELECT matches.id, cell0, cell1, cell2, cell3, cell4, cell5, cell6, cell7, cell8, user1.name AS playerA, user2.name AS playerB FROM matches LEFT JOIN users user1 ON playerA=user1.id LEFT JOIN users user2 ON playerB=user2.id WHERE matches.id=$mId";
$connection = $mysqli->query($query);
if ($connection->num_rows == 0) {
    header("Location: lobby.php");
} else {
    $match = $connection->fetch_assoc();
}

include "header.html";
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <script src="match.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <title>Tic Tac Toe</title>
</head>

<html>
    <body>
        <div class="bodiv">
            <header>
                <a href="/">Home page</a>
                <a href="logout.php">Logout</a>
            </header>
            <h1>Match <span id="mIdSpan"><?php echo $mId ?></span></h1>
            <div id="container">
                <div class="player playerAOff" id="playerA">
                    <span class="pbadge"><?php echo $match["playerA"] ?></span>
                    <i class="tbadge fas fa-times"></i>
                </div>
                <div id="board">
                    <div class="cell" id="cell0"></div>
                    <div class="cell" id="cell1"></div>
                    <div class="cell" id="cell2"></div>
                    <div class="cell" id="cell3"></div>
                    <div class="cell" id="cell4"></div>
                    <div class="cell" id="cell5"></div>
                    <div class="cell" id="cell6"></div>
                    <div class="cell" id="cell7"></div>
                    <div class="cell" id="cell8"></div>
                </div>
                <div class="player playerBOff" id="playerB">
                    <span class="pbadge"><?php echo $match["playerB"] ?></span>
                    <i class="tbadge far fa-circle"></i>
                </div>
            </div>
        </div>
    </body>
</html>

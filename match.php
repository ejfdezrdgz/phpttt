<?php
include "header.php";
if (!isset($_SESSION["unick"])) {
    header("Location: /tictactoe");
}

if (isset($_GET["id"])) {
    $mId = $_GET["id"];
    $uid = $_SESSION["uid"];
    $query = "UPDATE matches SET playerB = $uid WHERE id = $mId";
    $connection = $mysqli->query($query);
    if ($connection) {
        $_SESSION["matchid"] = $mId;
        header("Location: match.php");
    } else {
        // var_dump("pal lobby");
        // exit();
        header("Location: lobby.php");
    }
}

if ($_SESSION["matchid"]) {
    $mId = $_SESSION["matchid"];
}

$query = "SELECT matches.id, cellTL, cellTC, cellTR, cellML, cellMC, cellMR, cellBL, cellBC, cellBR, user1.name AS playerA, user2.name AS playerB FROM matches LEFT JOIN users user1 ON playerA=user1.id LEFT JOIN users user2 ON playerB=user2.id WHERE matches.id=$mId";
$connection = $mysqli->query($query);
if ($connection->num_rows == 0) {
    header("Location: lobby.php");
} else {
    $match = $connection->fetch_assoc();
}

?>
<html>
    <body>
        <div class="bodiv">
            <h1>Match <span id="mIdSpan"><?php echo $mId ?></span></h1>
            <div id="container">
                <div class="player" id="playerA"><?php echo $match["playerA"] ?></div>
                <div id="board">
                    <div class="cell" id="cellTL"></div>
                    <div class="cell" id="cellTC"></div>
                    <div class="cell" id="cellTR"></div>
                    <div class="cell" id="cellML"></div>
                    <div class="cell" id="cellMC"></div>
                    <div class="cell" id="cellMR"></div>
                    <div class="cell" id="cellBL"></div>
                    <div class="cell" id="cellBC"></div>
                    <div class="cell" id="cellBR"></div>
                </div>
                <div class="player" id="playerB"><?php echo $match["playerB"] ?></div>
            </div>
        </div>
    </body>
</html>

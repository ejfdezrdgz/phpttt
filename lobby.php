<?php
include "header.php";
$uid = $_SESSION["uid"];
$uname = $_SESSION["uname"];
$unick = $_SESSION["unick"];
if (!isset($unick)) {
    header("Location: /tictactoe");
}
if ($_GET) {
    if (isset($_GET["act"])) {
        $action = $_GET["act"];
        switch ($action) {
            case 'newgame':
                $query = "INSERT INTO matches (playerA) VALUE ($uid)";
                $newmatch = $mysqli->query($query);
                $thismatch = $mysqli->insert_id;
                if (!$newmatch) {
                    $error = "NEIN";
                }
                header("Location: match.php?id=$thismatch");
                break;
        }
    }
}
$query = "SELECT name,matches.id FROM users,matches WHERE status=1 AND matches.playerA=users.id";
$selmatch = $mysqli->query($query);
$table = "";
if ($selmatch->num_rows > 0) {
    while ($openmatches = $selmatch->fetch_assoc()) {
        $mId = $openmatches["id"];
        $mUser = $openmatches["name"];
        $mlink = "match.php?id=$mId&player2=$uid";
        $table = $table . "<tr><td>$mId</td><td>$mUser</td><td><a href=$mlink>X</a></td></tr>";

        // foreach ($openmatches as $key => $match) {
        //     echo "key: $key, value: $match" . " ;";
        // }
        // echo "<br>";
        // echo $table;
    }
} else {
    $error = "No matches open yet.";
}
?>
<body>
    <header>
        <p>Hi, <?php echo $uname?></p>
    </header>
    <h1>Game lobby</h1>
    <hr>
    <div>
        <table>
            <thead>
                <th>Match</th>
                <th>Player 1</th>
                <th>Play</th>
            </thead>
            <tbody>
            <?php
if (isset($table)) {
    echo $table;
} else {
    echo $error;
}
?>
            </tbody>
        </table>
    </div>
    <div>
        <?php
if (isset($error)) {
    echo $error;
}
?>
    </div>
    <a href="lobby.php?act=newgame">
        <button>New Game</button>
    </a>
</body>
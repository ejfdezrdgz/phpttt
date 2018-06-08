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
                    $error = "Failed to create new game";
                }
                $_SESSION["matchid"] = $thismatch;
                header("Location: lobby.php");
                break;
        }
    }
}
$query = "SELECT name,matches.id FROM users, matches WHERE status=1 AND playerA=users.id AND users.id!=$uid AND playerB=0";
$query2 = "SELECT matches.id, user1.name as uname1, user2.name as uname2 FROM matches LEFT JOIN users user1 ON playerA=user1.id LEFT JOIN users user2 ON playerB=user2.id WHERE status=1 AND playerA=$uid OR playerB=$uid";
$selwaitmatch = $mysqli->query($query);
$selmymatch = $mysqli->query($query2);
$mytable = "";
$waittable = "";
if ($selwaitmatch->num_rows > 0) {
    while ($openmatches = $selwaitmatch->fetch_assoc()) {
        $mId = $openmatches["id"];
        $mUser = $openmatches["name"];
        $waitmlink = "match.php?id=$mId";
        $waittable = $waittable . "<tr><td>$mId</td><td>$mUser</td><td><a href=$waitmlink>X</a></td></tr>";
    }
} else {
    $waiterror = "No matches open yet.";
}
if ($selmymatch->num_rows > 0) {
    while ($mymatches = $selmymatch->fetch_assoc()) {
        $mId = $mymatches["id"];
        $mUser = $mymatches["uname1"];
        $mUser2 = $mymatches["uname2"];
        $mymlink = "match.php?fid=$mId";
        $mytable = $mytable . "<tr><td>$mId</td><td>$mUser</td><td>$mUser2</td><td><a href=$mymlink>X</a></td></tr>";
    }
} else {
    $myerror = "You're not playing any matches right now.";
}
?>
<body>
    <div class="bodiv">
        <header>
            <p>Hi, <?php echo $uname ?></p>
            <a href="/tictactoe/logout.php">Logout</a>
        </header>
        <h1>Game lobby</h1>
        <hr>
        <a href="match.php" id="ongoingbtn">Ongoing match</a>
        <div id="tablesdiv">
            <div id="waittable" class="table">
                <div>
                    <table>
                        <thead>
                            <th>Match</th>
                            <th>Player 1</th>
                            <th>Play</th>
                        </thead>
                        <tbody>
                        <?php
                            if (isset($waittable)) {
                                echo $waittable;
                            } else {
                                echo $waiterror;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div>
                    <?php
                        if (isset($waiterror)) {
                            echo $waiterror;
                        }
                        ?>
                </div>
                <a href="lobby.php?act=newgame" id="newgame">
                    <button>New Game</button>
                </a>
            </div>
            <div id="mytable" class="table">
                <div>
                    <table>
                        <thead>
                            <th>Match</th>
                            <th>Player 1</th>
                            <th>Player 2</th>
                            <th>Options</th>
                        </thead>
                        <tbody>
                            <?php
                                if (isset($mytable)) {
                                    echo $mytable;
                                } else {
                                    echo $myerror;
                                }
                                ?>
                        </tbody>
                    </table>
                </div>
                <div>
                    <?php
                        if (isset($myerror)) {
                            echo $myerror;
                        }
                        ?>
                </div>
            </div>
        </div>
    </div>
</body>
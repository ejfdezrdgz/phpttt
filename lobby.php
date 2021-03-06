<?php
include "sql.php";
$uid = $_SESSION["uid"];
$uname = $_SESSION["uname"];
$unick = $_SESSION["unick"];

include "funcs.php";
include "sessioner.php";

$obj = lobbydata();
$gobj = mymatches();
$waittable = $obj["wtable"];
$waiterror = $obj["werror"];
$mytable = $obj["mtable"];
$myerror = $obj["merror"];

if ($_GET) {
    if (isset($_GET["act"])) {
        $action = $_GET["act"];
        switch ($action) {
            case 'newgame':
                $query = "INSERT INTO matches (playerA) VALUE (?)";
                if ($stmt = $mysqli->prepare($query)) {
                    $stmt->bind_param("s", $uid);
                    $r = $stmt->execute();
                    $thismatch = $mysqli->insert_id;
                    if (!$r) {
                        $error = "Failed to create new game";
                    } else {
                        $_SESSION["matchid"] = $thismatch;
                        header("Location: lobby.php");
                    }
                }
                break;
        }
    }
}

include "header.html";
?>

<body>
    <div class="bodiv">
        <header>
            <a><?php echo $uname ?></a>
            <a href="logout.php">Logout</a>
        </header>
        <h1>Game lobby</h1>
        <hr>
        <a href="match.php" id="latestbtn"><i class="fas fa-arrow-left"></i></a>
        <div id="tablesdiv">
            <div id="waittable" class="table">
                <p>Awaiting for opponent</p>
                <div>
                    <table border=1 frame=void rules=rows>
                        <thead>
                            <th>Match</th>
                            <th>Player 1</th>
                            <th>Play</th>
                        </thead>
                        <tbody id="wtable">
                        <?php
if (isset($waittable)) {
    echo $waittable;
}
?>
                        </tbody>
                    </table>
                </div>
                <div id="werror">
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
                <p>Your matches</p>
                <div>
                    <table border=1 frame=void rules=rows>
                        <thead>
                            <th>Match</th>
                            <th>Player 1</th>
                            <th>Player 2</th>
                            <th>Options</th>
                        </thead>
                        <tbody id="mtable">
                            <?php
if (isset($mytable)) {
    echo $mytable;
}
?>
                        </tbody>
                    </table>
                </div>
                <div id="merror">
                    <?php
if (isset($myerror)) {
    echo $myerror;
}
?>
                </div>
            </div>
        </div>
        <hr>
        <div id="stats">
            <h3>Game Stats</h3>
            <div id="statscont">
                <img src="graphstats.php" alt="">
                <div id="statscol">
                    <div class="stat" id="swon"><?php echo "Won: $gobj[nwon]" ?></div>
                    <div class="stat" id="sdraw"><?php echo "Drawn: $gobj[ndraw]" ?></div>
                    <div class="stat" id="slost"><?php echo "Lost: $gobj[nlost]" ?></div>
                    <div class="stat" id="sopen"><?php echo "Ongoing: $gobj[nopen]" ?></div>
                    <div class="stat" id="sdone"><?php echo "Total: $gobj[ndone]" ?></div>
                </div>
            </div>
        </div>
    </div>
    <script src="lobby.js"></script>
</body>
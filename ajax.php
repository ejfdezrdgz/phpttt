<?php
session_start();
$mysqli = new mysqli('localhost', 'tttadmin', '8u88bx6xtz8nZYBX', 'tictactoe');

if (isset($_GET["id"])) {
    $mId = $_GET["id"];
    $query = "SELECT name FROM matches LEFT JOIN users ON users.id=playerB WHERE matches.id=$mId";
    $connection = $mysqli->query($query);
    if ($connection->num_rows == 0) {
        echo "Waiting...";
    } else {
        $result = $connection->fetch_assoc();
        echo $result["name"];
    }
}

if (isset($_GET["cellid"])) {
    $uid = $_SESSION["uid"];
    $mId = $_GET["matchid"];
    $cellid = $_GET["cellid"];
    $turn;
    $query = "SELECT $cellid, turn FROM matches WHERE id=$mId";
    $connection = $mysqli->query($query);
    if ($connection->num_rows > 0) {
        $result = $connection->fetch_assoc();
        if ($result["turn"] == 1) {
            $turn = 2;
        } else {
            $turn = 1;
        }
    }
    echo $cellid." ";
    if ($cellid == 0) {
        $query = "UPDATE matches SET $cellid=$uid, turn=$turn WHERE matches.id=$mId";
        $connection = $mysqli->query($query);
        if ($connection) {
            echo $turn;
        } else {
            echo "Failed connection to database. Turn: $turn";
        }
    } else {
        echo "U WOT M8";
    }

}

if (isset($_GET["rid"])) {
    $mId = $_GET["rid"];
    $uid = $_SESSION["uid"];
    $query = "SELECT * FROM matches WHERE id=$mId";
    $connection = $mysqli->query($query);
    if ($connection->num_rows == 0) {
        echo "ERROR";
    } else {
        $r = $connection->fetch_assoc();
        $turn = $r["turn"];
        $pid1 = $r["playerA"];
        $pid2 = $r["playerB"];
        $resarray = [$r["cell0"], $r["cell1"], $r["cell2"], $r["cell3"], $r["cell4"], $r["cell5"], $r["cell6"], $r["cell7"], $r["cell8"]];
        $obj = [
            'user' => $uid,
            'turn' => $turn,
            'playerA' => $pid1,
            'playerB' => $pid2,
            'cells' => $resarray,
        ];
        echo json_encode($obj);
    }
}

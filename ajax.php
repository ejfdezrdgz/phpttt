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
    $query = "UPDATE matches SET $cellid=$uid WHERE matches.id=$mId";
    $connection = $mysqli->query($query);
    if ($connection) {
        echo "ok";
    } else {
        echo "nok";
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
        $resarray = "[" . $r["cell0"] . "," . $r["cell1"] . "," . $r["cell2"] . "," . $r["cell3"] . "," . $r["cell4"] . "," . $r["cell5"] . "," . $r["cell6"] . "," . $r["cell7"] . "," . $r["cell8"] . "]";
        // $obj = "{ 'playerA': '$uid', 'cells': '$resarray' }";
        // echo ($obj);
        echo "{juego:'dfka', celdas:[1,2,3,4]}";
    }
}

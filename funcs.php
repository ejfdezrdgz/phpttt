<?php

function lobbydata()
{
    $uid = $_SESSION["uid"];
    $mysqli = new mysqli('localhost', 'tttadmin', '8u88bx6xtz8nZYBX', 'tictactoe');
    $query = "SELECT name,matches.id FROM users, matches WHERE status=0 AND playerA=users.id AND users.id!=$uid AND playerB=0";
    $query2 = "SELECT matches.id, user1.name as uname1, user2.name as uname2, turn, playerA, playerB FROM matches LEFT JOIN users user1 ON playerA=user1.id LEFT JOIN users user2 ON playerB=user2.id WHERE status=0 AND (playerA=$uid OR playerB=$uid)";
    $selwaitmatch = $mysqli->query($query);
    $selmymatch = $mysqli->query($query2);
    $mytable = "";
    $waittable = "";

    if ($selwaitmatch->num_rows > 0) {
        while ($openmatches = $selwaitmatch->fetch_assoc()) {
            $mId = $openmatches["id"];
            $mUser = $openmatches["name"];
            $waitmlink = "match.php?id=$mId";
            $waittable = $waittable . "<tr><td>$mId</td><td>$mUser</td><td><a href=$waitmlink><i class='fas fa-arrow-right'></i></a></td></tr>";
        }
    } else {
        $waiterror = "No matches open yet.";
    }
    if ($selmymatch->num_rows > 0) {
        while ($mymatches = $selmymatch->fetch_assoc()) {
            $mId = $mymatches["id"];
            $turn = $mymatches["turn"];
            $mUser = $mymatches["uname1"];
            $mUser2 = $mymatches["uname2"];
            $playerA = $mymatches["playerA"];
            $playerB = $mymatches["playerB"];
            $mymlink = "match.php?fid=$mId";

            if ($turn == 1) {
                if ($uid == $playerA) {
                    $class = "gotturn";
                } else {
                    $class = "";
                }

            } else if ($turn == 2) {
                if ($uid == $playerB) {
                    $class = "gotturn";
                } else {
                    $class = "";
                }

            } else {
                $class = "";
            }

            $mytable = $mytable . "<tr class=$class><td>$mId</td><td>$mUser</td><td>$mUser2</td><td><a href=$mymlink><i class='fas fa-arrow-right'></i></a></td></tr>";
        }
    } else {
        $myerror = "You're not playing any matches right now.";
    }

    if ($waittable != null) {
        $wtable = $waittable;
        $werror = "";
    } else {
        $wtable = "";
        $werror = $waiterror;
    }
    if ($mytable != null) {
        $mtable = $mytable;
        $merror = "";
    } else {
        $mtable = "";
        $merror = $myerror;
    }

    $obj = [
        "mtable" => $mtable,
        "merror" => $merror,
        "wtable" => $wtable,
        "werror" => $werror,
    ];

    return $obj;

};

function mymatches()
{
    $uid = $_SESSION["uid"];
    $mysqli = new mysqli('localhost', 'tttadmin', '8u88bx6xtz8nZYBX', 'tictactoe');
    $query3 = "SELECT status, playerB FROM matches WHERE playerA=$uid OR playerB=$uid";
    $allmymatches = $mysqli->query($query3);
    if ($allmymatches->num_rows > 0) {
        $nwon = 0;
        $nlost = 0;
        $ndraw = 0;
        $ndone = 0;
        $nopen = 0;
        while ($matchdata = $allmymatches->fetch_assoc()) {
            switch ($matchdata["status"]) {
                case 0:
                    if ($matchdata["playerB"] != null) {
                        $nopen++;
                        $ndone++;
                    }
                    break;

                case -1:
                    $ndraw++;
                    $ndone++;
                    break;

                case $uid:
                    $nwon++;
                    $ndone++;
                    break;

                default:
                    $nlost++;
                    $ndone++;
                    break;
            }
        }

        $gobj = [
            'nwon' => $nwon,
            'ndraw' => $ndraw,
            'nlost' => $nlost,
            'nopen' => $nopen,
            'ndone' => $ndone,
        ];

        return $gobj;
    } else {
        return "No results";
    }
};

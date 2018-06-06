<?php
include "header.php";
if (isset($_GET["id"])) {
    $mId = $_GET["id"];
    $_COOKIE = $mId;
} else {

}
?>
<html>
    <body>
        <div id="bodiv">
            <h1>Match <?php echo $mId?></h1>
            <div id="container">
                <div id="playerA">Peter</div>
                <div id="board">
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                    <div class="cell"></div>
                </div>
                <div id="playerB">John</div>
            </div>
        </div>
    </body>
</html>

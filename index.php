<?php
session_start();
include "sql.php";
if (isset($_SESSION["unick"])) {
    header("Location: lobby.php");
}

if ($_POST) {
    $nick = $_POST["nick"];
    $pass = $_POST["pass"];
    $stdquery = "SELECT * FROM users WHERE nick=? AND pass=?";

    if ($stmt = $mysqli->prepare($stdquery)) {
        $stmt->bind_param("ss", $nick, $pass);
        $stmt->execute();
        $r = $stmt->get_result();
        if ($r->num_rows == 0) {
            $error = "XD LOL Get errored";
            var_dump($error);
        } else {
            $result = $r->fetch_assoc();
            $_SESSION["uid"] = $result["id"];
            $_SESSION["uname"] = $result["name"];
            $_SESSION["unick"] = $result["nick"];
            header("Location: lobby.php");
        }
    }
}

include "header.html";
?>

<body>
    <div class="bodiv">
        <h1>User login</h1>
        <form action="" method="post">
            <label for="name">Nick:</label>
            <input type="text" name="nick" id="log_nick" required>
            <label for="pass">Password:</label>
            <input type="password" name="pass" id="log_pass" required>
            <input type="submit" class="formbtn" value="Log In">
            <a href="signup.php"><i class="fas fa-user-plus"></i></a>
        </form>
    </div>
</body>

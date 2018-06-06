<?php
include "header.php";
if (isset($_SESSION["unick"])) {
    header("Location: /tictactoe/lobby.php");
}

if ($_POST) {
    $nick = $_POST["nick"];
    $pass = $_POST["pass"];
    $stdquery = "SELECT * FROM users WHERE nick='$nick' AND pass='$pass'";
    $connection = $mysqli->query($stdquery);
    if ($connection->num_rows == 0) {
        $error = "Get errored";
        var_dump($error);
    } else {
        $result = $connection->fetch_assoc();
        $_SESSION["uid"] = $result["id"];
        $_SESSION["uname"] = $result["name"];
        $_SESSION["unick"] = $result["nick"];
        header("Location: /tictactoe/lobby.php");
    }
}
?>

<body>
    <h1>User login</h1>
    <form action="" method="post">
        <label for="name">Nick:</label>
        <input type="text" name="nick" id="log_nick" required>
        <label for="pass">Password:</label>
        <input type="password" name="pass" id="log_pass" required>
        <input type="submit" value="Log In">
    </form>
    <a href="signup.php">Register</a>
</body>

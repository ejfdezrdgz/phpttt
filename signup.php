<?php
include "header.php";

if ($_POST) {
    $name = $_POST["name"];
    $nick = $_POST["nick"];
    $pass = $_POST["pass"];
    $stdquery = "INSERT INTO users (name, nick, pass) VALUES ('$name', '$nick', '$pass')";
    $connection = $mysqli->query($stdquery);
    if ($connection) {
        header('Location: /tictactoe');
    } else {
        $error = "Error creating user";
    }
    if (isset($error)) {
        echo $error;
    }
}
?>

<body>
    <h1>User signup</h1>
    <form action="" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" id="sign_name" required>
        <label for="name">Nick:</label>
        <input type="text" name="nick" id="sign_nick" required>
        <label for="pass">Password:</label>
        <input type="password" name="pass" id="sign_pass1" required>
        <label for="sign_pass2">Repeat password:</label>
        <input type="password" name="repass" id="sign_pass2" required>
        <input type="submit" value="Sign Up">
    </form>
    <a href="index.php">Login</a>
</body>

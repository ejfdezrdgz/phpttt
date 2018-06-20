<?php
include "sql.php";
include "header.html";

if ($_POST) {
    $name = $_POST["name"];
    $nick = $_POST["nick"];
    $pass = $_POST["pass"];
    $stdquery = "INSERT INTO users (name, nick, pass) VALUES ('$name', '$nick', '$pass')";
    $connection = $mysqli->query($stdquery);
    if ($connection) {
        header('Location: /');
    } else {
        $error = "Error creating user";
    }
    if (isset($error)) {
        echo $error;
    }
}
?>

<head>
    <script src="jquery.min.js"></script> <!-- ¿Mover al body? -->
</head>

<body>
    <script src="signup.js"></script>
    <div class="bodiv">
        <h1>User signup</h1>
        <form action="" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" id="sign_name" required>
            <label for="name">Nick:</label>
            <input type="text" name="nick" id="sign_nick" required>
            <label for="pass">Password:</label>
            <input type="password" name="pass" id="sign_pass1" class="signpassbox" required>
            <label for="sign_pass2">Repeat password:</label>
            <input type="password" name="repass" id="sign_pass2" class="signpassbox" required>
            <input type="submit" id="signformbtn" class="formbtn" value="Sign Up" disabled>
            <p id="passerrbox"></p>
            <a href="index.php"><i class="fas fa-sign-in-alt"></i></a>
        </form>
    </div>
</body>

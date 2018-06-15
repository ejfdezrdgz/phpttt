<?php
include "header.php";

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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
</head>

<body>
    <div class="bodiv">
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
            <input type="submit" class="formbtn" value="Sign Up">
            <a href="index.php"><i class="fas fa-sign-in-alt"></i></a>
        </form>
    </div>
</body>

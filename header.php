<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Tic Tac Toe</title>
</head>

<?php
    session_start();
    $mysqli = new mysqli('localhost', 'tttadmin', '8u88bx6xtz8nZYBX', 'tictactoe');
    // $mysqli = new mysqli('localhost', 'id5776075_tttadmin', '8u88bx6xtz8nZYBX', 'id5776075_tictactoe');
?>
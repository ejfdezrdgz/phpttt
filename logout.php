<?php
include "header.php";
session_destroy();
header("Location: /tictactoe/index.php");
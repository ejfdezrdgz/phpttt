<?php
include "header.php";
session_unset();
session_destroy();
header("Location: /tictactoe/index.php");
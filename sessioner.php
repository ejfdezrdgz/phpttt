<?php
if (!isset($_SESSION["unick"])) {
    header("Location: /");
}
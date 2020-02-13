<?php
declare(strict_types=1);

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

require "blackjack.php";
session_start();

if (isset($_SESSION["player"])) {
    $player = new Blackjack($_SESSION["player"]);
}

if (isset($_POST["hit"])) {
    $player->hit();
}
$playerScoreData = $_SESSION["playerScore"];

whatIsHappening();
function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}
?>
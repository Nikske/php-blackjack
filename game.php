<?php
declare(strict_types=1);

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

require "blackjack.php";
session_start();

$playerScore = 0;
$disable = "";
$newGame= "";

// If there already is a session, 'load' it into the array.
if (isset($_SESSION["player"])) {
    $player = new Blackjack($_SESSION["player"]);
    $playerScore = $_SESSION["player"];
    // If there isn't, clear it and start anew.
} else {
    $_SESSION["player"] = 0;
    $playerScore = 0;
    $player = new Blackjack($_SESSION["player"]);

}

if (isset($_POST["hit"])) {
    $player->hit();
    $_SESSION["player"] = $player->getScore();
    $playerScore = $_SESSION["player"];
    if ($player->getScore() > 21) {
        echo "Thou hast perished";
        $disable = "disabled";
        $newGame = "<button type='submit' class='btn btn-dark mt-3' name='new'>NEW GAME</button>";
        session_destroy();
    }
}

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
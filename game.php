<?php
declare(strict_types=1);

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

require "blackjack.php";
session_start();

// VARIABLES
$playerScore = 0;
$dealerScore = 0;
$disable = "";
$newGame= "";
$dead = "";
$redDead ="";

// SESSIONS
// Player
// If there already is a session, 'load' it into the array.
if (isset($_SESSION["player"])) {
    $player = new Blackjack($_SESSION["player"]);
    $playerScore = $_SESSION["player"];
    // If there isn't, clear it and start anew with 2 'random cards'
} else {
    $_SESSION["player"] = 0;
    $player = new Blackjack($_SESSION["player"]);
    $player->firstScore();
    $_SESSION["player"] = $player->getScore();
    $playerScore = $_SESSION["player"];

}

// Dealer
if (isset($_SESSION["dealer"])) {
    $dealer = new Blackjack($_SESSION["dealer"]);
    $dealerScore = $_SESSION["dealer"];
} else {
    $_SESSION["dealer"] = 0;
    $dealer = new Blackjack($_SESSION["dealer"]);
}

// BUTTONS
// Hit
if (isset($_POST["hit"])) {
    $player->hit();
    $_SESSION["player"] = $player->getScore();
    $playerScore = $_SESSION["player"];
    if ($player->getScore() > 21) {
        $dead = "Remind yourself that overconfidence is a slow and insidious killer.";
        $disable = "disabled";
        $redDead = "class='text-danger'";
        $newGame = "<button type='submit' class='btn btn-dark mb-3' name='new' value='new'>NEW GAME</button>";
        session_destroy();
    }
}
// Stand
if (isset($_POST["stand"])) {
    $disable= "disabled";
    $dealer->firstScore();
    do {
        $dealer->hit();
        $_SESSION["dealer"] = $dealer->getScore();
        $dealerScore = $_SESSION["dealer"];
    } while ($dealer->getScore() < 15);
    if ($dealer->getScore() > 21) {
        $dead = "The dealer lies dead in the mud.";
        $newGame = "<button type='submit' class='btn btn-success mb-3' name='new' value='new'>NEW GAME</button>";
    }
    if ($dealer->getScore() > $player->getScore()) {
        $dead = "Thou got beaten like an ordinary knave.";
        $redDead = "class='text-danger'";
        $newGame = "<button type='submit' class='btn btn-dark mb-3' name='new' value='new'>NEW GAME</button>";
        session_destroy();
    } else {
        $dead = "A glorious victory !";
        $newGame = "<button type='submit' class='btn btn-success mb-3' name='new' value='new'>NEW GAME</button>";
    }
}

/* if (isset($_POST["new"])) {
    $player->firstScore();
} */

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


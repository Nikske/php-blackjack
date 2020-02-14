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
$winOrLoss = "";
$redDead ="";
$redDeadDealer = "";

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
    $dealerScore = $_SESSION["dealer"];
}

// BUTTONS
// Hit
if (isset($_POST["hit"])) {
    $player->hit();
    $_SESSION["player"] = $player->getScore();
    $playerScore = $_SESSION["player"];
    if ($player->getScore() > 21) {
        $winOrLoss = "Remind yourself that overconfidence is a slow and insidious killer.";
        $disable = "disabled";
        $redDead = "class='text-danger'";
        $newGame = "<button type='submit' class='btn btn-danger mb-3' name='new' value='new'>NEW GAME</button>";
        session_destroy();
    }
}
// Stand
if (isset($_POST["stand"])) {
    // Disable all buttons, the player is done playing, it's the dealer's turn
    $disable= "disabled";
    // Give the dealer two values off the bat
    $dealer->firstScore();
    // While the dealer's score is below 15, he keeps hitting himself
    do {
        $dealer->hit();
        $_SESSION["dealer"] = $dealer->getScore();
        $dealerScore = $_SESSION["dealer"];
    } while ($dealer->getScore() < 15);
    // If the dealer draws over 21, he croaks
    if ($dealer->getScore() > 21) {
        $winOrLoss = "The dealer lies dead, face down in the mud.";
        $redDeadDealer = "class='text-danger'";
        $newGame = "<button type='submit' class='btn btn-success mb-3' name='new' value='new'>NEW GAME</button>";
    } // If he's not dead yet, check if the dealer's score is the same or higher as the player. Then decide whether the player got a W
    elseif ($dealer->getScore() >= $player->getScore()) {
        $winOrLoss = "Beaten like an ordinary knave.";
        $redDead = "class='text-danger'";
        $newGame = "<button type='submit' class='btn btn-danger mb-3' name='new' value='new'>NEW GAME</button>";
        session_destroy();
    } else {
        $winOrLoss = "A glorious victory !";
        $redDeadDealer = "class='text-danger'";
        $newGame = "<button type='submit' class='btn btn-success mb-3' name='new' value='new'>NEW GAME</button>";
    }
}
// Surrender
if (isset($_POST["surrender"])) {
    $disable= "disabled";
    $redDead = "class='text-danger'";
    $winOrLoss = "The coward's way out.";
    $newGame = "<button type='submit' class='btn btn-danger mb-3' name='new' value='new'>NEW GAME</button>";

    $dealer->firstScore();
    do {
        $dealer->hit();
        $_SESSION["dealer"] = $dealer->getScore();
        $dealerScore = $_SESSION["dealer"];
    } while ($dealer->getScore() < 15);
}
// New game
 if (isset($_POST["new"])) {
     session_destroy();
     header('refresh:0');

}

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


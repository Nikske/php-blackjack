<?php
declare(strict_types=1);

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

require "blackjack.php";
session_start();

// VARIABLES
$playerScore = 0; $dealerScore = 0;
$disable = ""; $newGame= ""; $winOrLoss = ""; $redDead =""; $redDeadDealer = "";
$victoryButton = "<button type='submit' class='btn btn-success mb-3' name='new' value='new'>NEW GAME</button>";
$defeatButton = "<button type='submit' class='btn btn-danger mb-3' name='new' value='new'>NEW GAME</button>";

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
        $newGame = $defeatButton;
        session_destroy();
    }
}
// Stand
if (isset($_POST["stand"])) {
    $disable= "disabled";
    $dealer->firstScore();
    $dealer->stand();
    $_SESSION["dealer"] = $dealer->getScore();
    $dealerScore = $_SESSION["dealer"];

    if ($dealer->getScore() > 21) {
        $winOrLoss = "DEALERBOT 5000's head starts spinning until it explodes.";
        $redDeadDealer = "class='text-danger'";
        $newGame = $victoryButton;
    } elseif ($dealer->getScore() >= $player->getScore()) {
        $winOrLoss = "The robotic dealer shoots a deadly laser from his ocular sockets";
        $redDead = "class='text-danger'";
        $newGame = $defeatButton;
        session_destroy();
    } else {
        $winOrLoss = "A glorious victory !";
        $redDeadDealer = "class='text-danger'";
        $newGame = $victoryButton;
    }
}
// Surrender
if (isset($_POST["surrender"])) {
    $disable= "disabled";
    $redDead = "class='text-danger'";
    $winOrLoss = "The coward's way out.";
    $newGame = $defeatButton;
    $dealer->firstScore();
    $dealer->stand();

    $_SESSION["dealer"] = $dealer->getScore();
    $dealerScore = $_SESSION["dealer"];
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


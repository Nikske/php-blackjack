<?php
declare(strict_types=1);

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

session_start();

class Blackjack {

    // Properties
    public $score;

    // Methods
    public function hit() {
        $this->score = $_SESSION["playerScore"];
        $_SESSION["playerScore"] = $this->score + rand(1,11);
        $this->score = $_SESSION["playerScore"];
        if ($_SESSION["playerScore"] > 21) {
            echo "YOU HAVE PERISHED";
            $_SESSION["playerScore"] = 0;
        }
        return $_SESSION["playerScore"];
    }
    public function stand() {

    }
    public function surrender() {

    }
}
?>
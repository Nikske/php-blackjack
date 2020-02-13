<?php
declare(strict_types=1);

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);


class Blackjack {

    // Properties
    public $score;

    // Methods
    public function __construct(int $score) {
        $this->score = $score;
    }
    public function hit() {

    }
    public function stand() {

    }
    public function surrender() {

    }
}
?>
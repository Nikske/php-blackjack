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
    public function firstScore() {
        $this->score += rand(2,21);
    }
    public function getScore(): int {
        return $this->score;
    }
    public function hit() {
        $this->score += rand(1,11);
    }
    public function stand() {
        do {
            $this->hit();
        } while ($this->getScore() < 15);
    }
}
?>
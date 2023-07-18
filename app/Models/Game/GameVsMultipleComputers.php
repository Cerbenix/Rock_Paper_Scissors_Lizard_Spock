<?php declare(strict_types=1);

namespace App\Models\Game;

use App\CLI\Cli;
use App\Models\Player\User;

class GameVsMultipleComputers extends GameModel
{
    private User $user;
    private array $computers;

    public function __construct(User $user, array $computers)
    {
        parent::__construct();
        $this->user = $user;
        $this->computers = $computers;
    }

    public function playGame(): void
    {
        $rounds = 3;

        foreach ($this->computers as $computer) {
            $this->playMatch($rounds, $this->user, $computer);
        }


        $this->setResults();
    }

    public function setResults(): void
    {
        $userScore = $this->results["{$this->user->getName()}"] = $this->user->getMatchScore();
        if ($userScore == 3) {
            $this->results["Result"] = "{$this->user->getName()} Wins";
        }

        foreach ($this->computers as $computer) {
            $this->results["{$computer->getName()}"] = $computer->getMatchScore();
        }

        if (!array_key_exists("Result", $this->results)) {
            $this->results["Result"] = "No Winner";
        }
    }
}

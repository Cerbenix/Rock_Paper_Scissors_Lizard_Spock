<?php declare(strict_types=1);

namespace App\Models\Game;

use App\Models\Player\Computer;
use App\Models\Player\User;


class GameVsComputer extends GameModel
{
    private User $user;
    private Computer $computer;

    public function __construct(User $user, Computer $computer)
    {
        parent::__construct();
        $this->user = $user;
        $this->computer = $computer;
    }

    public function playGame(): void
    {
        $rounds = 3;

        $this->playMatch($rounds, $this->user, $this->computer);

        $this->setResults();
    }

    public function setResults(): void
    {
        $userScore = $this->results["{$this->user->getName()}"] = $this->user->getRoundScore();
        $computerScore = $this->results["{$this->computer->getName()}"] = $this->computer->getRoundScore();

        if ($userScore == $computerScore) {
            $this->results["Result"] = "Draw";
        }

        if ($userScore > $computerScore) {
            $this->results["Result"] = "{$this->user->getName()} Wins";
        } else {
            $this->results["Result"] = "{$this->computer->getName()} Wins";
        }
    }
}

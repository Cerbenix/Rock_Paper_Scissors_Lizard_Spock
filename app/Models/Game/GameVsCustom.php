<?php declare(strict_types=1);

namespace App\Models\Game;

use App\CLI\Cli;
use App\Models\Player\User;

class GameVsCustom extends GameModel
{
    private User $user;
    private array $computers;
    private int $rounds;

    public function __construct(User $user, array $computers, int $rounds)
    {
        parent::__construct();
        $this->user = $user;
        $this->computers = $computers;
        $this->rounds = $rounds;
    }

    public function playGame(): void
    {
        $players = array_merge([$this->user], $this->computers);

        for ($i = 0; $i < count($players) - 1; $i++) {
            $playerOne = $players[$i];

            for ($j = $i + 1; $j < count($players); $j++) {
                $playerTwo = $players[$j];

                $this->playMatch($this->rounds, $playerOne, $playerTwo);
            }
        }

        $this->setResults();
    }

    public function setResults(): void
    {
        $playerScores = [];
        $playerScores[$this->user->getName()] = $this->user->getMatchScore();

        foreach ($this->computers as $computer) {
            $playerScores[$computer->getName()] = $computer->getMatchScore();
        }

        $topScore = max($playerScores);

        $winners = [];
        foreach ($playerScores as $playerName => $score) {
            $this->results[$playerName] = $score;
            if ($score === $topScore) {
                $winners[] = $playerName;
            }
        }

        if (count($winners) === 1) {
            $result = $winners[0] . " Wins";
        } else {
            $result = "Draw";
        }

        $this->results["Result"] = $result;
    }

}

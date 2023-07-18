<?php

namespace App\Models\Game;

use App\CLI\Cli;
use App\Models\Player\Player;
use App\Models\Player\User;

abstract class GameModel
{
    protected array $rules;
    protected array $results;

    public function __construct()
    {
        $this->rules = [
            'Rock' => ['Scissors', 'Lizard'],
            'Paper' => ['Rock', 'Spock'],
            'Scissors' => ['Paper', 'Lizard'],
            'Lizard' => ['Paper', 'Spock'],
            'Spock' => ['Rock', 'Scissors']
        ];
        $this->results = [];
    }

    public function playUserRound(User $user, Player $computer): void
    {
        $user->makeChoice();
        $computer->makeChoice();

        Cli::printChoices($user, $computer);

        $playerChoice = $user->getChoice();
        $computerChoice = $computer->getChoice();

        if ($playerChoice === $computerChoice) {
            Cli::printDraw();
        } elseif (in_array($computerChoice, $this->rules[$playerChoice])) {
            Cli::printWin($user);
            $user->addRoundScore();
        } else {
            Cli::printWin($computer);
            $computer->addRoundScore();
        }
    }

    public function playComputerRound(Player $computerOne, Player $computerTwo): void
    {
        $computerOne->makeChoice();
        $computerTwo->makeChoice();

        $computerOneChoice = $computerOne->getChoice();
        $computerTwoChoice = $computerTwo->getChoice();

        if (in_array($computerOneChoice, $this->rules[$computerTwoChoice])) {
            $computerOne->addRoundScore();
        } elseif (in_array($computerTwoChoice, $this->rules[$computerOneChoice])) {
            $computerTwo->addRoundScore();
        }
    }

    public function playMatch(int $rounds, Player $playerOne, Player $playerTwo): void
    {
        $playerOne->resetRoundScore();
        $playerTwo->resetRoundScore();
        for ($roundCount = 1; $roundCount <= $rounds; $roundCount++) {
            if ($playerOne instanceof User) {
                Cli::printRoundInfo($playerTwo, $roundCount, $rounds);
                $this->playUserRound($playerOne, $playerTwo);
            } else {
                $this->playComputerRound($playerOne, $playerTwo);
            }

            if ($playerOne->getRoundScore() > $rounds / 2 || $playerTwo->getRoundScore() > $rounds / 2) {
                break;
            }
        }

        if ($playerOne->getRoundScore() > $playerTwo->getRoundScore()) {
            $playerOne->addMatchScore();
        } elseif ($playerTwo->getRoundScore() > $playerOne->getRoundScore()) {
            $playerTwo->addMatchScore();
        }
    }

    public function getResults(): array
    {
        return $this->results;
    }

    public abstract function playGame(): void;

    public abstract function setResults(): void;
}
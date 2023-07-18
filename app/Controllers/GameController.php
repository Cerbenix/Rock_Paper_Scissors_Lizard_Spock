<?php declare(strict_types=1);

namespace App\Controllers;

use App\CLI\Cli;
use App\Models\Game\GameVsComputer;
use App\Models\Game\GameVsCustom;
use App\Models\Game\GameVsMultipleComputers;
use App\Models\Player\Computer;
use App\Models\Player\User;

class GameController
{

    public function playVsComputer(): void
    {
        $user = new User(Cli::getPlayerName());
        $computer = new Computer();
        $game = new GameVsComputer($user, $computer);
        $game->playGame();
        Cli::printResult($game);
    }

    public function playVsMultipleComputers(): void
    {
        $user = new User(Cli::getPlayerName());
        $computers = [];

        for ($i = 0; $i < 3; $i++) {
            $computers[] = new Computer();
        }

        $game = new GameVsMultipleComputers($user, $computers);
        $game->playGame();
        Cli::printResult($game);
    }

    public function playCustomGame(): void
    {
        $user = new User(Cli::getPlayerName());
        $rounds = Cli::getRoundCount();
        $computerCount = Cli::getComputerCount();
        $computers = [];

        for ($i = 0; $i < $computerCount; $i++) {
            $computers[] = new Computer();
        }

        $game = new GameVsCustom($user, $computers, $rounds);
        $game->playGame();
        Cli::printResult($game);
    }
}
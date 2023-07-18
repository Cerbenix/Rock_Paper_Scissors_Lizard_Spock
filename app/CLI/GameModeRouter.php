<?php declare(strict_types=1);

namespace App\CLI;

use App\Controllers\GameController;

class GameModeRouter
{
    private GameController $controller;

    public function __construct(GameController $controller)
    {
        $this->controller = $controller;
    }

    public function run(): void
    {
        Cli::printWelcome();
        $gameMode = Cli::getGameMode();
        switch ($gameMode) {
            case '1':
                $this->controller->playVsComputer();
                break;
            case '2':
                $this->controller->playVsMultipleComputers();
                break;
            case '3':
                $this->controller->playCustomGame();
                break;
        }
    }
}

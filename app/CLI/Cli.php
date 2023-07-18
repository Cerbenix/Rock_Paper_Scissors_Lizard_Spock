<?php declare(strict_types=1);

namespace App\CLI;

use App\Models\Game\GameModel;
use App\Models\Player\Player;

class Cli
{
    public static function getGameMode(): string
    {
        $validModes = ['1', '2', '3'];

        echo "[1] Human vs Computer, 3 rounds" . PHP_EOL;
        echo "  (Win more rounds against the Computer to win the game)" . PHP_EOL;
        echo "[2] Human vs Three Computers, 3 rounds each" . PHP_EOL;
        echo "  (Win against all Computers to win the game)" . PHP_EOL;
        echo "[3] Custom Game" . PHP_EOL;
        echo "  (Enter the number of rounds and number of players and have the highest score to win)" . PHP_EOL;
        echo "Choose game mode: ";

        $input = readline();

        while (!in_array($input, $validModes)) {
            echo "Invalid input. Please choose a valid game mode: ";
            $input = readline();
        }

        return $input;
    }

    public static function getPlayerName(): string
    {
        echo "Enter your name: ";
        $name = readline();

        if (empty($name)) {
            $name = "Coder";
        }

        return $name;
    }

    public static function getPlayerChoice(): string
    {
        $validChoices = ['1', '2', '3', '4', '5'];

        while (true) {
            echo "Enter your choice: " . PHP_EOL;
            echo "[1] Rock" . PHP_EOL;
            echo "[2] Paper" . PHP_EOL;
            echo "[3] Scissors" . PHP_EOL;
            echo "[4] Lizard" . PHP_EOL;
            echo "[5] Spock" . PHP_EOL;

            $choice = readline();

            if (in_array($choice, $validChoices)) {
                return $choice;
            }

            echo "Invalid input! Please enter a valid choice." . PHP_EOL;
        }
    }

    public static function getRoundCount(): int
    {
        while (true) {
            echo "Enter number of rounds (1-5): " . PHP_EOL;
            $roundCount = (int)readline();

            if ($roundCount >= 1 && $roundCount <= 5) {
                return $roundCount;
            }

            echo "Invalid input! Please enter a number between 1 and 5." . PHP_EOL;
        }
    }

    public static function getComputerCount(): int
    {
        while (true) {
            echo "Enter number of computers (1-9): " . PHP_EOL;
            $playerCount = (int)readline();

            if ($playerCount >= 1 && $playerCount <= 9) {
                return $playerCount;
            }

            echo "Invalid input! Please enter a number between 1 and 9." . PHP_EOL;
        }
    }

    public static function printWelcome(): void
    {
        echo "Greetings player! Lets play Rock, Paper, Scissors, Lizard, Spock" . PHP_EOL;
    }

    public static function printDraw(): void
    {
        echo "Draw!" . PHP_EOL;
    }

    public static function printWin(Player $player): void
    {
        echo "{$player->getName()} wins!" . PHP_EOL;
    }

    public static function printResult(GameModel $gameModel): void
    {
        echo '============================' . PHP_EOL;
        foreach ($gameModel->getResults() as $key => $value)
            echo "$key: $value" . PHP_EOL;
    }

    public static function printRoundInfo(Player $player, int $round, int $roundCount): void
    {
        echo '++++++++++++++++++++++++++++' . PHP_EOL;
        echo "Now playing against {$player->getName()}. Round $round of $roundCount" . PHP_EOL;
    }

    public static function printChoices(Player $playerOne, Player $playerTwo): void
    {
        echo "{$playerOne->getName()} chose {$playerOne->getChoice()}" . PHP_EOL;
        echo "{$playerTwo->getName()} chose {$playerTwo->getChoice()}" . PHP_EOL;
    }
}

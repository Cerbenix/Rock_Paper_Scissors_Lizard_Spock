<?php declare(strict_types=1);

namespace App\Models\Player;

use App\CLI\Cli;

class User extends Player
{
    public function makeChoice(): void
    {
       $choices = ['Rock', 'Paper', 'Scissors', 'Lizard', 'Spock'];
       $choice = Cli::getPlayerChoice();
       $this->choice = $choices[$choice - 1];
    }
}

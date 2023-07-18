<?php declare(strict_types=1);

namespace App\Models\Player;

class Computer extends Player
{
    public function __construct()
    {
        parent::__construct($this->generateName());
    }

    private function generateName(): string
    {
        $prefixes = ['Red', 'Blue', 'Green', 'Yellow', 'Purple', 'Orange'];
        $bases = ['Fox', 'Rabbit', 'Dog', 'Cat', 'Horse', 'Sheep'];
        $suffixes = ['Witch', 'Wizard', 'Warrior', 'Knight', 'Squire', 'Archer'];

        $prefix = $prefixes[array_rand($prefixes)];
        $base = $bases[array_rand($bases)];
        $suffix = $suffixes[array_rand($suffixes)];

        return $prefix . ' ' . $base . ' ' . $suffix;
    }

    public function makeChoice(): void
    {
        $choices = ['Rock', 'Paper', 'Scissors', 'Lizard', 'Spock'];
        $this->choice = $choices[array_rand($choices)];
    }
}

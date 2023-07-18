<?php declare(strict_types=1);

namespace App\Models\Player;

abstract class Player
{
    protected string $name;
    protected int $roundScore;
    protected int $matchScore;
    protected string $choice;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->roundScore = 0;
        $this->matchScore = 0;
        $this->choice = "";
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRoundScore(): int
    {
        return $this->roundScore;
    }

    public function getMatchScore(): int
    {
        return $this->matchScore;
    }

    public function getChoice(): string
    {
        return $this->choice;
    }

    public function resetRoundScore(): void
    {
        $this->roundScore = 0;
    }

    public function addRoundScore(): void
    {
        $this->roundScore++;
    }

    public function addMatchScore(): void
    {
        $this->matchScore++;
    }

    public abstract function makeChoice(): void;
}

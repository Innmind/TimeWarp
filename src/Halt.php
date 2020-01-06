<?php
declare(strict_types = 1);

namespace Innmind\TimeWarp;

use Innmind\TimeContinuum\{
    Clock,
    Period,
};

interface Halt
{
    /**
     * Halt the program for the given period
     */
    public function __invoke(Clock $clock, Period $period): void;
}

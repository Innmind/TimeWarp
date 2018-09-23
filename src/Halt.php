<?php
declare(strict_types = 1);

namespace Innmind\TimeWarp;

use Innmind\TimeContinuum\{
    TimeContinuumInterface,
    PeriodInterface,
};

interface Halt
{
    /**
     * Halt the program for the given period
     */
    public function __invoke(TimeContinuumInterface $clock, PeriodInterface $period): void;
}

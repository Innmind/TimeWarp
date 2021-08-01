<?php
declare(strict_types = 1);

namespace Innmind\TimeWarp;

use Innmind\TimeContinuum\Period;

interface Halt
{
    /**
     * Halt the program for the given period
     */
    public function __invoke(Period $period): void;
}

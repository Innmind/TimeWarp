<?php
declare(strict_types = 1);

namespace Innmind\TimeWarp;

use Innmind\TimeContinuum\Period;
use Innmind\Immutable\{
    Attempt,
    SideEffect,
};

interface Halt
{
    /**
     * Halt the program for the given period
     *
     * @return Attempt<SideEffect>
     */
    public function __invoke(Period $period): Attempt;
}

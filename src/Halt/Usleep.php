<?php
declare(strict_types = 1);

namespace Innmind\TimeWarp\Halt;

use Innmind\TimeWarp\PeriodToMilliseconds;
use Innmind\TimeContinuum\Period;
use Innmind\Immutable\{
    Attempt,
    SideEffect,
};

/**
 * @internal
 */
final class Usleep implements Implementation
{
    private PeriodToMilliseconds $periodToMilliseconds;

    private function __construct()
    {
        $this->periodToMilliseconds = new PeriodToMilliseconds;
    }

    #[\Override]
    public function __invoke(Period $period): Attempt
    {
        /** @psalm-suppress ArgumentTypeCoercion todo update types to fix this error */
        \usleep(($this->periodToMilliseconds)($period) * 1000);

        return Attempt::result(SideEffect::identity());
    }

    public static function new(): self
    {
        return new self;
    }
}

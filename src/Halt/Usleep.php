<?php
declare(strict_types = 1);

namespace Innmind\TimeWarp\Halt;

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
    #[\Override]
    public function __invoke(Period $period): Attempt
    {
        if ($period->months() !== 0) {
            // a month is not constant
            return Attempt::error(new \LogicException('Months can not be converted to milliseconds'));
        }

        /** @psalm-suppress ArgumentTypeCoercion todo update types to fix this error */
        \usleep($this->convert($period) * 1000);

        return Attempt::result(SideEffect::identity());
    }

    #[\NoDiscard]
    public static function new(): self
    {
        return new self;
    }

    private function convert(Period $period): int
    {
        $second = 1000;
        $minute = 60 * $second;
        $hour = 60 * $minute;
        $day = 24 * $hour;
        $year = 365 * $day;

        return $period->years() * $year +
            $period->days() * $day +
            $period->hours() * $hour +
            $period->minutes() * $minute +
            $period->seconds() * $second +
            $period->milliseconds();
    }
}

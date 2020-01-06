<?php
declare(strict_types = 1);

namespace Innmind\TimeWarp;

use Innmind\TimeWarp\Exception\LogicException;
use Innmind\TimeContinuum\Period;

final class PeriodToMilliseconds
{
    public function __invoke(Period $period): int
    {
        if ($period->months() !== 0) {
            // a month is not constant
            throw new LogicException('Months can not be converted to milliseconds');
        }

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

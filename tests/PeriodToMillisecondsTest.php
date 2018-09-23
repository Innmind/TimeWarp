<?php
declare(strict_types = 1);

namespace Tests\Innmind\TimeWarp;

use Innmind\TimeWarp\{
    PeriodToMilliseconds,
    Exception\LogicException,
};
use Innmind\TimeContinuum\{
    Period\Earth\Composite,
    Period\Earth\Month,
};
use PHPUnit\Framework\TestCase;

class PeriodToMillisecondsTest extends TestCase
{
    public function testInvokation()
    {
        $convert = new PeriodToMilliseconds;

        $milliseconds = $convert(new Composite(
            1,
            0,
            1,
            1,
            1,
            1,
            1
        ));

        $this->assertSame(31626061001, $milliseconds);
    }

    public function testThrowWhenMonthsSpecified()
    {
        $convert = new PeriodToMilliseconds;

        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('Months can not be converted to milliseconds');

        $convert(new Month(1));
    }
}

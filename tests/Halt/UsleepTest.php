<?php
declare(strict_types = 1);

namespace Tests\Innmind\TimeWarp\Halt;

use Innmind\TimeWarp\{
    Halt\Usleep,
    Halt,
};
use Innmind\TimeContinuum\Earth\Period\Millisecond;
use PHPUnit\Framework\TestCase;

class UsleepTest extends TestCase
{
    public function testInterface()
    {
        $this->assertInstanceOf(Halt::class, new Usleep);
    }

    public function testHalt()
    {
        $sleep = new Usleep;

        $start = \microtime(true);
        $this->assertNull($sleep(new Millisecond(500)));
        $end = \microtime(true);
        $this->assertEqualsWithDelta(0.5, $end - $start, 0.09); // 90 milliseconds delta allowed
    }
}

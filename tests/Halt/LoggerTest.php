<?php
declare(strict_types = 1);

namespace Tests\Innmind\TimeWarp\Halt;

use Innmind\TimeWarp\{
    Halt\Logger,
    Halt,
};
use Innmind\TimeContinuum\Period;
use Psr\Log\LoggerInterface;
use PHPUnit\Framework\TestCase;

class LoggerTest extends TestCase
{
    public function testInterface()
    {
        $this->assertInstanceOf(
            Halt::class,
            new Logger(
                $this->createMock(Halt::class),
                $this->createMock(LoggerInterface::class),
            ),
        );
    }

    public function testHalt()
    {
        $period = $this->createMock(Period::class);
        $halt = new Logger(
            $inner = $this->createMock(Halt::class),
            $logger = $this->createMock(LoggerInterface::class),
        );
        $inner
            ->expects($this->once())
            ->method('__invoke')
            ->with($period);
        $logger
            ->expects($this->once())
            ->method('debug');

        $this->assertNull($halt($period));
    }
}

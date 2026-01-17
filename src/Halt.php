<?php
declare(strict_types = 1);

namespace Innmind\TimeWarp;

use Innmind\TimeWarp\Halt\{
    Implementation,
    Usleep,
    Logger,
    Async,
    Via,
};
use Innmind\TimeContinuum\{
    Clock,
    Period,
};
use Innmind\Immutable\{
    Attempt,
    SideEffect,
};
use Psr\Log\LoggerInterface;

final class Halt
{
    private function __construct(
        private Implementation $implementation,
    ) {
    }

    /**
     * Halt the program for the given period
     *
     * @return Attempt<SideEffect>
     */
    #[\NoDiscard]
    public function __invoke(Period $period): Attempt
    {
        return ($this->implementation)($period);
    }

    #[\NoDiscard]
    public static function new(): self
    {
        return new self(Usleep::new());
    }

    #[\NoDiscard]
    public static function logger(self $self, LoggerInterface $logger): self
    {
        return new self(Logger::psr($self->implementation, $logger));
    }

    /**
     * @internal
     */
    #[\NoDiscard]
    public static function async(Clock $clock): self
    {
        return new self(Async::of($clock));
    }

    /**
     * @internal
     *
     * @param callable(Period): Attempt<SideEffect> $via
     */
    #[\NoDiscard]
    public static function via(callable $via): self
    {
        return new self(Via::of($via));
    }
}

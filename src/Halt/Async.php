<?php
declare(strict_types = 1);

namespace Innmind\TimeWarp\Halt;

use Innmind\TimeWarp\{
    Async\Suspended,
    Async\Resumable,
};
use Innmind\TimeContinuum\{
    Clock,
    Period,
};
use Innmind\Immutable\Attempt;

/**
 * @internal
 */
final class Async implements Implementation
{
    private function __construct(
        private Clock $clock,
    ) {
    }

    #[\Override]
    public function __invoke(Period $period): Attempt
    {
        /** @var Resumable */
        $return = \Fiber::suspend(Suspended::of(
            $this->clock->now(),
            $period,
        ));

        return $return->unwrap();
    }

    public static function of(Clock $clock): self
    {
        return new self($clock);
    }
}

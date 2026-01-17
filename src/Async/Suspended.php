<?php
declare(strict_types = 1);

namespace Innmind\TimeWarp\Async;

use Innmind\TimeContinuum\{
    Clock,
    PointInTime,
    Period,
};
use Innmind\Immutable\{
    Attempt,
    SideEffect,
};

/**
 * @internal
 */
final class Suspended
{
    /**
     * @psalm-mutation-free
     */
    private function __construct(
        private PointInTime $at,
        private Period $period,
        private Period $remaining,
    ) {
    }

    /**
     * @psalm-pure
     */
    #[\NoDiscard]
    public static function of(
        PointInTime $at,
        Period $period,
    ): self {
        return new self($at, $period, $period);
    }

    /**
     * @param Attempt<SideEffect> $result
     */
    #[\NoDiscard]
    public function next(
        Clock $clock,
        Attempt $result,
    ): self|Resumable {
        $error = $result->match(
            static fn() => false,
            static fn() => true,
        );

        if ($error) {
            // The drawback of resuming with the error is that an error occuring
            // due to another Fiber will affect all of them as for now there is
            // no way to distinguish due to which Fiber the halt failed.
            // This will need real world experience to know if this approach is
            // ok or not.
            return Resumable::of($result);
        }

        $now = $clock->now();
        $expectedEnd = $this->at->goForward($this->period);

        if ($now->aheadOf($expectedEnd)) {
            return Resumable::of($result);
        }

        return new self(
            $this->at,
            $this->period,
            $expectedEnd
                ->elapsedSince($now)
                ->asPeriod(),
        );
    }

    /**
     * @psalm-mutation-free
     */
    #[\NoDiscard]
    public function period(): Period
    {
        return $this->remaining;
    }
}

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
        private PointInTime $lastChecked,
        private Period $remaining,
    ) {
    }

    /**
     * @psalm-pure
     */
    public static function of(
        PointInTime $at,
        Period $period,
    ): self {
        return new self($at, $period, $at, $period);
    }

    /**
     * @param Attempt<SideEffect> $result
     */
    public function next(
        Clock $clock,
        Attempt $result,
    ): self|Resumable {
        $error = $result->match(
            static fn() => true,
            static fn() => false,
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
        $elapsed = $now->elapsedSince($this->at);
        $resumable = $elapsed->longerThan(
            $this->period->asElapsedPeriod(),
        );

        if ($resumable) {
            return Resumable::of($result);
        }

        $expectedEnd = $this->at->goForward($this->period);

        if ($this->lastChecked->aheadOf($expectedEnd)) {
            return Resumable::of($result);
        }

        return new self(
            $this->at,
            $this->period,
            $now,
            $expectedEnd
                ->elapsedSince($this->lastChecked)
                ->asPeriod(),
        );
    }

    /**
     * @psalm-mutation-free
     */
    public function period(): Period
    {
        return $this->remaining;
    }
}

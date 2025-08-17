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
    ) {
    }

    /**
     * @psalm-pure
     */
    public static function of(
        PointInTime $at,
        Period $period,
    ): self {
        return new self($at, $period);
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

        $resumable = $clock
            ->now()
            ->elapsedSince($this->at)
            ->longerThan($this->period->asElapsedPeriod());

        if ($resumable) {
            return Resumable::of($result);
        }

        return $this;
    }
}

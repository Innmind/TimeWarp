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
final class Via implements Implementation
{
    /**
     * @param \Closure(Period): Attempt<SideEffect> $via
     */
    private function __construct(
        private \Closure $via,
    ) {
    }

    #[\Override]
    public function __invoke(Period $period): Attempt
    {
        return ($this->via)($period);
    }

    /**
     * @param callable(Period): Attempt<SideEffect> $via
     */
    public static function of(callable $via): self
    {
        return new self(\Closure::fromCallable($via));
    }
}

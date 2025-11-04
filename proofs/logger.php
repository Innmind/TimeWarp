<?php
declare(strict_types = 1);

use Innmind\TimeWarp\Halt;
use Innmind\TimeContinuum\Period;
use Innmind\Immutable\SideEffect;
use Psr\Log\NullLogger;

return static function() {
    yield test(
        'Halt::logger()',
        static fn($assert) => $assert
            ->object(
                Halt::logger(Halt::new(), new NullLogger)(
                    Period::millisecond(100),
                )->unwrap(),
            )
            ->instance(SideEffect::class),
    );
};

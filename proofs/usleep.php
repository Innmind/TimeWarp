<?php
declare(strict_types = 1);

use Innmind\TimeWarp\Halt;
use Innmind\TimeContinuum\Period;
use Innmind\Immutable\SideEffect;

return static function() {
    yield test(
        'Halt::new()',
        static fn($assert) => $assert
            ->time(static function() use ($assert) {
                $assert
                    ->object(
                        Halt::new()(Period::millisecond(500))->unwrap(),
                    )
                    ->instance(SideEffect::class);
            })
            ->inMoreThan()
            ->milliseconds(500),
    );

    yield test(
        'Prevent converting months',
        static fn($assert) => $assert->throws(
            static fn() => Halt::new()(Period::month(1)),
            LogicException::class,
        ),
    );
};

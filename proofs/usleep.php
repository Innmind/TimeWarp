<?php
declare(strict_types = 1);

use Innmind\TimeWarp\{
    Halt,
    Halt\Usleep,
};
use Innmind\TimeContinuum\Period;
use Innmind\Immutable\SideEffect;

return static function() {
    yield test(
        'Usleep interface',
        static fn($assert) => $assert
            ->object(Usleep::new())
            ->instance(Halt::class),
    );

    yield test(
        'Usleep',
        static fn($assert) => $assert
            ->time(static function() use ($assert) {
                $assert
                    ->object(
                        Usleep::new()(Period::millisecond(500))->unwrap(),
                    )
                    ->instance(SideEffect::class);
            })
            ->inMoreThan()
            ->milliseconds(500),
    );
};

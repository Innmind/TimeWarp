<?php
declare(strict_types = 1);

use Innmind\TimeWarp\{
    Halt,
    Halt\Usleep,
};
use Innmind\TimeContinuum\Earth\Period\Millisecond;
use Psr\Log\NullLogger;

return static function() {
    yield test(
        'Usleep interface',
        static fn($assert) => $assert
            ->object(new Usleep)
            ->instance(Halt::class),
    );

    yield test(
        'Usleep',
        static fn($assert) => $assert
            ->time(static function() use ($assert) {
                $assert->null(
                    (new Usleep)(new Millisecond(500)),
                );
            })
            ->inMoreThan()
            ->milliseconds(500),
    );
};

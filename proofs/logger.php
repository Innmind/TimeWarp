<?php
declare(strict_types = 1);

use Innmind\TimeWarp\{
    Halt,
    Halt\Logger,
    Halt\Usleep,
};
use Innmind\TimeContinuum\Period;
use Psr\Log\NullLogger;

return static function() {
    yield test(
        'Logger interface',
        static fn($assert) => $assert
            ->object(Logger::psr(
                new Usleep,
                new NullLogger,
            ))
            ->instance(Halt::class),
    );

    yield test(
        'Logger',
        static fn($assert) => $assert->null(
            Logger::psr(new Usleep, new NullLogger)(
                Period::millisecond(100),
            ),
        ),
    );
};

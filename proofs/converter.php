<?php
declare(strict_types = 1);

use Innmind\TimeWarp\PeriodToMilliseconds;
use Innmind\TimeContinuum\Period;

return static function() {
    yield test(
        'Convert period',
        static fn($assert) => $assert->same(
            31_626_061_001,
            (new PeriodToMilliseconds)(Period::of(
                1,
                0,
                1,
                1,
                1,
                1,
                1,
                0,
            )),
        ),
    );

    yield test(
        'Prevent converting months',
        static fn($assert) => $assert->throws(
            static fn() => (new PeriodToMilliseconds)(Period::month(1)),
            LogicException::class,
        ),
    );
};

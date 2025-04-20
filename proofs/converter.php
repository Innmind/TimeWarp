<?php
declare(strict_types = 1);

use Innmind\TimeWarp\{
    PeriodToMilliseconds,
    Exception\LogicException,
};
use Innmind\TimeContinuum\Earth\Period\{
    Composite,
    Month,
};

return static function() {
    yield test(
        'Convert period',
        static fn($assert) => $assert->same(
            31_626_061_001,
            (new PeriodToMilliseconds)(new Composite(
                1,
                0,
                1,
                1,
                1,
                1,
                1,
            )),
        ),
    );

    yield test(
        'Prevent converting months',
        static fn($assert) => $assert->throws(
            static fn() => (new PeriodToMilliseconds)(new Month(1)),
            LogicException::class,
        ),
    );
};

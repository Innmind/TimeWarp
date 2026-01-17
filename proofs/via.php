<?php
declare(strict_types = 1);

use Innmind\TimeWarp\Halt;
use Innmind\TimeContinuum\Period;
use Innmind\Immutable\{
    Attempt,
    SideEffect,
};

return static function() {
    yield test(
        'Halt::via()',
        static function($assert) {
            $period = Period::millisecond(500);
            $expected = Attempt::result(SideEffect::identity);

            $halt = Halt::via(static function($in) use ($assert, $period, $expected) {
                $assert->same($period, $in);

                return $expected;
            });

            $assert->same($expected, $halt($period));
        },
    );
};

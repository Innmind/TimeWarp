# TimeWarp

| `master` | `develop` |
|----------|-----------|
| [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Innmind/TimeWarp/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Innmind/TimeWarp/?branch=master) | [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Innmind/TimeWarp/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/Innmind/TimeWarp/?branch=develop) |
| [![Code Coverage](https://scrutinizer-ci.com/g/Innmind/TimeWarp/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Innmind/TimeWarp/?branch=master) | [![Code Coverage](https://scrutinizer-ci.com/g/Innmind/TimeWarp/badges/coverage.png?b=develop)](https://scrutinizer-ci.com/g/Innmind/TimeWarp/?branch=develop) |
| [![Build Status](https://scrutinizer-ci.com/g/Innmind/TimeWarp/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Innmind/TimeWarp/build-status/master) | [![Build Status](https://scrutinizer-ci.com/g/Innmind/TimeWarp/badges/build.png?b=develop)](https://scrutinizer-ci.com/g/Innmind/TimeWarp/build-status/develop) |

Small lib to abstract the way to halt the program.

Currently this library is only usable on Earth, **DO NOT** use it on Mars or anywhere else in the universe.

## Installation

```sh
composer require innmind/time-warp
```

## Usage

```php
use Innmind\TimeWarp\{
    Halt\Usleep,
    Halt,
};
use Innmind\TimeContinuum\{
    TimeContinuumInterface,
    TimeContinuum\Earth,
    Period\Earth\Minute,
};

function yourApp(
    TimeContinuumInterface $clock,
    Halt $halt
): void {
    // do something
    $halt($clock, new Minute(42));
    // do some more
}

yourApp(new Earth, new Usleep);
```

This example will halt your program for 42 minutes.

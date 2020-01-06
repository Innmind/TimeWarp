# TimeWarp

| `develop` |
|-----------|
| [![codecov](https://codecov.io/gh/Innmind/TimeWarp/branch/develop/graph/badge.svg)](https://codecov.io/gh/Innmind/TimeWarp) |
| [![Build Status](https://github.com/Innmind/TimeWarp/workflows/CI/badge.svg)](https://github.com/Innmind/TimeWarp/actions?query=workflow%3ACI) |

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
    Clock,
    Earth,
    Earth\Period\Minute,
};

function yourApp(
    Clock $clock,
    Halt $halt
): void {
    // do something
    $halt($clock, new Minute(42));
    // do some more
}

yourApp(new Earth\Clock, new Usleep);
```

This example will halt your program for 42 minutes.

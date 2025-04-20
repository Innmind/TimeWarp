# TimeWarp

[![Build Status](https://github.com/innmind/timewarp/workflows/CI/badge.svg?branch=master)](https://github.com/innmind/timewarp/actions?query=workflow%3ACI)
[![codecov](https://codecov.io/gh/innmind/timewarp/branch/develop/graph/badge.svg)](https://codecov.io/gh/innmind/timewarp)
[![Type Coverage](https://shepherd.dev/github/innmind/timewarp/coverage.svg)](https://shepherd.dev/github/innmind/timewarp)

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
use Innmind\TimeContinuum\Period;

function yourApp(Halt $halt): void
{
    // do something
    $halt(Period::minute(42))->unwrap();
    // do some more
}

yourApp(new Usleep);
```

This example will halt your program for 42 minutes.

## Logging

```php
use Innmind\TimeWarp\Halt\Logger;
use Psr\Log\LoggerInterface;

$halt = Logger::psr($halt, /** an instance of LoggerInterface */);
```

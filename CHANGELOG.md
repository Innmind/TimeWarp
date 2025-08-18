# Changelog

## 4.1.1 - 2025-08-18

### Fixed

- Internal async implementation

## 4.1.0 - 2025-08-17

### Added

- `Innmind\TimeWarp\Halt\Async` (This is an internal feature for `innmind/async` that may introduce BC breaks in next minor versions)

## 4.0.0 - 2025-04-20

### Changed

- Requires PHP `8.2`
- Requires `innmind/time-continuum:~4.1`
- Requires `innmind/immutable:~5.12`
- `Innmind\TimeWarp\Halt` return an `Innmind\Immutable\Attempt<Innmind\Immutable\SideEffect>`
- `Innmind\TimeWarp\PeriodToMilliseconds` is now internal
- `Innmind\TimeWarp\Halt\Usleep` constructor is now private, use `::new()` named constructor

### Removed

- `Innmind\TimeWarp\Exception\Exception`
- `Innmind\TimeWarp\Exception\LogicException`

# Changelog

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

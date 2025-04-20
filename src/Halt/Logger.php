<?php
declare(strict_types = 1);

namespace Innmind\TimeWarp\Halt;

use Innmind\TimeWarp\Halt;
use Innmind\TimeContinuum\Period;
use Innmind\Immutable\Attempt;
use Psr\Log\LoggerInterface;

final class Logger implements Halt
{
    private Halt $halt;
    private LoggerInterface $logger;

    private function __construct(Halt $halt, LoggerInterface $logger)
    {
        $this->halt = $halt;
        $this->logger = $logger;
    }

    #[\Override]
    public function __invoke(Period $period): Attempt
    {
        $this->logger->debug('Halting current process...', ['period' => [
            'years' => $period->years(),
            'months' => $period->months(),
            'days' => $period->days(),
            'hours' => $period->hours(),
            'minutes' => $period->minutes(),
            'seconds' => $period->seconds(),
            'milliseconds' => $period->milliseconds(),
        ]]);

        return ($this->halt)($period);
    }

    public static function psr(Halt $halt, LoggerInterface $logger): self
    {
        return new self($halt, $logger);
    }
}

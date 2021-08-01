<?php
declare(strict_types = 1);

namespace Innmind\TimeWarp\Halt;

use Innmind\TimeWarp\Halt;
use Innmind\TimeContinuum\Period;
use Psr\Log\LoggerInterface;

final class Logger implements Halt
{
    private Halt $halt;
    private LoggerInterface $logger;

    public function __construct(Halt $halt, LoggerInterface $logger)
    {
        $this->halt = $halt;
        $this->logger = $logger;
    }

    public function __invoke(Period $period): void
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
        ($this->halt)($period);
    }
}

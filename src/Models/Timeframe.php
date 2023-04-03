<?php

declare(strict_types=1);

namespace KooiCodingChallenge\Models;

class Timeframe
{
    const START_TIME = '00:00';
    const END_TIME = '24:00';

    public function __construct(
        private readonly ?string $start = null,
        private readonly ?string $end = null,
    ) {
    }

    public function getStart(): ?string
    {
        return $this->start;
    }

    public function getEnd(): ?string
    {
        return $this->end;
    }

    public function toArray(): array
    {
        return ['from' => $this->start, 'to' => $this->end];
    }
}

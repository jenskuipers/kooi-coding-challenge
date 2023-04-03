<?php

declare(strict_types=1);

namespace KooiCodingChallenge\Models;

use KooiCodingChallenge\Strategies\Converter;

class MatrixConverter implements Converter
{

    public function convert(array $data): array
    {
        $timeframes = [];

        foreach ($data as $day => $intervals) {
            $activeTimeframes = $this->getActiveTimeframes($intervals);

            if (!in_array(false, $intervals)) {
                $timeframes[$day] = [];
                continue;
            }

            foreach ($activeTimeframes as $activeTimeframe) {
                $timeframe = new Timeframe($activeTimeframe['from'], $activeTimeframe['to']);

                $timeframes[$day][] = $timeframe->toArray();
            }
        }

        return $timeframes;
    }

    private function getActiveTimeframes(array $intervals): array
    {
        $activeTimeframes = [];
        $from = null;
        $to = null;
        $opened = false;

        foreach ($intervals as $interval => $active) {
            if ($this->shouldCloseTimeframe($from, $to, $active)) {
                $this->closeTimeframe($activeTimeframes, $from, $to);
                $from = null;
                $to = null;
            }

            if ($this->shouldOpenTimeframe($active, $opened)) {
                $opened = true;
                $from = $interval;
            }

            if ($this->shouldCloseOpenedTimeframe($active, $opened)) {
                $opened = false;
                $to = $interval;
            }
        }

        $this->closeTimeframe($activeTimeframes, $from, $to ?? Timeframe::END_TIME);

        return $activeTimeframes;
    }

    private function shouldCloseTimeframe(?string $from, ?string $to, bool $active): bool
    {
        return $from && $to && !$active;
    }

    private function shouldOpenTimeframe(bool $active, bool $opened): bool
    {
        return !$active && !$opened;
    }

    private function shouldCloseOpenedTimeframe(bool $active, bool $opened): bool
    {
        return $opened && $active;
    }

    private function closeTimeframe(array &$activeTimeframes, ?string $from, ?string $to): void
    {
        $from = $from === Timeframe::START_TIME ? null : $from;
        $to = $to === Timeframe::END_TIME ? null : $to;
        $activeTimeframes[] = compact('from', 'to');
    }
}

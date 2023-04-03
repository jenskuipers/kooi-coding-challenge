<?php

declare(strict_types=1);

namespace KooiCodingChallenge\Strategies;

interface Converter
{
    public function convert(array $data): array;
}

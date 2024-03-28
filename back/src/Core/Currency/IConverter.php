<?php

namespace App\Core\Currency;

interface IConverter
{
    public function convert(int $amount, string $from, string $to): array;
}

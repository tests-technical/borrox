<?php

namespace App\Infrastructure\Currency\Converter;

use App\Core\Currency\IConverter;

final class FreeCurrencyApi implements IConverter
{
    public function convert(int $amount, string $from, string $to): array
    {
        $convertedAmount = 123;

        return [
            'amount' => $convertedAmount,
            'currency' => $to,
        ];
    }
}

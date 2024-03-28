<?php

namespace App\Application\Currency;

use App\Core\Currency\IConverter;

final class ConvertImport
{
    public function __construct(private IConverter $converter)
    {
    }
    public function __invoke(int $amount, string $from, string $to): array
    {
        return $this->converter->convert($amount, $from, $to);
    }
}

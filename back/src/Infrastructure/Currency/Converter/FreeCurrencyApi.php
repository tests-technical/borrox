<?php

namespace App\Infrastructure\Currency\Converter;

use App\Core\Currency\IConverter;
use GuzzleHttp\Client;

final class FreeCurrencyApi implements IConverter
{
    public function convert(int $amount, string $from, string $to): array
    {
        $client = new Client([
            'base_uri' => 'https://api.freecurrencyapi.com',
            'timeout'  => 2.0,
        ]);

        $response = $client->request('GET', '/v1/latest?apikey=fca_live_cekBMaihwxwwDychGV0DeAqUmkJ5peRs1kf5vXmU');
        $body = json_decode($response->getBody()->getContents(), true);
        $data = $body['data'];

        if (!isset($data[$from]) || !isset($data[$to])) {
            throw new \Exception('Currency not found');
        }

        $convertedAmount = $amount * $data[$to] / $data[$from];

        return [
            'amount' => $convertedAmount,
            'currency' => $to,
        ];
    }
}

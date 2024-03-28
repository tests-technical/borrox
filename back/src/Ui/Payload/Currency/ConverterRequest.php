<?php

namespace App\Ui\Payload\Currency;

use App\Ui\Payload\BaseRequest;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

final class ConverterRequest extends BaseRequest
{
    #[Type('integer')]
    #[NotBlank()]
    protected $amount;

    #[Type('string')]
    #[NotBlank([])]
    protected $from;

    #[Type('string')]
    #[NotBlank([])]
    protected $to;

    public function amount(): int
    {
        return $this->amount;
    }

    public function from(): string
    {
        return $this->from;
    }

    public function to(): string
    {
        return $this->to;
    }
}

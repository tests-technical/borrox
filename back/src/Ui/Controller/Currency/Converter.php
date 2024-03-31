<?php

namespace App\Ui\Controller\Currency;

use App\Application\Currency\ConvertImport;
use App\Ui\Controller\AbstractController;
use App\Ui\Payload\Currency\ConverterRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Converter extends AbstractController
{
    public function __construct(
        private ConvertImport $convertImport
    ) {
    }

    #[Route('/api/currency/converter', name: 'currency.converter', methods: Request::METHOD_POST)]
    public function __invoke(ConverterRequest $request): Response
    {
        $res = $this->convertImport->__invoke(
            $request->amount(),
            $request->from(),
            $request->to()
        );

        return new JsonResponse(
            [
                'result' => sprintf('%s %s', $res['amount'], $res['currency'])
            ],
            Response::HTTP_OK
        );
    }
}

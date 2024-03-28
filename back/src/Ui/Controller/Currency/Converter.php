<?php

namespace App\Ui\Controller\Currency;

use App\Ui\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Converter extends AbstractController
{
    #[Route('/currency/converter', name: 'currency.converter', methods: Request::METHOD_GET)]
    public function __invoke(): Response
    {
        return new JsonResponse([
            'message' => 'Hello, world!',
        ]);
    }
}

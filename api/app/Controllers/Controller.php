<?php

namespace App\Controllers;

class Controller
{

    public const HTTP_CODES = [200, 201];

    /**
     * @param mixed $response
     * 
     * @return string
     */
    protected function output(mixed $response, int $httpCode): string
    {
        $mensagem = 'Operação realizada com sucesso.';

        if (! in_array($httpCode, self::HTTP_CODES)) {
            $httpCode = 400;
            $mensagem = 'Erro ao realizar operação.';
        }
        
        return json_encode([
            'message'      => $mensagem,
            'data'         => $response,
        ], JSON_UNESCAPED_UNICODE);
    }

}
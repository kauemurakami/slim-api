<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

# rota para que possibilita conexoes externas com Reqiusições do tipo options
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});
require __DIR__ . '/routes/autenticacao.php';
require __DIR__ . '/routes/produtos.php';

# Trata e exibe uma mensagem do Slim para a página não encontrada caso seja feita uma requisição para uma rota # que não definimos
$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function($req, $res) {
    $handler = $this->notFoundHandler; // handle using the default Slim page not found handler
    return $handler($req, $res);
});


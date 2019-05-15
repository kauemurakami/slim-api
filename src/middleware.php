<?php
# registra middlwers
use Slim\App;

# Autenticação sempre primeiro
# processo feito a cada nova requisição
$app->add();


# adiciona middlwares a acada requisiçao o envio de cabeçalhos para quem esta solicitando recursos da nossa api
$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*') # quais sites farão as http://mysite' 
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')# cabeçalhos padrões
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});
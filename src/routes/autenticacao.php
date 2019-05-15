<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Produto;
use App\Models\Usuario;
use \Firebase\JWT\JWT;



// Rotas para geração de token p; isso devemos solicitar alguns dados
$app->post('/api/token', function($request, $response){
	# recuperando os dados enviados via post
	$dados = $request->getParsedBody();

	$email = $dados['email'] ?? null;
	$senha = $dados['senha'] ?? null;

	$usuario = Usuario::where('email', $email)->first(); # retorna o primeiro resultado
	if (!is_null($usuario) && (md5($senha) == $usuario->senha )){
		# entao passou na validação e geraremos o token

		# secret key utilizada para criptografar e decriptografar
		$secretKey = $this->get('settings')['secretKey'];
		$tokenAccess = JWT::encode($usuario , $secretKey); # utilizando o método da classe JWT encode

		return $response->withJson(['chave'=>$tokenAccess]);
	}

	return $response->withJson([
		'status'=>'erro', 
	]);
});
	
	

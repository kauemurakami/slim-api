<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Produto;

// Rotas para produtos
$app->group('/api/v1', function(){
	
	// Lista todos produtos
	$this->get('/produtos/lista', function($request, $response){
		$produtos = Produto::get();
		return $response->withJson( $produtos );

	});

	// Adiciona um produto
	$this->post('/produtos/adiciona', function($request, $response){
		#recupera dados enviados via formulário
		$dados = $request->getParsedBody();

		//Validar

		$produto = Produto::create( $dados );
		return $response->withJson( $produto );

	});

	// Lista produto
	$this->get('/produtos/lista/{id}', function($request, $response, $args){#args é um array de valores ou um dicionario
		#var_dump($args);
		//validar
		$produto = Produto::FindOrFail($args['id']);
		//caso sim ..
		return $response->withJson( $produto );

	});

	//Atualizar
	$this->put('/produtos/atualiza/{id}', function($request, $response, $args){#args é um array de valores ou um dicionario
		#recuperando dados enviados via formulário
		$dados = $request->getParsedBody();
		#var_dump($args);
		
		$produto = Produto::FindOrFail($args['id']); # procura pelo produto com determinado id
		//caso sim ..
		$produto->update($dados);
		return $response->withJson($produto);

	});

	#remove produtos para determinado id
	$this->get('/produtos/remove/{id}', function($request, $response, $args){#args é um array de valores ou um dicionario
		#var_dump($args);
		//validar
		$produto = Produto::FindOrFail($args['id']);
		//caso sim ..
		$produto->delete();
		return $response->withJson( $produto );

	});	
});
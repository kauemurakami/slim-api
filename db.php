<?php

#verificação de segurança
if (PHP_SAPI != 'cli') { # retorna a interface que esta sendo utilizada para execução do script php
	exit('Rodar via CLI'); # faz com que esse script só seja executavel atraves da linha de comando e nunca pelo browser
}
#

#constante magica para recuperar o caminho completo para a pasta em que esta sendo executado	
require __DIR__ . '/vendor/autoload.php';

// Instantiate the app arquivo de configurações
$settings = require __DIR__ . '/src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/src/dependencies.php'; # recuperando db

$db = $container->get('db');
$schema = $db->schema();
$tabela = 'produtos';

$schema->dropIfExists($tabela);

//Cria tabela
$schema->create($tabela, function($table){
	$table->increments('id');
	$table->string('titulo', 100);
	$table->string('descricao');
	$table->decimal('preco', 11, 2);
	$table->string('fabricante', 60);
	$table->timestamps();

});

$db->table($tabela)->insert([
	'titulo' => 'Smartphone Motorola Moto G6 32GB Dual Chip',
	'descricao' => 'Android Oreo - 8.0 tela 5.7" Octa Core 1.8GHz 4G Câmera 12 + 5MP (Dual Traseira)',
	'preco' => 899.00,
	'fabricante' => 'Motorola',
	'created_at' => '2019-10-22',
	'updated_at' => '2019-10-23'
]);


$db->table($tabela)->insert([
	'titulo' => 'Iphone X Cinxa Espacial 64GB',
	'descricao' => 'Tela 5.8" IOS 12 4G Wi-Fi Câmera 12MP - Apple',
	'preco' => 4999.00,
	'fabricante' => 'Apple',
	'created_at' => '2019-01-10',
	'updated_at' => '2019-02-01'
]);

//Cria tabela
$tabela = 'usuarios';
$schema->dropIfExists($tabela);
$schema->create($tabela, function($table){
	$table->increments('id');
	$table->string('email', 100);
	$table->string('senha'); //converter para md5 no bd
	$table->timestamps();

});
$db->table($tabela)->insert([
	'email' => 'testando@gmail.com',
	'senha' => '12345'
]);
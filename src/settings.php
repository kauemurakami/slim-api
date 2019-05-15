<?php
return [
    'settings' => [
        #configurar para false no ambiente de produção
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        //DB SETTINGS
        'db'=> [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'slim-api',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ],

        // Secret
        'secretKey' => '0501a9f3742e65abb2cc19cd0b182cd2133c983d',
        
        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
    ],
];

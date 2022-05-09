<?php

use Controllers\SQLInjection;
use DI\Container;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

// Create Container using PHP-DI
$container = new Container();

$container->set('db', function () {
    $host = 'db';
    $dbname = 'owasp';
    $username = 'user';
    $password = 'password';
    $charset = 'utf8mb4';
    $collate = 'utf8mb4_unicode_ci';
    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_PERSISTENT => false,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $charset COLLATE $collate"
    ];

    return new PDO($dsn, $username, $password, $options);
});


// Set container to create App with on AppFactory
AppFactory::setContainer($container);

$app = AppFactory::create();

$app->get('/v1/user/{id}/posts', [SQLInjection::class ,'rawConcat']);

$app->get('/v2/user/{id}/posts', [SQLInjection::class ,'pdoQuote']);

$app->get('/v3/user/{id}/posts', [SQLInjection::class ,'pdoPrepare']);

$app->run();

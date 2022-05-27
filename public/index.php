<?php

use Controllers\ErrorHandling;
use Controllers\SQLInjection;
use Controllers\SSRF;
use DI\Container;
use Slim\Factory\AppFactory;
use Slim\Middleware\ErrorMiddleware;

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

$debugErrorHandler = new ErrorMiddleware(
    $app->getCallableResolver(),
    $app->getResponseFactory(),
    true,
    true,
    true
);

$prodErrorHandler = new ErrorMiddleware(
    $app->getCallableResolver(),
    $app->getResponseFactory(),
    false,
    true,
    true
);

$app->get('/v1/user/{id}/posts', [SQLInjection::class ,'rawConcat']);
$app->get('/v1/user/posts', [SQLInjection::class ,'rawConcat']);

$app->get('/v2/user/{id}/posts', [SQLInjection::class , 'addSlashes']);
$app->get('/v2/user/posts', [SQLInjection::class , 'addSlashes']);

$app->get('/v3/user/{id}/posts', [SQLInjection::class ,'pdoPrepare']);
$app->get('/v3/user/posts', [SQLInjection::class ,'pdoPrepare']);

$app->get('/v1/downloadPDF', [SSRF::class ,'noRestrictions']);
$app->get('/v2/downloadPDF', [SSRF::class ,'noRestrictionsBlind']);;
$app->get('/v3/downloadPDF', [SSRF::class ,'blacklist']);


$app->get('/v1/error', [ErrorHandling::class ,'raw']);
$app->get('/v2/error', [ErrorHandling::class ,'debug'])->addMiddleware($debugErrorHandler);
$app->get('/v3/error', [ErrorHandling::class ,'clean'])->addMiddleware($prodErrorHandler);

$app->run();

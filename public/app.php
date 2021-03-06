<?php
if (php_sapi_name() == 'cli-server') {
    if($_SERVER["REQUEST_URI"] === '/' || preg_match('/\.(?:png|jpg|jpeg|gif|css|js)$/', $_SERVER["REQUEST_URI"])) {
        return false;
    }
}

require_once __DIR__.'/../vendor/autoload.php'; 

$app = new Silex\Application(); 
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'   => 'pdo_sqlite',
        'path'     => __DIR__.'/../app.db',
    ),
));
$app['debug'] = true;

$app->mount('/', new Insannu\Api\Controller\DefaultController());

$app->run(); 

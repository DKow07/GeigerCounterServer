<?php

require '../vendor/autoload.php';

$config = require '../config.php';

$app = new \Slim\App(['settings' => $config]);

$container = $app->getContainer();
$container['db'] = function ($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    return $capsule;
};

$app->group('/v1/', function () {
    $this->group('result', function () {
        $this->get('[/]', \Core\Controller\ResultController::class . ':findAll');
        $this->post('[/]', \Core\Controller\ResultController::class . ':saveResult');
        $this->get('/current[/]', \Core\Controller\ResultController::class . ':findCurrentResult');
    });
    $this->group('curiosity', function () {
        $this->get('[/]', \Core\Controller\CuriosityController::class . ':findAll');
        $this->get('/one[/]', \Core\Controller\CuriosityController::class . ':getRandomCuriosity');
    });
});

$app->run();
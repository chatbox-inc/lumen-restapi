<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Laravel\Lumen\Application(
    realpath(__DIR__)
);

$app->withFacades();

$app->withEloquent();

$app->register(\Chatbox\RestAPI\RestAPIServiceProvider::class);

return $app;

<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Laravel\Lumen\Application(
    realpath(__DIR__)
);

$app->singleton(\Illuminate\Contracts\Debug\ExceptionHandler::class,\App\Exceptions\Handler::class);

$app->register(\Chatbox\RestAPI\RestAPIServiceProvider::class);

$app->group([
    "middleware" => [
        \Chatbox\RestAPI\Http\Middleware\HttpExceptionHandler::class,
        \Chatbox\RestAPI\Http\Middleware\APIResponseHandler::class
    ]
],function($router){
    $router->get("/api/status",function(){
        return [];
    });

    $router->get("/api/missing",function(){
        abort(404);
    });

    $router->get("/api/error",function(){
        throw new \Exception();
    });
});

return $app;

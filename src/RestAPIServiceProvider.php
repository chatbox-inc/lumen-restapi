<?php
namespace Chatbox\RestAPI;
use Chatbox\RestAPI\Http\Middleware\APIResponse;
use Chatbox\RestAPI\Http\Middleware\BadRequestHttpExceptionHandler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\ServiceProvider;
use Chatbox\RestAPI\Exceptions\Handler;
use Laravel\Lumen\Application;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/08/08
 * Time: 1:37
 */
class RestAPIServiceProvider extends ServiceProvider
{
    public function register()
    {
        /** @var Application $app */
        $app = $this->app;


//        $app->middleware(APIResponse::class);
//        $app->middleware(BadRequestHttpExceptionHandler::class);
    }
}
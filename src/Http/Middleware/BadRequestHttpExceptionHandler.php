<?php
namespace Chatbox\RestAPI\Http\Middleware;
use Illuminate\Http\Response;
use Chatbox\RestAPI\Http\Response as ResponseFactory;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/10/01
 * Time: 15:55
 */
class BadRequestHttpExceptionHandler
{
    protected $response;

    public function __construct(ResponseFactory $response)
    {
        $this->response = $response;
    }

    public function handle($request, \Closure $next)
    {
        $response = $next($request);

        if($response instanceof Response){
            $e = $response->exception;
            if(
                ($e instanceof BadRequestHttpException) &&
                $response->getStatusCode() === 500
            ){
                $response = $this->response->bad([
                    "message" => $e->getMessage()
                ])->withException($e);
            }
        }

        return $response;
    }

}


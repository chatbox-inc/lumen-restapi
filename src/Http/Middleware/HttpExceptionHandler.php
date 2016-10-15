<?php
namespace Chatbox\RestAPI\Http\Middleware;
use Illuminate\Http\Response;
use Chatbox\RestAPI\Http\Response as ResponseFactory;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/10/01
 * Time: 15:55
 */
class HttpExceptionHandler
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
            if( $e instanceof HttpException){
                if($e instanceof NotFoundHttpException){
                    $message = "sorry, the requested uri does not found";
                }else{
                    $message = $e->getMessage() ?: "whoops, something wrong with you";
                }
                $response = $this->response->bad([
                    "message" => $message
                ])->withException($e);
            }
        }

        return $response;
    }

}


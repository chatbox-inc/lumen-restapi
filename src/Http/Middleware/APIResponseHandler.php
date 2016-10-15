<?php
namespace Chatbox\RestAPI\Http\Middleware;
use Illuminate\Http\Response;
use Chatbox\RestAPI\Http\Response as ResponseFactory;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/10/01
 * Time: 15:55
 */
class APIResponseHandler
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
            if($response->exception){
                return $this->response->exception($response->exception);
            }
            $content = $response->getOriginalContent();
            return $this->response->ok($content);
        }

        return $response;
    }

}


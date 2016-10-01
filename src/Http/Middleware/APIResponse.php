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
class APIResponse
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
            $content = $response->getOriginalContent();
            if(!is_array($content)){
                return $response;
            }
            return $this->response->ok($content);
        }

        return $response;
    }

}


<?php
namespace Chatbox\RestAPI\Http\ErrorResponse;
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/10/01
 * Time: 16:27
 */
class Exception
{
    protected $response;

    public function __construct(\Chatbox\RestAPI\Http\Response $response)
    {
        $this->response = $response;
    }

    public function supports():array
    {
        return [\Exception::class];
    }

    public function debug(\Exception $e)
    {
        return $this->response->error([
            "message" => $e->getMessage(),
            "file" => $e->getFile(),
            "line" => $e->getLine(),
            "code" => $e->getCode(),
            "class" => get_class($e),
            "trace" => $e->getTrace(),
        ]);
    }

    public function production(\Exception $e)
    {
        return $this->response->error([
            "message" => "whoops, something wrong with application."
        ]);
    }


}
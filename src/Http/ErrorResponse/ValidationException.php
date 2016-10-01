<?php
namespace Chatbox\RestAPI\Http\ErrorResponse;
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/10/01
 * Time: 16:27
 */
class ValidationException implements ErrorResponseInterface
{
    protected $response;

    public function __construct(\Chatbox\RestAPI\Http\Response $response)
    {
        $this->response = $response;
    }

    public function supports():array
    {
        return [\Illuminate\Validation\ValidationException::class];
    }

    public function debug(\Exception $e)
    {
        return $this->response->bad([
            "message" => "validation failure",
            "error" => $e->validator->errors(),
        ]);
    }

    public function production(\Exception $e)
    {
        return $this->debug($e);
    }


}
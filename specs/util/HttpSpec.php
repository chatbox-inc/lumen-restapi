<?php
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\Concerns\MakesHttpRequests;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/08/07
 * Time: 17:30
 */
class HttpSpec
{
    use MakesHttpRequests;

    protected $app;

    protected $entry;

    protected $baseUrl = 'http://localhost:8080';

    /**
     * HttpSpec constructor.
     * @param $lumen
     */
    public function __construct($lumen)
    {
        $this->app = $lumen;
    }

    /**
     * @return Response;
     */
    public function response(){
        $response = $this->response;
        return $response;
    }

    public function login($token){
        $this->get("/message/$token");
        return $this;
    }

    public function callPost($message){
        $this->post("/message/",[
            "message" => $message
        ]);
        return $this;
    }

    public function callPut($token,$message){
        $this->put("/message/$token",[
            "message" => $message
        ]);
        return $this;
    }

    public function callDelete($token){
        $this->delete("/message/$token");
        return $this;
    }

    public function isOk(){
        assert($this->response()->getStatusCode() === 200);
        $content = $this->response()->getOriginalContent();
        assert($content["status"] === "OK");
    }

    public function isBad(){
        assert($this->response()->getStatusCode() === 400);
        $content = $this->response()->getOriginalContent();
        assert($content["status"] === "BAD");
    }

    public function isJsonResponse(){
        json_decode($this->response()->getContent());
        return assert(json_last_error() === JSON_ERROR_NONE);
    }

}
<?php
namespace Chatbox\RestAPI\Http;
use Chatbox\RestAPI\Http\ErrorResponse\Exception as ErrorResponse;
use Chatbox\RestAPI\Http\ErrorResponse\ValidationException;
use Illuminate\Http\JsonResponse;
use Chatbox\RestAPI\Http\ErrorResponse\ErrorResponseInterface;
use Illuminate\Http\Response as IlluminateResponse;

class Response
{
    public $errorResponse = [
        ValidationException::class
    ];

    public function make($status,array $body=[],array $header=[]){
        return IlluminateResponse::create($body,$status,$header);
    }

    protected function defaultHeader(){
        return [];
    }

    public function ok(array $body=[]){
        $body["status"] = "OK";
        return $this->make(200,$body,$this->defaultHeader());
    }

    public function bad(array $body=[]){
        $body["status"] = "BAD";
        return $this->make(400,$body,$this->defaultHeader());
    }

    public function error(array $body=[]){
        $body["status"] = "ERROR";
        return $this->make(500,$body,$this->defaultHeader());
    }

    public function exception($e){
        $parsedException = $this->parseException($e);
        if($parsedException instanceof \Illuminate\Http\Response){
            $parsedException->withException($e);
        }
        return $parsedException;
    }

    protected function parseException($e){
        foreach ($this->errorResponse as $eResponse) {
            /** @var ErrorResponseInterface $eResponse */
            $eResponse = app($eResponse);
            foreach ($eResponse->supports() as $support){
                if(is_a($e,$support)){
                    if(env("APP_ENV") === "production"){
                        return $eResponse->production($e);
                    }else{
                        return $eResponse->debug($e);
                    }
                }
            }
        }
        $eResponse = new ErrorResponse($this);
        if(env("APP_ENV") === "production"){
            return $eResponse->production($e);
        }else{
            return $eResponse->debug($e);
        }
    }
}
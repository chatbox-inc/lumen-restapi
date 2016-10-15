<?php
namespace Chatbox\RestAPI\Http;
use Chatbox\RestAPI\Http\ErrorResponse\Exception as ErrorResponse;
use Illuminate\Http\Response as IlluminateResponse;

class Response
{
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
        $eResponse = new ErrorResponse($this);
        if(env("APP_ENV") === "production"){
            return $eResponse->production($e);
        }else{
            return $eResponse->debug($e);
        }
    }
}
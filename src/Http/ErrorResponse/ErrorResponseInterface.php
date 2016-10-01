<?php
namespace Chatbox\RestAPI\Http\ErrorResponse;
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/10/01
 * Time: 16:27
 */
interface ErrorResponseInterface
{
    public function supports():array;

    public function debug(\Exception $e);

    public function production(\Exception $e);

}
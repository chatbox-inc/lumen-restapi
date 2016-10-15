# Lumen Application

[![Latest Stable Version](https://poser.pugx.org/chatbox-inc/lumen-restapi/version)](https://packagist.org/packages/chatbox-inc/lumen-restapi)
[![License](https://poser.pugx.org/chatbox-inc/lumen-restapi/license)](https://packagist.org/packages/chatbox-inc/lumen-restapi)
[![composer.lock available](https://poser.pugx.org/chatbox-inc/lumen-restapi/composerlock)](https://packagist.org/packages/chatbox-inc/lumen-restapi)

Rest API アプリケーション作成用のミドルウェア

レスポンス生成の一元化とエラーハンドリングを担う。

## 機能

- RestAPI Response整形の1極化
- ExceptionHandlerの搭載

## Usage

Exception Handler はデフォルトのものを使用する想定

````
$app->singleton(\Illuminate\Contracts\Debug\ExceptionHandler::class,\App\Exceptions\Handler::class);
````

対象のルートにミドルウェアを二枚かける

ミドルウェアの設定順序には注意すること。

````
$app->group([
    "middleware" => [
        \Chatbox\RestAPI\Http\Middleware\HttpExceptionHandler::class,
        \Chatbox\RestAPI\Http\Middleware\APIResponseHandler::class
        ]
],function($router){
    $router->get("/api/status",function(){
        return [];
    });

    $router->get("/api/missing",function(){
        abort(404);
    });

    $router->get("/api/error",function(){
        throw new \Exception();
    });
});
````


## 拡張

全ての例外は一度 HttpRequest で投げられるので、そこから処理してあげると楽だったり。

400 系エラー例外はHttpExcepiton 継承で投げると特別処理がかかる。

### Responseを操作する時

\Chatbox\RestAPI\Http\Response を拡張する。

### Exceptionsを操作する時

\Chatbox\RestAPI\Exceptions\Handler を拡張する。
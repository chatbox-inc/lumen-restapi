# Lumen Application

[![Latest Stable Version](https://poser.pugx.org/chatbox-inc/lumen-restapi/version)](https://packagist.org/packages/chatbox-inc/lumen-restapi)
[![License](https://poser.pugx.org/chatbox-inc/lumen-restapi/license)](https://packagist.org/packages/chatbox-inc/lumen-restapi)
[![composer.lock available](https://poser.pugx.org/chatbox-inc/lumen-restapi/composerlock)](https://packagist.org/packages/chatbox-inc/lumen-restapi)

Rest API アプリケーション作成用のスケルトン

## 機能

- RestAPI Response整形の1極化
- ExceptionHandlerの搭載

## Usage

````
$app->register(\Chatbox\RestAPI\RestAPIServiceProvider::class);
````

## 拡張

### Responseを操作する時

\Chatbox\RestAPI\Http\Response を拡張する。

### Exceptionsを操作する時

\Chatbox\RestAPI\Exceptions\Handler を拡張する。
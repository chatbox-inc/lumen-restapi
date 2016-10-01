# Lumen Application

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
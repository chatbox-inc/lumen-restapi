<?php //arrayobject.spec.php
describe('SimpleAPI', function() {

    $app = require __DIR__ . "/../sample/bootstrap.php";
    $spec = new \Chatbox\Message\Spec\HttpSpec($app);


    it('assert http', function() use($spec){

        // メッセージの投稿
        $message = [
            "from" => "Tom",
            "to" => "John",
            "body" => ["text" => "hello world"],
            "subject" => "hello world"
        ];
        $response = $spec->callPost($message)->response();
        $spec->isOk();
        $message = $spec->assertResponseHasMessage();

        // 投稿メッセージの取得
        $uid = $message["code"];
        $response = $spec->callGet($uid)->response();
        $spec->isOk();
        $spec->assertResponseHasMessage();

        // 投稿メッセージの削除
        $response = $spec->callDelete($uid)->response();
        $spec->isOk();

        // 投稿メッセージ取得エラー
        $response = $spec->callGet($uid)->response();
        $spec->assertResponseHasNotFoundException();
    });

    xit('fail with invalid message', function() {
        $spec = new \Chatbox\Message\Spec\HttpSpec($this->lumen);

        $okMessage = [
            "from" => "Tom",
            "to" => "John",
            "body" => "hello world"
        ];

        // メッセージの投稿
        $response = $spec->post($okMessage)->response();
        $spec->isOk();

        // NG FROM抜き
        $ngMessage = $okMessage;
        unset($ngMessage["from"]);
        $response = $spec->post($ngMessage)->response();
        $spec->assertResponseHasValidationException();

        // NG FROM配列
        $ngMessage = $okMessage;
        $ngMessage["from"] = ["Tom"];
        $response = $spec->post($ngMessage)->response();
        $spec->assertResponseHasValidationException();

        // NG TO抜き
        $ngMessage = $okMessage;
        unset($ngMessage["to"]);
        $response = $spec->post($ngMessage)->response();
        $spec->assertResponseHasValidationException();

        // NG TO配列
        $ngMessage = $okMessage;
        $ngMessage["to"] = ["Tom"];
        $response = $spec->post($ngMessage)->response();
        $spec->assertResponseHasValidationException();

        // Body 抜きはOK
        $ngMessage = $okMessage;
        unset($ngMessage["body"]);
        $response = $spec->post($ngMessage)->response();
        $spec->isOk();

    });
});
?>
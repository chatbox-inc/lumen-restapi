<?php //arrayobject.spec.php
describe('RestAPI Sample', function() {

    it('GET /api/status should get ok ', function() {
        $lumen = new HttpSpec(require __DIR__ . "/../bootstrap.php");

        $response = $lumen->get("/api/status")->response();

        assert($response->getStatusCode() === 200);
        $lumen->isJsonResponse();
    });

    it('GET /api/missing should 400 ', function() {
        $lumen = new HttpSpec(require __DIR__ . "/../bootstrap.php");

        $response = $lumen->get("/api/missing")->response();

        assert($response->getStatusCode() === 400);
        $lumen->isJsonResponse();
    });

    it('GET /api/error should 500 ', function() {
        $lumen = new HttpSpec(require __DIR__ . "/../bootstrap.php");

        $response = $lumen->get("/api/error")->response();

        assert($response->getStatusCode() === 500);
        $lumen->isJsonResponse();
    });
});
?>
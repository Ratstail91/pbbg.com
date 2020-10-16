<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Opis\JsonSchema\{
    Validator, ValidationResult, ValidationError, Schema
};

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function registerUser($uuid = null) {
        $uuid = $uuid ?: uniqid();
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/register', [
            'name' => 'User_' . $uuid,
            'email' => 'foo_' . $uuid . '@bar.baz',
            'password' => 'foobarbaz'
        ]);
        $response_json = json_decode($response->content());
        $token = $response_json->data->token;
        $this->assertNotEquals('', $token); # improve this to check that token is valid JWT
        return $token;
    }

    public function assertSchema($data, $schema_file) {
        $schema = Schema::fromJsonString(file_get_contents(__DIR__ . "/../schemas/$schema_file"));
        $validator = new Validator();
        $result = $validator->schemaValidation($data, $schema);

        $result_is_valid = 0;

        if ($result->isValid()) {
            $result_is_valid = 1;
        } else {
            dd([$result->getFirstError()->data(), $result->getFirstError()->keyword(), $result->getFirstError()->keywordArgs()]);
        }

        $this->assertEquals(1, $result_is_valid);
    }

    public function assertResponse($response, $code) {
        $response->assertStatus($code);
        $content = json_decode($response->getContent());
        $this->assertSchema($content, "responses/$code.json");
    }
}

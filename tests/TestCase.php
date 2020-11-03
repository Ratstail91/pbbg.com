<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Opis\JsonSchema\{Validator, Schema};

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Assert that the schema of the response matches the defined schema.
     *
     * @param $data
     * @param $schema_file
     */
    public function assertSchema($data, $schema_file)
    {
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

    /**
     * Assert that the response has the correct code and schema expected.
     *
     * @param $response
     * @param $code
     */
    public function assertResponse($response, $code)
    {
        $response->assertStatus($code);
        $content = json_decode($response->getContent());
        $this->assertSchema($content, "responses/$code.json");
    }
}

<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\ClientRepository;
use Opis\JsonSchema\{Validator, Schema};

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    /**
     * Determines if database seeds should be executed after migration.
     *
     * @var bool
     */
    public $seed = true;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        if (! file_exists(storage_path('oauth-private.key'))
            || ! file_exists(storage_path('oauth-public.key'))
        ) {
            exit("Error: Install Laravel Passport\n");
        }

        $this->createTestClient();
    }

    /**
     * Create a test personal access client for the application.
     * The client ID and secret match credentials defined in "phpunit.xml".
     *
     * @return void
     */
    protected function createTestClient(): void
    {
        $client = app(ClientRepository::class)->createPersonalAccessClient(
            null, 'Test Personal Access Client', 'http://localhost'
        );

        $client->id = 1;
        $client->setSecretAttribute('secret');
        $client->save();

        DB::table('oauth_personal_access_clients')->insert([
            'client_id'  => $client->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

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

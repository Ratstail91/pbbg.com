<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Passport;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class DeleteUsersTest extends TestCase
{
    /**
     * Setup the test environment.
     * Deletes existing roles and permissions before running a test.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        DB::statement('TRUNCATE TABLE model_has_roles;');

        // turn off FK constraint to allow truncate
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        // create role
        Role::create(['name' => 'admin']);
    }

    /**
     * Tests that the authorized user can delete all users.
     *
     * @return void
     */
    public function testDeleteUsers()
    {
        $user = User::factory()->create();

        $count = User::count();
        $this->assertGreaterThan(0, $count);

        $role = Role::where('name', 'admin')->first();

        $user->assignRole($role);

        Passport::actingAs($user);

        $response = $this->withHeaders(['Accept' => 'application/json'])->delete('/users');

        $this->assertResponse($response, 200);

        $count = User::count();
        $this->assertEquals(0, $count);
    }

    /**
     * Tests that the user without role "admin" cannot delete all users.
     *
     * @return void
     */
    public function testDeleteUsersWithoutAuthorization()
    {
        Passport::actingAs(User::factory()->create());

        $count = User::count();
        $this->assertGreaterThan(0, $count);

        $response = $this->withHeaders(['Accept' => 'application/json'])->delete('/users');

        $this->assertResponse($response, 403);
    }

    /**
     * Tests that an unauthenticated user cannot delete all users.
     *
     * @return void
     */
    public function testDeleteUsersWithoutAuthentication()
    {
        $count = User::count();
        $this->assertGreaterThan(0, $count);

        $response = $this->withHeaders(['Accept' => 'application/json'])->delete('/users');

        $this->assertResponse($response, 401);
    }
}

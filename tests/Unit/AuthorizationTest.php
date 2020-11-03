<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AuthorizationTest extends TestCase
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

        DB::statement('TRUNCATE TABLE role_has_permissions;');
        DB::statement('TRUNCATE TABLE model_has_roles;');
        DB::statement('TRUNCATE TABLE model_has_permissions;');

        // turn off FK constraint to allow truncate
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        Role::truncate();
        Permission::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }

    /**
     * Tests that the user has a role called "test_role".
     *
     * @return void
     */
    public function testUserHasRole()
    {
        $user = User::factory()->create();

        $role = Role::create(['name' => 'test_role']);

        $user->assignRole($role);

        $this->assertCount(1, $user->roles);
        $this->assertEquals('test_role', $user->roles->first()->name);
    }

    /**
     * Tests that the user has a permission called "can pass test".
     *
     * @return void
     */
    public function testUserHasPermission()
    {
        $role = Role::create(['name' => 'role_'.uniqid()]);
        $permission = Permission::create(['name' => 'can pass test']);

        $role->givePermissionTo($permission);

        $this->assertCount(1, $role->permissions);
        $this->assertEquals('can pass test', $role->permissions->first()->name);
    }
}

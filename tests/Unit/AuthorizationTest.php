<?php

namespace Tests\Unit;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
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

<?php

namespace Tests\Feature\Model;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function rolesCanBelongToMultiplePermissions()
    {
        // Given
        $role = Role::factory()->create();
        $permissions = Permission::factory()->times(3)->create();

        // When
        $role->permissions()->sync($permissions);

        // Then
        $permissions->each(function ($permission) use ($role) {
            $this->assertDatabaseHas('permission_role', [
                'role_id' => $role->id,
                'permission_id' => $permission->id,
            ]);
        });
    }
}

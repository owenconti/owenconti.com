<?php

namespace Tests\Feature\Model;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function permissionsCanBelongToMultipleRoles()
    {
        // Given
        $permission = Permission::factory()->create();
        $roles = Role::factory()->times(3)->create();

        // When
        $permission->roles()->sync($roles);

        // Then
        $roles->each(function ($role) use ($permission) {
            $this->assertDatabaseHas('permission_role', [
                'role_id' => $role->id,
                'permission_id' => $permission->id,
            ]);
        });
    }
}

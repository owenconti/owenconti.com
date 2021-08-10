<?php

namespace Tests\Feature\Model;

use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeamTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function teamsCanBelongToMultipleUsers()
    {
        // Given
        $role = Role::factory()->create();
        $team = Team::factory()->create();
        $users = User::factory()->times(3)->create();

        // When
        $team->users()->attach($users, ['role_id' => $role->id]);

        // Then
        $users->each(function ($user) use ($team, $role) {
            $this->assertDatabaseHas('team_user', [
                'user_id' => $user->id,
                'team_id' => $team->id,
                'role_id' => $role->id,
            ]);
        });
    }
}

<?php

namespace Tests\Feature\Model;

use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function usersCanBelongToMultipleTeams()
    {
        // Given
        $role = Role::factory()->create();
        $user = User::factory()->create();
        $teams = Team::factory()->times(3)->create();

        // When
        $user->teams()->attach($teams, ['role_id' => $role->id]);

        // Then
        $teams->each(function ($team) use ($user, $role) {
            $this->assertDatabaseHas('team_user', [
                'user_id' => $user->id,
                'team_id' => $team->id,
                'role_id' => $role->id,
            ]);
        });
    }
}

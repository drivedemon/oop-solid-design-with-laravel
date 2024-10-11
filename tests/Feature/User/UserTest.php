<?php

namespace Tests\Feature\User;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_user_update_profile(): void
    {
        $user = User::factory()->create();
        $this->signIn($user);

        $updateData = ['last_name' => 'test2', 'first_name' => 'test'];

        $response = $this->put(route('users.update', $user), $updateData);
        $response->assertStatus(200);
        $response = $response->json();

        $user->refresh();

        $this->assertSame($updateData['last_name'], $response['data']['last_name']);
        $this->assertSame($updateData['first_name'], $response['data']['first_name']);
    }

    public function test_user_update_profile_when_try_to_update_other_user_then_return_action_is_unauthorized(): void
    {
        $otherUser = User::factory()->create();
        $user = User::factory()->create();

        $this->signIn($otherUser);

        $updateData = ['last_name' => 'test2', 'first_name' => 'test'];

        $response = $this->put(route('users.update', $user), $updateData);
        $response->assertStatus(403);
    }

    public function test_user_update_profile_when_user_not_found_then_return_not_found_user(): void
    {
        $otherUser = User::factory()->create();

        $this->signIn($otherUser);

        $updateData = ['last_name' => 'test2', 'first_name' => 'test'];

        $response = $this->put(route('users.update', 1234), $updateData);
        $response->assertStatus(404);
    }
}

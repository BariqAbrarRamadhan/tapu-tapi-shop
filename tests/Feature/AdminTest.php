<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    public function it_can_retrieve_a_single_user_by_id()
    {
        $user = User::factory()->create();

        $retrievedUser = User::getSingle($user->id);

        $this->assertEquals($user->id, $retrievedUser->id);
        $this->assertEquals($user->name, $retrievedUser->name);
        $this->assertEquals($user->email, $retrievedUser->email);
    }

    public function it_can_retrieve_admin_users()
    {
        User::factory()->count(3)->create();

        $adminUsers = User::factory()->count(2)->admin()->create();

        $retrievedAdminUsers = User::getAdmin();

        $this->assertCount(count($adminUsers), $retrievedAdminUsers);

        foreach ($retrievedAdminUsers as $adminUser) {
            $this->assertTrue($adminUser->is_admin);
        }
    }
}

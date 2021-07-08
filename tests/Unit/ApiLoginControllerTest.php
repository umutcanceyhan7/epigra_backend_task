<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiLoginControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get(route('spaceXApi.login.index'));

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen()
    {
        $user = User::factory()->create();

        $user = $this->actingAs($user, 'api');

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ])->assertStatus(200);

        $this->assertAuthenticated();
    }
}

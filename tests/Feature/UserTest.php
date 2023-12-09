<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserTest extends TestCase
{

    public function testAuth()
    {
        $this->seed(UserSeeder::class);

        $success = Auth::attempt([
            'email' => 'otong@localhost',
            'password' => 'otong123'
        ], true);

        $this->assertTrue($success);

        $user = Auth::user();
        $this->assertNotNull($user);
        $this->assertEquals('otong@localhost', $user->email);
    }

    public function testGuest()
    {
        $user = Auth::user();
        self::assertNull($user);
    }

    public function testLogin()
    {
        $this->seed(UserSeeder::class);

        $this->get('/users/login?email=otong@localhost&password=otong123')
            ->assertRedirect('/users/current');

        $this->get('/users/login?email=otong@localhost&password=salah')
            ->assertSeeText('Wrong credentials');
    }

    public function testCurrent()
    {
        $this->seed(UserSeeder::class);

        $this->get('/users/current')
            ->assertStatus(302)
            ->assertRedirect('/login');

        $user = User::where('email', 'otong@localhost')->firstOrFail();
        $this->actingAs($user)
            ->get('/users/current')
            ->assertSeeText('Hello Otong Surotong');
    }

    public function testTokenGuard()
    {
        $this->seed(UserSeeder::class);

        $this->get('/api/users/current', [
            'Accept' => 'Application/json'
        ])->assertStatus(401);

        $this->get('/api/users/current', [
            'Accept' => 'Application/json',
            'API-Key' => 'rahasia'
        ])->assertSeeText('Hello Otong Surotong');
    }

    public function testUserProvider()
    {
        $this->seed(UserSeeder::class);

        $this->get('/simple-api/users/current', [
            'Accept' => 'Application/json'
        ])->assertStatus(401);

        $this->get('/simple-api/users/current', [
            'Accept' => 'Application/json',
            'API-Key' => 'rahasia'
        ])->assertSeeText('Hello Otong');
    }
}

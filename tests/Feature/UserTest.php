<?php

namespace Tests\Feature;

use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testAuth()
    {
        $this->seed(UserSeeder::class);

        $success = Auth::attempt([
            'email' => 'otong@gmail.com',
            'password' => 'otong123'
        ], true);

        $this->assertTrue($success);

        $user = Auth::user();
        $this->assertNotNull($user);
        $this->assertEquals('otong@gmail.com', $user->email);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class HashTest extends TestCase
{
    public function testHash()
    {
        $password = '12345';
        $hash = Hash::make($password);

        $password2 = '12345';
        $hash2 = Hash::make($password2);

        $this->assertNotEquals($hash, $hash2);

        $result = Hash::check($password, $hash);
        $this->assertTrue($result);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class EncryptionTest extends TestCase
{
    public function testEncryption()
    {
        $value = "Otong Surotong";

        $encrypted = Crypt::encryptString($value);
        $decrypted = Crypt::decryptString($encrypted);

        $this->assertEquals($value, $decrypted);
    }
}

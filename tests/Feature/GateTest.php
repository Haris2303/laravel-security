<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\User;
use Database\Seeders\ContactSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class GateTest extends TestCase
{
    public function testGate()
    {
        $this->seed([UserSeeder::class, ContactSeeder::class]);

        $user = User::where('email', 'otong@localhost')->firstOrFail();
        Auth::login($user);

        $contact = Contact::where('email', 'example@localhost')->firstOrFail();

        $this->assertTrue(Gate::allows('get-contact', $contact));
        $this->assertTrue(Gate::allows('update-contact', $contact));
        $this->assertTrue(Gate::allows('delete-contact', $contact));
    }

    public function testGateNonLogin()
    {
        $this->seed([UserSeeder::class, ContactSeeder::class]);

        $user = User::where('email', 'otong@localhost')->firstOrFail();
        $gate = Gate::forUser($user);

        $contact = Contact::where('email', 'example@localhost')->firstOrFail();

        $this->assertTrue($gate->allows('get-contact', $contact));
        $this->assertTrue($gate->allows('update-contact', $contact));
        $this->assertTrue($gate->allows('delete-contact', $contact));
    }

    public function testGateResponse()
    {
        $this->seed([UserSeeder::class, ContactSeeder::class]);

        $user = User::where('email', 'otong@localhost')->firstOrFail();
        Auth::login($user);

        $response = Gate::inspect('create-contact');
        $this->assertFalse($response->allowed());
        $this->assertEquals('You are not admin', $response->message());
    }
}

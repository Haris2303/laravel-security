<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'otong@localhost')->first();

        Todo::create([
            'title' => 'Test Todo',
            'description' => 'Test todo description',
            'user_id' => $user->id,
        ]);
    }
}

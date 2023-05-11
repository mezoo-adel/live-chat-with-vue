<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::upsert([
        //     [  'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password'=>\Illuminate\Support\Facades\Hash::make('P@ssw0rd')],
        //     [  'name' => 'Test User 2',
        //     'email' => 'test@second_example.com',
        //     'password'=>\Illuminate\Support\Facades\Hash::make('P@ssw0rd')]
        // ],['email']);
        $this->call(LaratrustSeeder::class);
        $this->call(ChatRoomSeeder::class);
        $this->call(ChatMessageSeeder::class);

    }
}

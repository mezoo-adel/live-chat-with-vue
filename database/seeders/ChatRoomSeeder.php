<?php

namespace Database\Seeders;

use App\Models\ChatRoom;
use Illuminate\Database\Seeder;

class ChatRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChatRoom::upsert([
            ['name' => 'Tech Talk',],
            ['name' => 'Friends',]
        ],['name']);
    }
}

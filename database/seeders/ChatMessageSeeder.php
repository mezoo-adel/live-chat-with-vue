<?php

namespace Database\Seeders;

use App\Models\ChatMessage;
use Illuminate\Database\Seeder;

class ChatMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChatMessage::upsert([
            ['user_id' => 1,
                'room_id' => 1,
                'message' => 'this is message test in room 1 for user 1'],
                ['user_id' => 1,
                'room_id' => 1,
                'message' => 'this is message test 2 in room 1 for user 1'],
                ['user_id' => 2,
                'room_id' => 1,
                'message' => 'this is message test in room 1 for user 2'],
                ['user_id' => 2,
                'room_id' => 1,
                'message' => 'this is message test 2 in room 1 for user 2'],
                ['user_id' => 1,
                'room_id' => 1,
                'message' => 'this is message test 3 in room 1 for user 1'],
            ['user_id' => 2,
                'room_id' => 2,
                'message' => "this is message test in Room 2 for user 2"],
        ], []);
    }
}

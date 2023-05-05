<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    protected $fillable = ['name'];

    use HasFactory;
    public function chat(){
        return $this->hasMany(ChatMessage::class);
    }
}

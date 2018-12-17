<?php

namespace App\Models;

use App\Models\Access\User\User;

use Illuminate\Database\Eloquent\Model;

class SystemMessage extends Model
{
    protected $fillable=['subject', 'body', 'sent'];
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'system_message_user', 'system_message_id', 'user_id');
    }
}

<?php

namespace App\Models\Access;

use App\Models\Access\User\User;
use Illuminate\Database\Eloquent\Model;

class OauthAccessToken extends Model
{
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

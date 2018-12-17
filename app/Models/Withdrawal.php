<?php

namespace App\Models;

use App\Models\Access\User\User;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $fillable=['user_id', 'amount', 'paypal_email', 'status', 'comment'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

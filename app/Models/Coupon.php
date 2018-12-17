<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable=['course_id', 'code', 'percent', 'quantity', 'expires', 'active'];
    
    function course()
    {
        return $this->belongsTo(Course::class);
    }
    
    
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=['name', 'slug'];
    
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
}

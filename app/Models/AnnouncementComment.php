<?php


namespace App\Models;

use App\Models\Access\User\User;
use Illuminate\Database\Eloquent\Model;

class AnnouncementComment extends Model
{
    protected $fillable=['announcement_id', 'user_id', 'body'];
    
    public function announcement()
    {
        return $this->belongsTo(Announcement::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

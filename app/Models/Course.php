<?php

namespace App\Models;

use App\Models\Access\User\User;
use Cviebrock\EloquentTaggable\Taggable;
use Illuminate\Database\Eloquent\Model;


class Course extends Model
{
    
    use Taggable;
    
    protected $fillable=['title', 'subtitle', 'slug', 'user_id', 'image', 'language', 'level', 'description', 'price', 'featured', 'published', 'approved'];
    
    protected $appends = ['average_rating', 'total_reviews'];
    
    public function getAverageRatingAttribute()
    {
        return round($this->reviews()->avg('rating'),1);
    }
    
    public function getTotalReviewsAttribute()
    {
        return $this->reviews()->count();
    }
    
    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function sections()
    {
        return $this->hasMany(Section::class);
    }
    
    function coupons()
    {
        return $this->hasMany(Coupon::class);
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    
    public function students()
    {
        return $this->belongsToMany(User::class);
    }
    
    public function announcements()
    {
        return $this->belongsToMany(Announcement::class);
    }
    
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
    
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    
    public function approvals()
    {
        return $this->hasMany(Approval::class);
    }
    
    public function averageReviewRatings()
    {
        return $this->hasOne(CourseReviewRating::class);
    }
    
    public function canBeDeleted()
    {
        return (bool)! $this->students->count();
    }
    
    public function status()
    {
        if($this->approved && $this->published){
            return '<span class="label label-success">'. trans('labels.backend.courses.live-course') .'</span>';
        } elseif($this->approved && !$this->published){
            return '<span class="label label-danger">'. trans('labels.backend.courses.unpublished-by-author') .'</span>';
        } elseif(!$this->approved && $this->published){
            return '<span class="label label-warning">'. trans('labels.backend.courses.awaiting-admin-approval') .'</span>';
        } elseif(!$this->approved && !$this->published){
            return '<span class="label label-info">'. trans('labels.backend.courses.draft-course') .'</span>';
        }
    }
    
    public function statusCode()
    {
        if($this->approved && $this->published){
            return trans('strings.frontend.live');
        } elseif($this->approved && !$this->published){
            return trans('strings.frontend.unpublished');
        } elseif(!$this->approved && $this->published){
            return trans('strings.frontend.under-review');
        } elseif(!$this->approved && !$this->published){
            return trans('strings.frontend.draft');
        }
    }
    
    public function hasPreviewContent()
    {
        return (bool)Course::where('id', $this->id)->hasContent()->count();
    }
    
    // scopes
    public function scopeHasContent($query)
    {
        
        return $query->has('sections')->whereHas('sections.lessons', function($q){
    			$q->where('preview', true)
    				->whereHas('content', function($q){
    					$q->where('content_type', '=', 'video');
    				});
    			});
    }
    
    
}

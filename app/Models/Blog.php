<?php

namespace App\Models;
use App\Scopes\PublishedScope;
use App\Scopes\LangScope;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    
    protected $fillable=['title', 'blog_category_id', 'lang', 'slug', 'body', 'type', 'display_main_menu', 'display_footer', 'featured_frontend', 'published'];
    
    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }
    
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    
    // implement global scope to only show blogs that are published and are for the current set locale.
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new PublishedScope);
        static::addGlobalScope(new LangScope);
    }
}

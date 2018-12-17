<?php

namespace App\Models\Access\User;

use Laravel\Passport\HasApiTokens;
use Cmgmyr\Messenger\Traits\Messagable;
use Illuminate\Notifications\Notifiable;
use App\Models\Access\User\Traits\UserAccess;
use App\Models\Access\User\Traits\UserEnrollments;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Access\User\Traits\Scope\UserScope;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Access\User\Traits\UserSendPasswordReset;
use App\Models\Access\User\Traits\Attribute\UserAttribute;
use App\Models\Access\User\Traits\Relationship\UserRelationship;


/**
 * Class User.
 */
class User extends Authenticatable
{
    use HasApiTokens,
        UserScope,
        UserAccess,
        UserEnrollments,
        Notifiable,
        Messagable,
        SoftDeletes,
        UserAttribute,
        UserRelationship,
        UserSendPasswordReset;
    
    public function getRouteKeyName()
    {
        return 'username';
    }
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'username', 'email', 'password', 'status', 'confirmation_code', 'confirmed', 'tagline', 'bio', 'avatar', 'facebook', 'linkedin', 'twitter', 'github', 'web', 'youtube'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The dynamic attributes from mutators that should be returned with the user object.
     * @var array
     */
    protected $appends = ['full_name', 'name'];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('access.users_table');
    }
    
    
}

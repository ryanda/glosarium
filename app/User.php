<?php

namespace App;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use Sluggable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'type',
        'is_active',
    ];

    /**
     * Convert to Carbon object
     *
     * @var var
     */
    protected $dates = [
        'deleted_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = [
        'created_diff',
        'updated_diff',
        'role_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sluggable()
    {
        return [
            'username' => [
                'source' => 'name',
            ],
        ];
    }

    public function getCreatedDiffAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->diffForHumans();
    }

    public function getUpdatedDiffAttribute()
    {
        return Carbon::parse($this->attributes['updated_at'])->diffForHumans();
    }

    public function getRoleNameAttribute()
    {
        $roles = [
            'admin' => trans('user.role.admin'),
            'contributor' => trans('user.role.contributor'),
        ];

        if (!array_key_exists($this->attributes['type'], $roles)) {
            return trans('user.role.contributor');
        }

        return $roles[$this->attributes['type']];
    }

    public function glosariums()
    {
        return $this->hasMany(\App\Glosarium\Word::class);
    }

    public function glosariumWords()
    {
        return $this->hasMany(\App\Glosarium\Word::class);
    }

    public function favorites()
    {
        return $this->hasMany(\App\Glosarium\Favorite::class);
    }

    public function scopeFilter($query)
    {
        $keyword = request('keyword');

        if ($keyword) {
            $query->where('name', 'LIKE', '%' . $keyword . '%')
                ->orWhere('email', 'LIKE', '%' . $keyword . '%');
        }

        return $query;
    }
}

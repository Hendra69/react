<?php

namespace App\Models;

use App\Traits\Selectable;
use App\Traits\WithPaginatedData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable, Selectable, WithPaginatedData;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var string[]
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that are searchable.
     *
     * @var string[]
     */
    protected $searchable = [
        'name',
        'username',
        'email',
        'phone'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var string[]
     */
    protected $appends = [
        'avatar_url',
        'role',
    ];

    /**
     * Option label.
     * 
     * @return string
     */
    public function getOptionLabel()
    {
        return $this->name . ' (' . $this->role->label . ')';
    }

    /**
     * Option value.
     * 
     * @return int
     */
    public function getOptionValue()
    {
        return $this->id;
    }

    /**
     * Get avatar_url attribute
     * 
     * @return string|null
     */
    public function getAvatarUrlAttribute()
    {
        return $this->avatar_path ? asset('storage/' . $this->avatar_path) : null;
    }

    /**
     * Get role attribute
     * 
     * @return mixed|null
     */
    public function getRoleAttribute()
    {
        return $this->roles()->exists() ? $this->roles->first() : null;
    }

    /**
     * Save new avatar image.
     *
     * @return void
     */
    public function saveAvatar(UploadedFile $avatar)
    {
        $this->removeAvatar();

        $file = $avatar->store('avatars', 'public');
        $this->avatar_path = $file;
    }

    /**
     * Remove avatar image and path.
     *
     * @return void
     */
    public function removeAvatar()
    {
        if ($this->avatar_path && file_exists(storage_path('app/public/' . $this->avatar_path))) {
            Storage::delete('public/' . $this->avatar_path);
        }
    }

    /**
     * Runs query with filters.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array  $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithFilter(Builder $query, $filters = [])
    {
        // apply filters
        if (isset($filters['role'])) {
            $query->role($filters['role']);
        }

        return $query;
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Roles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the user's contributions.
     */
    public function contributions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Contribution::class);
    }

    /**
     * Get the user's role.
     */
    public function role(): Roles
    {
        return Roles::tryFrom($this->attributes['role']) ?? Roles::User;
    }

    /**
     * Get the user's role as an attribute.
     */
    public function getRoleAttribute(): Roles
    {
        return $this->role();
    }

    /**
     * Determine whether the user has a role.
     */
    public function hasRole(Roles $role): bool
    {
        return $this->role()->getPermissionLevel() >= $role->getPermissionLevel();
    }
}

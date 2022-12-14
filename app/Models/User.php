<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'username',
        'email',
        'profile_image',
        'password',
        'role',
        'status'
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
    ];

    public function creations()
    {
        return $this->hasMany(Creation::class)->orderByDesc('id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // users that are followed by this user
    public function following()
    {
        return $this
            ->belongsToMany(User::class, 'follows', 'follower_id', 'following_id')
            ->withPivot('created_at')
            ->orderByPivot('created_at', 'desc');
    }

    // users that follow this user
    public function followers()
    {
        return $this
            ->belongsToMany(User::class, 'follows', 'following_id', 'follower_id')
            ->withPivot('created_at')
            ->orderByPivot('created_at', 'desc');
    }
    
    public function report(){
        return $this->hasMany(Report::class);
    }
}

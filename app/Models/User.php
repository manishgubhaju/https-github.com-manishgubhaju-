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
        'firstname',
        'lastname',
        'suffixname',
        'username',
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
     * Get the user's avatar URL.
     *
     * @return string
     */
    public function getAvatarAttribute()
    {
        $avatarPath = $this->attributes['avatar_path'];

        // Construct the full URL to the avatar
        return $avatarPath ? url('storage/' . $avatarPath) : url('storage/default-avatar.png');
    }
     /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullnameAttribute()
    {
        $firstName = $this->attributes['firstname'];
        $middleName = $this->attributes['middlename'];
        $lastName = $this->attributes['lastname'];

        // Extract middle initial if middle name is present
        $middleInitial = $middleName ? strtoupper($middleName[0]) . '.' : '';

        // Construct full name
        return trim("{$firstName} {$middleInitial} {$lastName}");
    }
     /**
     * Get the user's middle initial.
     *
     * @return string|null
     */
    public function getMiddleinitialAttribute()
    {
        $middleName = $this->attributes['middlename'];

        // Return the first character of the middle name or null if middle name is not set
        return $middleName ? strtoupper($middleName[0]) . '.' : null;
    }
}

<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


// class User extends Authenticatable 
// {
//     public function canAccessPanel(Panel $panel): bool
//     {
//         return true; // أو تحدد conditions معينة
//     }
// }
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'theme',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    // Role constants
    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';

    /**
     * Check if the user is an admin
     */
    public function isAdmin(): bool
    {
        return $this->role && $this->role === self::ROLE_ADMIN;
    }

    /**
     * Check if the user is a regular user
     */
    public function isUser(): bool
    {
        return $this->role && $this->role === self::ROLE_USER;
    }

    //     public function canAccessPanel(Panel $panel): bool
    // {
    //     return true; // أو تحدد conditions معينة
    // }
}

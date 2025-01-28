<?php

namespace App\Models;

use App\Models\Note;
use App\Models\Role;
use App\Notifications\SendVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\CustomPasswordResetNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
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
        'dob',
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
            'password' => 'hashed',
        ];
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new CustomPasswordResetNotification($token));
    }    

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role)
    {
        // return $this->roles()->where('name', $role)->exists();
    
        // return once(function () use ($role) {
        //     return $this->roles()->where('name', $role)->exists();
        // });       
        
        $roles = once(function () {
            return $this->roles->pluck('name');
        });

        return $roles->contains($role);        
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }    

    // public function sendEmailVerificationNotification()
    // {
    //     $this->notify(new SendVerifyEmail);
    // }

}

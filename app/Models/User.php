<?php

namespace App\Models;

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
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'remember_token',
        'status_id',
        'role_id',
        'person_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
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
        'password' => 'hashed',
        'id' => 'integer',
    ];

    /**
     * The person behind this user.
     */
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    /**
     * Use person data when the user name is not set yet.
     */
    public function getNameAttribute($value)
    {
        if (!empty($value)) {
            return $value;
        }

        return $this->person?->full_name ?? $value;
    }
}

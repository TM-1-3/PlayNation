<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class User extends Authenticatable
{

    use HasFactory, Notifiable;

    protected $table = 'registered_user';

    protected $primaryKey = 'id_user';

    public $timestamps  = false;

    
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'biography',
        'profile_picture',
        'is_public',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(Label::class, 'user_label', 'id_user', 'id_label');
    }

}

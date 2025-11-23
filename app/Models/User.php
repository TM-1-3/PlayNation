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

    /**
     * Define the one-to-one relationship to the Administrator table.
     */
    public function administrator()
    {
        // 'Administrator' model, 'foreign_key', 'local_key'
        return $this->hasOne(Admin::class, 'id_admin', 'id_user');
    }

    /**
     * Check if the user is an administrator.
     *
     * @return bool
     */
    public function isAdmin()
    {
        // Use the relationship to check if an administrator record exists.
        // The 'exists()' method is efficient and avoids loading the entire admin record.
        return $this->administrator()->exists();
    }

    /**
     * The attributes that should be cast to a specific type.
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

    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(Label::class, 'user_label', 'id_user', 'id_label');
    }

}

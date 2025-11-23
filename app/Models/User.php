<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

// Import Eloquent relationship classes.
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'registered_user';

    protected $primaryKey = 'id_user';

    // Disable default created_at and updated_at timestamps for this model.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * Only these fields may be filled using methods like create() or update().
     * This protects against mass-assignment vulnerabilities.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'biography',
        'profile_picture',
        'is_public',
    ];

    /**
     * The attributes that should be hidden when serializing the model
     * (e.g., to arrays or JSON).
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to a specific type.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            // Ensures password is always hashed automatically when set.
            'password' => 'hashed',
        ];
    }

    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(Label::class, 'user_label', 'id_user', 'id_label');
    }

}

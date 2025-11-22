<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
            // Ensures password is always hashed automatically when set.
            'password' => 'hashed',
        ];
    }

    /**
     * Get the cards owned by this user.
     *
     * Defines a one-to-many relationship:
     * a user can have multiple cards.
     */
    public function cards(): HasMany
    {
        return $this->hasMany(Card::class);
    }
}

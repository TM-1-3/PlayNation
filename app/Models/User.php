<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Post;
use App\Http\Controllers\FileController;

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
    

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'id_creator', 'id_user');
    }

    public function followers(): BelongsToMany
    {
        // users that have this user as friend
        return $this->belongsToMany(User::class, 'user_friend', 'id_friend', 'id_user');
    }

    public function following(): BelongsToMany
    {
        // users this user has as friend
        return $this->belongsToMany(User::class, 'user_friend', 'id_user', 'id_friend');
    }

    public function getProfileImage() {
        return FileController::get('profile', $this->id_user);
    }

    public function verifiedUser() : hasOne {
        return $this->hasOne(VerifiedUser::class, 'id_verified', 'id_user');
    }
}

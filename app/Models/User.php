<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Post;
use App\Models\Group;
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
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_like', 'id_user', 'id_post');
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

    public function friends() {
        return $this->belongsToMany(User::class, 'user_friend', 'id_user', 'id_friend');
    }

    public function groups(){
        return $this->belongsToMany(Group::class, 'group_membership', 'id_member', 'id_group');
    }

    public function ownedGroups(){
        return $this->hasMany(Group::class, 'id_owner', 'id_user');
    }

    public function savedPosts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_save', 'id_user', 'id_post');
    }

    public function reports(): BelongsToMany
    {
        return $this->belongsToMany(Report::class, 'report_user', 'id_user', 'id_report');
    }

    public function bannedBy(): BelongsToMany
    {
        return $this->belongsToMany(Admin::class, 'admin_ban', 'id_user', 'id_admin');
    }

    public function isBanned(): bool
    {
        return $this->bannedBy()->exists();
    }
    //users I blocked
    public function blockedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_block', 'id_user', 'id_blocked');
    }
    //users that blocked me
    public function blockedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_block', 'id_blocked', 'id_user');
    }
    //check if I blocked a user
    public function hasBlocked($userId): bool
    {
        return $this->blockedUsers()->where('id_blocked', $userId)->exists();
    }
    //check if a user has blocked me
    public function isBlockedBy($userId): bool
    {
        return $this->blockedByUsers()->where('id_user', $userId)->exists();
    }
}

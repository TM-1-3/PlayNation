<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    use HasFactory;

    protected $table = 'groups';
    protected $primaryKey = 'id_group';
    public $timestamps = false; // our table doesnt have created_at/updated_at 

    protected $fillable = [
        'name',
        'description',
        'picture',
        'is_public',
        'id_owner'
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    // group owner
    // showuld connect to group_owner, but id_group_owner == id_user,

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_owner', 'id_user');
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'group_membership', 'id_group', 'id_member');
    }

    public function joinRequests(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'group_join_request', 'id_group', 'id_requester');
    }
}
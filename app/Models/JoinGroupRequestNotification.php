<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JoinGroupRequestNotification extends Model
{
    /// points to table in bd
    protected $table = 'join_group_request_notification';
    public $timestamps = false;
    
    // relation to identify the group
    public function group()
    {
        return $this->belongsTo(Group::class, 'id_group', 'id_group');
    }
}
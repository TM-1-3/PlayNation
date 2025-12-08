<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FriendRequestNotification extends Model
{
    protected $table = 'friend_request_notification';

    protected $primaryKey = 'id_notification';

    public $timestamps = false;
    
    protected $fillable = ['accepted', 'id_notification'];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FriendRequestResultNotification extends Model
{
    protected $table = 'friend_request_result_notification';

    protected $primaryKey = 'id_notification';

    public $timestamps = false;
    
    protected $fillable = ['id_notification'];
}
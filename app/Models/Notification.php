<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Notification extends Model
{
    protected $table = 'notification';
    protected $primaryKey = 'id_notification';
    public $timestamps = false; 

    protected $fillable = ['text', 'date', 'id_receiver', 'id_emitter'];

    public function emitter()
    {
        return $this->belongsTo(User::class, 'id_emitter', 'id_user');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'id_receiver', 'id_user');
    }

    public function friendRequestNotification() : hasOne {
        return $this->hasOne(FriendRequestNotification::class, 'id_notification', 'id_notification');
    }

    public function scopePendingFriendRequests($query, $userId) {
        return $query->where('id_receiver', $userId)
                     ->whereHas('friendRequestNotification', function($q) { $q->whereNull('accepted'); })
                     ->with('emitter');
    }
}
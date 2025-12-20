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

    public function joinGroupRequestNotification()
    {
        return $this->hasOne(JoinGroupRequestNotification::class, 'id_notification', 'id_notification');
    }

    public function scopePendingGroupRequests($query, $userId) {
        return $query->where('id_receiver', $userId)
                     ->whereHas('joinGroupRequestNotification', function($q) { 
                         $q->whereNull('accepted'); 
                     })
                     ->with(['emitter', 'joinGroupRequestNotification.group']); 
    }

    public function FriendRequestResultNotification()
    {
        return $this->hasOne(FriendRequestResultNotification::class, 'id_notification', 'id_notification');
    }

    public function joinGroupRequestResultNotification()
    {
        return $this->hasOne(JoinGroupRequestResultNotification::class, 'id_notification', 'id_notification');
    }

    public function privateMessageNotification()
    {
        return $this->hasOne(PrivateMessageNotification::class, 'id_notification', 'id_notification');
    }

    public function scopeFriendRequestResults($query, $userId) {
        return $query->where('id_receiver', $userId)
                     ->with('emitter'); 
    }
}
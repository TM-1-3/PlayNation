<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupMessage extends Model
{
    protected $table = 'group_message';
    protected $primaryKey = 'id_message'; 
    public $timestamps = false;
    public $incrementing = false; // parents id

    protected $fillable = ['id_message', 'id_group', 'id_sender'];

    // get text from message
    public function message()
    {
        return $this->belongsTo(Message::class, 'id_message', 'id_message');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'id_sender', 'id_user');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'id_group', 'id_group');
    }

    public function notifications()
    {
        return $this->hasMany(GroupMessageNotification::class, 'id_message', 'id_message');
    }
}
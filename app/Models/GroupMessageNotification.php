<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupMessageNotification extends Model
{
    protected $table = 'group_message_notification';
    
    protected $primaryKey = 'id_notification';

    public $incrementing = false;

    public $timestamps = false;
    
    protected $fillable = [
        'id_notification', 
        'id_message'
    ]; 

    public function notification()
    {
        return $this->belongsTo(Notification::class, 'id_notification', 'id_notification');
    }

    public function groupMessage()
    {
        return $this->belongsTo(GroupMessage::class, 'id_message', 'id_message');
    }
}

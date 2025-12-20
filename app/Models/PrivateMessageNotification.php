<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrivateMessageNotification extends Model
{
    protected $table = 'private_message_notification';
    
    protected $primaryKey = 'id_notification';

    public $incrementing = false;

    public $timestamps = false;
    
    protected $fillable = [
        'id_notification', 
        'id_message'
    ]; 

    public function message()
    {
        return $this->belongsTo(Message::class, 'id_message', 'id_message');
    }
}

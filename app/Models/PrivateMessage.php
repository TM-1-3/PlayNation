<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrivateMessage extends Model
{
    protected $table = 'private_message';
    
    // primary key 
    protected $primaryKey = 'id_message';
    
    // increment comes from parent table
    public $incrementing = false;
    
    public $timestamps = false;

    protected $fillable = [
        'id_message', 
        'id_sender', 
        'id_receiver'
    ];

    // relation with parent light
    public function message()
    {
        return $this->belongsTo(Message::class, 'id_message', 'id_message');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'id_sender', 'id_user');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'id_receiver', 'id_user');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JoinGroupRequestNotification extends Model
{
    protected $table = 'join_group_request_notification';
    
    protected $primaryKey = 'id_notification';

    public $incrementing = false;

    public $timestamps = false;
    
    protected $fillable = [
        'id_notification', 
        'id_group', 
        'accepted'
    ]; 

    public function group()
    {
        return $this->belongsTo(Group::class, 'id_group', 'id_group');
    }
}
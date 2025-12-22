<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikePostNotification extends Model
{
    protected $table = 'like_post_notification';
    protected $primaryKey = 'id_notification';
    public $incrementing = false;
    public $timestamps = false;
    
    protected $fillable = ['id_notification', 'id_post'];

    public function notification()
    {
        return $this->belongsTo(Notification::class, 'id_notification', 'id_notification');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'id_post', 'id_post');
    }
}
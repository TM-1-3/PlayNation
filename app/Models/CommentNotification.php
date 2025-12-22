<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentNotification extends Model
{
    protected $table = 'comment_notification';
    protected $primaryKey = 'id_notification';
    public $incrementing = false;
    public $timestamps = false;
    
    protected $fillable = ['id_notification', 'id_comment'];

    public function notification()
    {
        return $this->belongsTo(Notification::class, 'id_notification', 'id_notification');
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'id_comment', 'id_comment');
    }
}
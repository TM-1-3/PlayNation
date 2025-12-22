<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentTag extends Model
{
    protected $table = 'comment_tag';
    public $timestamps = false;
    
    protected $fillable = ['id_comment', 'id_user'];

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'id_comment', 'id_comment');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
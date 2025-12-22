<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'id_comment';
    public $timestamps = false;
    
    protected $fillable = ['id_post', 'id_user', 'id_reply', 'text', 'date'];
    
    public function post()
    {
        return $this->belongsTo(Post::class, 'id_post', 'id_post');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function reports(): BelongsToMany
    {
        return $this->belongsToMany(Report::class, 'report_comment', 'id_comment', 'id_report');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(CommentLike::class, 'id_comment', 'id_comment');
    }

    public function taggedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_tag', 'id_comment', 'id_user');
    }
}
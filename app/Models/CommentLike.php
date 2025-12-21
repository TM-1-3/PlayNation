<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentLike extends Model
{
    protected $table = 'comment_like';
    protected $primaryKey = null; // composite key
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['id_comment', 'id_user'];
}
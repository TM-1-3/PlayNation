<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostLike extends Model
{
    protected $table = 'post_like';
    protected $primaryKey = null; // composite key
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['id_post', 'id_user'];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'message';
    protected $primaryKey = 'id_message';
    public $timestamps = false;
    protected $appends = ['shared_post_data'];
    
    protected $fillable = ['text', 'image', 'date'];
    // creates atribute 'shares_post_data' automatically
    public function getSharedPostDataAttribute()
    {
        // searches for pattern [post:NUM] in messages txt
        if (preg_match('/\[post:(\d+)\]/', $this->text, $matches)) {
            $postId = $matches[1];
            
            // gets post and author from bd
            $post = Post::with('user')->find($postId);
            
            return $post; // returns complete post null if error
        }

        return null;
    }
}

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
        // searchers for pattern [post:num]
        if (preg_match('/\[post:(\d+)\]/', $this->text, $matches)) {
            $postId = $matches[1];
            
            // gets post n user associated
            $post = Post::with('user')->find($postId);
            
            if ($post) {
                // author img with complete path
                if ($post->user) {
                    $post->author_image = asset($post->user->getProfileImage());
                } else {
                    $post->author_image = null;
                }
                
                return $post; 
            }
        }

        return null;
    }
}

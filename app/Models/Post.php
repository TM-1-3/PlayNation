<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Storage;


class Post extends Model
{
    protected $table = 'post';

    protected $primaryKey = 'id_post';

    public $timestamps = false;

    protected $fillable = ['description', 
                           'image', 
                           'date', 
                           'id_creator',
                           ', id_group'
                        ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'id_creator', 'id_user');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'id_group', 'id_group');
    }

    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(Label::class, 'post_label', 'id_post', 'id_label');
    }

    public function savers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'post_save', 'id_post', 'id_user');
    }

    public function reports(): BelongsToMany
    {
        return $this->belongsToMany(Report::class, 'report_post', 'id_post', 'id_report');
    }

    public function getPostImage() {
        // if bd has an image associated
        if ($this->image) {
            
            // verifyes the file exists in storage
            return FileController::get('posts', $this->id_post);
        }

        // else return default image
        return asset('public/img/default-post.png');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(PostLike::class, 'id_post', 'id_post');
    }
}

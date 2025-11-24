<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    protected $table = 'post';

    protected $primaryKey = 'id_post';

    public $timestamps = false;

    protected $fillable = ['description', 
                           'image', 
                           'date', 
                           'id_creator'];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'id_creator', 'id_user');
    }

    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(Label::class, 'post_label', 'id_post', 'id_label');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Http\Controllers\FileController;


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

    public function savers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'post_save', 'id_post', 'id_user');
    }

    public function reports(): BelongsToMany
    {
        return $this->belongsToMany(Report::class, 'report_post', 'id_post', 'id_report');
    }

    public function getPostImage() {
        return FileController::get('posts', $this->id_post);
    }
}
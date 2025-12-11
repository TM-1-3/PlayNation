<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Report extends Model
{
    protected $table = 'report';

    protected $primaryKey = 'id_report';

    public $timestamps = false;

    protected $fillable = ['description'];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'report_post', 'id_report', 'id_post');
    }
}

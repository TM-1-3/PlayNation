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

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(\App\Models\User::class, 'report_user', 'id_report', 'id_user');
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Group::class, 'report_group', 'id_report', 'id_group');
    }
}

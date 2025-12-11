<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportPost extends Model
{
    protected $table = 'report_post';

    public $timestamps = false;
    
    public $incrementing = false;

    protected $fillable = ['id_report', 'id_post'];

    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class, 'id_report', 'id_report');
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'id_post', 'id_post');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $table = 'label';
    protected $primaryKey = 'id_label';
    public $timestamps = false;

    protected $fillable = ['designation', 'image'];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerifiedUser extends Model
{
    protected $table = 'verified_user';

    protected $primaryKey = 'id_verified';

    public $timestamps = false;

    protected $fillable = ['id_verified'];
}
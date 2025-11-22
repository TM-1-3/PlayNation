<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'administrator';
    protected $primaryKey = 'id_admin';

    public $timestamps = false; 

    protected $fillable = ['id_admin'];

    /**
     * Define the inverse one-to-one relationship back to the RegisteredUser.
     */
    public function user()
    {
        return $this->belongsTo(RegisteredUser::class, 'id_admin', 'id_user');
    }
}

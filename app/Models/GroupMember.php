<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    protected $table = 'group_membership';

    public $timestamps = false; 

    public $incrementing = false;

    protected $primaryKey = 'id_group';

    protected $fillable = [
        'id_group', 
        'id_member'
    ];
}
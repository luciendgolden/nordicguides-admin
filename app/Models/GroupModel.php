<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupModel extends Model
{
    protected $table = 'groups';

    protected $fillable = [
        'groupID',
        'groupname',
        'groupdescription',
        'contactpersonID'
    ];
}

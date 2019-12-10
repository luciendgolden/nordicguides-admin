<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberGroupModel extends Model
{
    protected $table = 'membergroups';

    protected $fillable = [
        'membergroupID',
        'groupID',
        'memberID',
    ];
}

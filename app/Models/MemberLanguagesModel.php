<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberLanguagesModel extends Model
{
    protected $table = 'memberlanguages';

    protected $fillable = [
        'memberlanguageID',
        'memberID',
        'language',
        'level',
    ];
}

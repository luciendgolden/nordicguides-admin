<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LanguageModel extends Model
{
    protected $table = 'languages';

    protected $primaryKey = 'language';

    protected $fillable = [
        'language',
    ];
}

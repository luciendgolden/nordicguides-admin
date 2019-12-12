<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeModel extends Model
{
    protected $table = 'fees';

    public $timestamps = false;

    protected $primaryKey = 'year';

    protected $fillable = [
        'year',
        'basicfee',
        'duedate',
        'extrafee'
    ];
}

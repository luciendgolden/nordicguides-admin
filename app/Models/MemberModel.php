<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberModel extends Model
{
    protected $table = 'members';

    protected $guarded = ['memberID'];

    protected $primaryKey = 'memberID';

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $fillable = [
        'memberID',
        'birthdate',
        'firstname',
        'lastname',
        'street',
        'city',
        'zip',
        'phone',
        'email',
        'password',
        'role',
        'driverslicense',
        'profileimage'
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }
}

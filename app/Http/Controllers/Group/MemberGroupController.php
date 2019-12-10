<?php

namespace App\Http\Controllers\Group;

use App\Http\Controllers\Controller;
use App\Models\MemberGroupModel;
use Illuminate\Http\Request;

class MemberGroupController extends Controller
{
    public function findAll(){
        return response()->json(MemberGroupModel::get(), 200);
    }
}

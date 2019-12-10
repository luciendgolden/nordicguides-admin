<?php

namespace App\Http\Controllers\Languages;

use App\Http\Controllers\Controller;
use App\Models\MemberLanguagesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberLanguagesController extends Controller
{
    public function findAll(){
        return response()->json(MemberLanguagesModel::get(), 200);
    }

    public function findById($id){
        $memberlanguages = DB::table('memberlanguages')
            ->where('memberlanguages.memberID', $id)
            ->get();

        return response()->json($memberlanguages, 200);
    }
}

<?php

namespace App\Http\Controllers\Languages;

use App\Http\Controllers\Controller;
use App\Models\LanguageModel;
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

    public function getLanguages(){
        $languages = DB::table('languages')
            ->get();

        return response()->json($languages, 200);
    }

    public function updateLanguage(Request $request, LanguageModel $language){
        $language->update($request->all());
        return response()->json($language, 200);
    }
}

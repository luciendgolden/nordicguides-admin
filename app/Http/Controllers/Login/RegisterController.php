<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Models\MemberModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    function register(Request $request){
        $email = $request->input('email');

        $members = DB::table('members')
            ->where('members.email', $email)
            ->get();

        if ($members->isEmpty()) {
            $member = MemberModel::create($request->all());
            return response()->json($member, 201);
        }else{
            return response()->json(['message' => 'email already exists'], 500);
        }
    }
}

<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use Symfony\Component\Console\Input\Input;
use \Validator;

class LoginController extends Controller
{
    public function doLogin(Request $request)
    {

        // create our user data for the authentication
        $userdata = array(
            'email' => $request->input('email'),
            'password' => $request->input('password')
        );

        $members = DB::table('members')
            ->where('members.email', $userdata['email'])
            ->get();

        if (!$members->isEmpty()) {
            foreach ($members as $member) {
                if($userdata['password'] == $member->password){
                    return response()->json($member, 200);
                }else{
                    return response()->json(['message' => 'password does not match'], 500);
                }
            }
        } else {
            return response()->json(['message' => 'Email not found'], 500);
        }
    }

}

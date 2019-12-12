<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\MemberModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function getAllFees(){
        $fees = DB::table('fees')
            ->get();

        return response()->json($fees, 200);
    }

    public function findAll()
    {
        return response()->json(MemberModel::get(), 200);
    }

    public function findById($id)
    {
        return response()->json(MemberModel::find($id), 200);
    }

    /**
     * Update Member
     */
    public function update(Request $request, MemberModel $member)
    {
        $email = $request->input('email');
        $id = $request->input('memberID');

        if ($email) {
            $members = DB::table('members')
                ->where('members.email', $email)
                ->get();

            if ($members->isEmpty()) {
                $member->update($request->all());
                return response()->json($member, 200);
            } else {
                $oldEmail = DB::table('members')
                    ->where('members.memberID', $id)
                    ->value('email');
                if ($oldEmail === $email) {
                    $member->update($request->all());
                    return response()->json($member, 200);
                } else {
                    return response()->json(['message' => 'Email already exists'], 500);
                }
            }
        } else {
            $member->update($request->all());
            return response()->json($member, 200);
        }


    }

    /**
     * Delete Member
     */
    public function memberDelete(Request $request, MemberModel $member)
    {
        $member->delete();
        return response()->json(['message' => 'success'], 204);
    }

    /**
     * Show the list of guides in a city
     */
    public function showListOfGuidesInCity($id)
    {
        /**
         * SELECT members.memberID, members.firstname, members.lastname FROM members
         * INNER JOIN membergroups ON members.memberID=membergroups.memberID
         * INNER JOIN groups ON membergroups.groupID=groups.groupID
         * INNER JOIN groupcities ON groups.groupID=groupcities.groupID WHERE groupcities.cityID=1
         */

        $members = DB::table('members')
            ->select('members.*')
            ->join('membergroups', 'members.memberID', '=', 'membergroups.memberID')
            ->join('groups', 'membergroups.groupID', '=', 'groups.groupID')
            ->join('groupcities', 'groups.groupID', '=', 'groupcities.groupID')
            ->where('groupcities.cityID', $id)
            ->get();

        return response()->json($members, 200);
    }
}

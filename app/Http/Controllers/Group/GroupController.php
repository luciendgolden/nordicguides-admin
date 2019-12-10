<?php

namespace App\Http\Controllers\Group;

use App\Http\Controllers\Controller;
use App\Models\GroupModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function findAll()
    {
        return response()->json(GroupModel::get(), 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * get membergroups for this member
     */
    public function getMemberGroupByMemberId($id)
    {
        $group = DB::table('groups')
            ->join('membergroups', 'groups.groupID', '=', 'membergroups.groupID')
            ->where('membergroups.memberID', $id)
            ->get();

        return response()->json($group, 200);
    }
}

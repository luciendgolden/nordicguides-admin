<?php

namespace App\Http\Controllers\City;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CityModel;

class CityController extends Controller
{
    public function findAll(){
        return response()->json(CityModel::get(), 200);
    }
}

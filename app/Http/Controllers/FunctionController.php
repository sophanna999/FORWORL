<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FunctionController extends Controller
{
    public function GetProvince($id) {
        $result = \App\Models\Province::where('country_id',$id)->get();
        return json_encode($result);
    }
}

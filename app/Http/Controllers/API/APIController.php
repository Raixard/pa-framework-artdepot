<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Creation;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function getCreations(){
        $creations = Creation::all();

        $respon = [
            'status' => 'succcess',
            'msg' => 'Get Data Creations Berhasil',
            'data' => $creations,
        ];
        return response()->json($respon);
    }
}

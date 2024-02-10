<?php

namespace App\Http\Controllers\Api;

use App\Models\Village;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class VillageController extends Controller
{
    public function getvillage(){
        $villages = Village::all();
        if($villages->count() > 0){
            return response()->json([
             'satus' => 200,
             'village' => $villages
            ]);
        }else{
            return response()->json([
            'status' => 404,
            'message' => 'no village found'
            ]);
        }
    }

    public function storevillage(Request $Request){
        $validator = Validator::make($Request->all(), [
            'village' =>'required',
          'region' =>'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 404,
                'message' => $validator->errors()
            ]);
        }else{
            $village = Village::create([
                'village' => $Request->village,
             'region' => $Request->region
            ]);
            if($village){
                return response()->json([
                 'status' => 201,
                 'message' => 'village created successfully',
                    'village' => $village
                ], 201);
            }else{
                return response()->json([
                 'status' => 404,
                 'message' => 'village not created'
                ], 404);
            }
        }
    }
    
}

<?php

namespace App\Http\Controllers\Api;

use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RegionController extends Controller
{
    public function index(){
        $Region = Region::all();
        if($Region->count() > 0){
            return response()->json([
                'status' => 200,
                'region' => $Region
            ]);
        }else{
            return response()->json([
             'status' => 404,
             'message' => ' no Region found'
            ]);
        }
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' =>'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
              'message' => $validator->errors()
            ], 422);
        }else{
            $region = Region::create([
                'name' => $request->name
            ]);
            if($region){
                return response()->json([
                 'status' => 201,
                 'message' => 'Region created successfully',
                 'region' => $region
                ], 201);
            }else{
                return response()->json([
               'status' => 404,
                'message' => 'Region not created'
                ], 404);
            }
        }
    }

}

<?php

namespace App\Http\Controllers;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
class LocationController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'street'=>'required',
            'building'=>'required',
            'area'=>'required'
            
        ]);
       
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        

        $location = new Location();
        $location->user_id = Auth::id();
        $location->street = $request->street;
        $location->building = $request->building;
        $location->area = $request->area;
        $location->save();
        return response()->json('location added',201);
    }

    public function update( Request $request,$id ){
        $request->validate([
            'street'=>'required',
            'building'=>'required',
            'area'=>'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        
        $location = Location::find($id);
        if($location){
        $location->street = $request->street;
        $location->building = $request->building;
        $location->area = $request->area;
        $location->save();
        return response()->json('location is updated');
        }
        else return response()->json('location not found');
        
        
    }

    public function destroy($id){
        $location= Location::find($id);
        if($location){
        $location->delete();
        return response()->json('location is deleted');

        }
        else return response()->json('location not found');
        
    }
}

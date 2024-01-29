<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use App\Models\Brand;
use Validator;
class BrandController extends Controller
{
    public function index(){
        $brands = Brand::paginate(10);
        return response()->json($brands, 200);

    }

    public function show($id){
        $brands = Brand::find($id);
        if($brand){
            return response()->json($brands, 200);
        }
        else return response()->json('brand not found');

    }


    public function store( Request $request ){
        $validator = Validator::make($request->all(),[
            'name'=>'required|unique:brands,name'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        // $booking = Booking::where('user_id',Auth::id())->first();
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->save();
        return response()->json('brand is added',201);
        
    }
    public function update( Request $request,$id ){
        $validator = Validator::make($request->all(),[
            'name'=>'required|unique:brands,name'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        
        $brand = Brand::find($id);
        $brand->name = $request->name;
        $brand->update();
        return response()->json('brand is updated');
        
        
    }

    public function destroy($id){
        $brand= Brand::find($id);
        if($brand){
        $brand->delete();
        return response()->json('brand is deleted');

        }
        else return response()->json('brand not found');
        
    }

}

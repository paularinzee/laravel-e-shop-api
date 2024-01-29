<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Validator;
class CategoryController extends Controller
{
    public function index(){
        $categories = Category::paginate(10);
        return response()->json($categories, 200);

    }

    public function show($id){
        $category = Category::find($id);
        if($category){
            return response()->json($category, 200);
        }
        else return response()->json('category not found');

    }


    public function store( Request $request ){
        $validator = Validator::make($request->all(),[
            'name'=>'required|unique:brands,name',
            'image'=>'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        // $booking = Booking::where('user_id',Auth::id())->first();
        $category = new Category();
        if($request->hasFile('image')){
            $path = 'assets/upload/category/' . $category->image;
            if (file::exists($path)){
            File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . ',' . $ext;
            try{
                $file->move('assets/uploads/category', $filename);
            }catch(FileException $e){
                dd($e);
            }   
            $category->image = $filename;

        }
        
        $category->name = $request->name;
        // $category->image = $request->image;
        $category->save();
        return response()->json('category is added',201);
        
    }
    public function update( Request $request,$id ){
        $validator = Validator::make($request->all(),[
            'name'=>'required|unique:brands,name',
            'image'=>'required'
        ]);


        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        
        $category = Category::find($id);
        if($request->hasFile('image')){
            $path = 'assets/upload/category/' . $category->image;
            if (file::exists($path)){
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . ',' . $ext;
            try{
                $file->move('assets/uploads/category', $filename);
            }catch(FileException $e){
                dd($e);
            }
            $category->image = $filename;
        }
        $category->name = $request->name;
        // $category->image = $request->image;
        $category->update();
        return response()->json('category is updated');
        
        
    }

    public function destroy($id){
        $category= Category::find($id);
        if($category){
        $category->delete();
        return response()->json('category is deleted');

        }
        else return response()->json('category not found');
        
    }
}

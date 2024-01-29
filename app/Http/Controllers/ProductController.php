<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Validator;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        $Product = Product::paginate(10);
        if($product){
            return response()->json($brands, 200);

        }else return response()->json('no products');
        

    }

    public function show($id){
        $product = Product::find($id);
        if($product){
            return response()->json($product, 200);
        }
        else return response()->json('product not found');

    }

    public function store( Request $request ){
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'price'=>'required|numeric',
            'category_id'=>'required|numeric',
            'brand_id'=>'required|numeric',
            'discount'=>'numeric',
            'amount'=>'required|numeric',
            'image'=>'required'
            
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        // $booking = Booking::where('user_id',Auth::id())->first();
        $product = new Product();
        if($request->hasFile('image')){
                $path = 'assets/upload/product/' . $product->image;
            if (file::exists($path)){
            File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . ',' . $ext;
            try{
                $file->move('assets/uploads/product', $filename);
            }catch(FileException $e){
                dd($e);
            }
            $product->image = $filename;

        }
        
        $product->name = $request->name;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->discount = $request->discount;
        $product->amount = $request->amount;
       
        $product->save();
        return response()->json('product is added',201);
        
    }

    public function update( Request $request,$id ){
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'price'=>'required|numeric',
            'category_id'=>'required|numeric',
            'brand_id'=>'required|numeric',
            'discount'=>'required|numeric',
            'amount'=>'required|numeric',
            'image'=>'required'
        ]);


        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        
        $product = Product::find($id);
        if($product){
            if($request->hasFile('image')){
                $path = 'assets/upload/product/' . $product->image;
                if (file::exists($path)){
                    File::delete($path);
                }
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $filename = time() . ',' . $ext;
                try{
                    $file->move('assets/uploads/product', $filename);
                }catch(FileException $e){
                    dd($e);
                }
                $product->image = $filename;
            }
            $product->name = $request->name;
            $product->price = $request->price;
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->discount = $request->discount;
            $product->amount = $request->amount;
           
            $product->save();
            return response()->json('product is updated');
        }
        else return response()->json('product not found');
        
        
        
    }

    public function destroy($id){
        $product= Product::find($id);
        if($product){
        $product->delete();
        return response()->json('product is deleted');

        }
        else return response()->json('product not found');
        
    }
}

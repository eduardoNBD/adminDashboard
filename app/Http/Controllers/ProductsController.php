<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;  
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function create(Request $request){
        
        $validator = Validator::make(request()->all(), [
            'name' => 'required|unique:products',
            'key' => 'required|unique:products',
            'price' => 'required|numeric'
        ],
        [
            'name.required' => 'Campo <strong>Nombre de producto</strong> requerido',
            'name.unique' => 'Ya existe un producto con ese nombre', 
            'key.required' => 'Campo <strong>Clave</strong> requerido', 
            'key.unique' => 'Ya existe un producto con esa clave', 
            'price.required' => 'Campo <strong>Precio</strong> requerido', 
            'price.numeric' => 'Campo <strong>Precio</strong> debe ser numero', 
        ]);

        if ($validator->fails()){
            $messages = "";

            foreach ($validator->messages()->toArray() as $key => $errMessages) {
                foreach ($errMessages as $key => $errMessage) {
                    $messages.= $errMessage."<br>";
                }
                
            }

            return response()->json(["status" => 0, "message" => $messages]);
        }

        
        $file = $request->file("imgProduct");
        $fileName = "";

        if($file)
        { 
            $fileName = $file->store('products');  
        }
         
        $product = new Product;
        
        $product->name   = $request->input("name");
        $product->key    = $request->input("key");
        $product->price  = $request->input("price");
        $product->image  = $fileName;
        $product->modify_by = Auth::id();
        $product->save(); 
        
        return response()->json(["status" => 1, "message" => "Producto guardado"]);
    } 

    public function update(Request $request, $id){
        
        $validator = Validator::make(request()->all(), [
            'name' => 'required|unique:products,name,'.$id,
            'key' => 'required|unique:products,key,'.$id,
            'price' => 'required|numeric'
        ],
        [
            'name.required' => 'Campo <strong>Nombre de producto</strong> requerido',
            'name.unique' => 'Ya existe un producto con ese nombre', 
            'key.required' => 'Campo <strong>Clave</strong> requerido', 
            'key.unique' => 'Ya existe un producto con esa clave', 
            'price.required' => 'Campo <strong>Precio</strong> requerido', 
            'price.numeric' => 'Campo <strong>Precio</strong> debe ser numero', 
        ]);

        if ($validator->fails()){
            $messages = "";

            foreach ($validator->messages()->toArray() as $key => $errMessages) {
                foreach ($errMessages as $key => $errMessage) {
                    $messages.= $errMessage."<br>";
                }
                
            }

            return response()->json(["status" => 0, "message" => $messages.'--'.$id]);
        }

        $product = Product::findOr($id, function () {
            return false;
        });

        if(!$product){
            return response()->json(["status" => 0, "message" => "Producto no encontrado"]);
        }

        if($product->status == 0)
        {
            return response()->json(["status" => 0, "message" => "Producto Eliminado"]);
        }

        $file = $request->file("imgProduct");
        $fileName = $product->image ? $product->image : "";
        
        if($file)
        {  
            $fileName = $file->store('products');

            if($product->image != "0" && $product->image != ""){
                unlink(storage_path("../storage/app/").'/'.$product->image);
            }  
        }
        
        $product->name   = $request->input("name");
        $product->key    = $request->input("key");
        $product->price  = $request->input("price");
        $product->image  = $fileName;
        $product->modify_by = Auth::id();
        $product->save(); 

        return response()->json(["status" => 1, "message" => "Producto guardado " ]);
    }

    public function list(Request $request){ 
        $product = new Product;
        $products = $product->where("status",1);

        if($request->input("s"))
        {
            $products->where('name', 'like', $request->input("s") . '%')
                     ->orWhere('key', 'like', $request->input("s") . '%');
        }

        $perPage = 10; 
        $page = $request->input("page") ?: 1; 
    
        $totalProducts = $products->count();

        $totalPages = ceil($totalProducts / $perPage);

        $page = min($page, $totalPages);

        $products = $products->paginate($perPage, ['id', 'name', 'key', 'price', 'image'], 'products', $page);
         
        return response()->json(["status" => 1, 'products' => $products, 's' => $request->input("s")] );
    } 

    public function delete(Request $request, $id){ 
        $product = Product::findOr($id, function () {
            return false;
        });
         
        if(!$product){
            return response()->json(["status" => 0, "message" => "Producto no encontrado"]);
        }
        
        $product->status = 0;
        $product->save(); 

        return response()->json(["status" => 1, "product" => $product]);
    }  
}


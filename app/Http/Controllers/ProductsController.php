<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\Product;
use App\Models\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;  
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function create(Request $request){
        
        $validator = Validator::make(request()->all(), [
            'name' => 'required|unique:products',
            'key' => 'required|unique:products',
            'price' => 'required|numeric',
            'qty' => 'required|numeric'
        ],
        [
            'name.required' => 'Campo <strong>Nombre de producto</strong> requerido',
            'name.unique' => 'Ya existe un producto con ese nombre', 
            'key.required' => 'Campo <strong>Clave</strong> requerido', 
            'key.unique' => 'Ya existe un producto con esa clave', 
            'price.required' => 'Campo <strong>Precio</strong> requerido', 
            'price.numeric' => 'Campo <strong>Precio</strong> debe ser numero', 
            'qty.required' => 'Campo <strong>Cantidad</strong> requerido', 
            'qty.numeric' => 'Campo <strong>Cantidad</strong> debe ser numero', 
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
        $product->qty    = $request->input("qty");
        $product->image  = $fileName;
        $product->modify_by = Auth::id();
        $product->save(); 
        
        $log = new Log;

        $log->action = "create_product";
        $log->detail = json_encode(["id" => $product->id, "name" => $product->name]);
        $log->user = Auth::id();
        
        $log->save();

        return response()->json(["status" => 1, "message" => "Producto guardado"]);
    } 

    public function update(Request $request, $id){
        
        $validator = Validator::make(request()->all(), [
            'name' => 'required|unique:products,name,'.$id,
            'key' => 'required|unique:products,key,'.$id,
            'price' => 'required|numeric',
            'qty' => 'required|numeric'
        ],
        [
            'name.required' => 'Campo <strong>Nombre de producto</strong> requerido',
            'name.unique' => 'Ya existe un producto con ese nombre', 
            'key.required' => 'Campo <strong>Clave</strong> requerido', 
            'key.unique' => 'Ya existe un producto con esa clave', 
            'price.required' => 'Campo <strong>Precio</strong> requerido', 
            'price.numeric' => 'Campo <strong>Precio</strong> debe ser numero', 
            'qty.required' => 'Campo <strong>Cantidad</strong> requerido', 
            'qty.numeric' => 'Campo <strong>Cantidad</strong> debe ser numero', 
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

        $prevData = [
            "name"  => $product->name, 
            "key"   => $product->key,              
            "price" => $product->price,
            "qty"   => $product->qty,              
            "image" => $product->image,
        ];
        
        $product->name   = $request->input("name");
        $product->key    = $request->input("key");
        $product->price  = $request->input("price");
        $product->qty    = $request->input("qty");
        $product->image  = $fileName;
        $product->modify_by = Auth::id();
        $product->save(); 

        $newData = [
            "name"  => $product->name, 
            "key"   => $product->key,              
            "price" => $product->price,
            "qty"   => $product->qty,              
            "image" => $product->image,
        ];

        $log = new Log;

        $log->action = "update_product";
        $log->detail = json_encode([
            "id" => $product->id,
            "name" =>  $product->name,
            "prevData" => $prevData,
            "newData" => $newData
        ]);

        $log->user = Auth::id();
        
        $log->save();

        return response()->json(["status" => 1, "message" => "Producto guardado " ]);
    }

    public function list(Request $request){ 
        $product = new Product;
        $products = $product->whereIn("status",$request->input("status"));

        if($request->input("s"))
        {
            $products->where(function ($query) use ($request) {
                $query->where('name', 'like', $request->input("s") . '%')
                      ->orWhere('key', 'like', $request->input("s") . '%');
            });
        }

        $perPage = 10; 
        $page = $request->input("page") ?: 1; 
    
        $totalProducts = $products->count();

        $totalPages = ceil($totalProducts / $perPage);

        $page = min($page, $totalPages);

        $products = $products->paginate($perPage, ['id', 'name', 'key', 'price', 'image','status'], 'products', $page);
         
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

        $log = new Log;

        $log->action = "delete_product";
        $log->detail = json_encode(["id" => $product->id,"name" => $product->name ]);
        $log->user = Auth::id();
        
        $log->save();

        return response()->json(["status" => 1, "product" => $product]);
    }  

    public function recover(Request $request, $id){ 
        $product = Product::findOr($id, function () {
            return false;
        });

        if(!$product){
            return response()->json(["status" => 0, "message" => "Producto no encontrado"]);
        }
        
        $product->status = 1;
        $product->save(); 

        $log = new Log;

        $log->action = "recover_product";
        $log->detail = json_encode(["id" => $product->id,"name" => $product->name ]);
        $log->user = Auth::id();
        
        $log->save();

        return response()->json(["status" => 1, "product" => $product]);
    } 
}


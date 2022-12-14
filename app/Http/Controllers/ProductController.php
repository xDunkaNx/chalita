<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Throwable;

class ProductController extends Controller
{
    function createOrUpdateProduct (Request $request) {
        try {
            $validatedData = $request->validate([
                'idCategory' => 'required|numeric',
                'productName' => 'required|string|max:255',
                'productShortName' => 'required|string|max:255',
                'whitPresentation' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'group' => 'required|in:COMIDA,BEBIDA,POSTRE',
                'precio' => 'required|numeric',
                'code' => 'required|string|max:255',
                'image' => 'required|string|max:255'
    
            ]);
            if ($request["idProduct"] == null) {
                $product = new Product;
                $product->idCategory = $validatedData["idCategory"];
                $product->productName = $validatedData["productName"];
                $product->productShortName = $validatedData["productShortName"];
                $product->description = $validatedData["description"];
                $product->whitPresentation = $validatedData["whitPresentation"];
                $product->group = $validatedData["group"];
                $product->code = $validatedData["code"];
                $product->image = $validatedData["image"];
                $product->precio = $validatedData["precio"];
                $product->isActive = 1; 
                $product->status = 1;
                $product->save();
                return 'Agregaste un nuevo producto correctamente';
            }
            else {
                $product = Product::find($request["idProduct"]);
                if ($product == null) {
                    return 'El ID del producto que intenta actualizar no existe';
                }
                $product->productName = $request["productName"];
                $product->productShortName = $validatedData["productShortName"];
                $product->description = $validatedData["description"];
                $product->whitPresentation = $validatedData["whitPresentation"];
                $product->group = $validatedData["group"];
                $product->code = $validatedData["code"];
                $product->image = $validatedData["image"];
                $product->precio = $validatedData["precio"];
                $product->isActive = 1; 
                $product->status = 1;
                $product->save();
                return 'Actualizaste el registro correctamente';
            }
        } catch (Throwable $th) {
            //report($th);
            return $th;
        }

    }
    function getProduct ()  {
        try {
            $allproduct = Product::get();
            return $allproduct;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function deleteProduct (Request $request) {
        try {
            $validatedData = $request->validate([
                'idProduct' => 'required|numeric', 
            ]);
            $idProduct = Product::find($validatedData["idProduct"]);
            if ($idProduct == null) {
               return 'el ID del producto no existe';
            }
            else 
            {
                //var_dump($idProduct);die;
                $idProduct->delete();
                return 'Eliminaste el Producto correctamente';
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductStore;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Log;

class ProductsController extends Controller
{
    public function index() 
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function show($id) 
    {
        $product = Product::find($id);
        $product->reviews = $product->reviews;
        $product->stores = $product->stores;
        return response()->json($product);
    }

    public function create(Request $request) 
    {
        // Validate the request
        $valid = $this->validateProduct($request);

        if ($valid) {
            // Save new product
            $product = new Product;
            $product->title = $request->title;
            $product->brand = $request->brand;
            $product->price = $request->price;
            $product->image = $request->image;
            $product->description = $request->description;
            $product->save();

            // Save which stores has the product
            foreach ($request->get("stores") as $store) {
                $productStore = new ProductStore;
                $productStore->product_id = $product->id;
                $productStore->store_id = $store;
                $productStore->save();
            }

            $response = [
                'success' => true
            ];
            return response()->json($response);

        } else {
            $response = [
                'success' => false
            ];
            return response()->json($response);
        }
    }

    /**
     * Validate post request with new product
     */
    private function validateProduct($request) {
        if ($request->has('title') && 
            $request->has('brand') && 
            $request->has('price') &&
            $request->has('image') &&
            $request->has('description') &&
            $request->has('stores')
        ) {
            return true;
        } else {
            return false;
        }
    }
}

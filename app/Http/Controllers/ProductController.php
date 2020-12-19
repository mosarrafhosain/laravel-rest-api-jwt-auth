<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get()->toArray();

        return $products;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "title" => "required",
            "description" => "required",
            "price" => "required"
        ]);

        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->image = $request->image;

        if ($product->save()) {
            return response()->json([
                "status" => true,
                "product" => $product
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Ops, product could not be saved."
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            "title" => "required",
            "description" => "required",
            "price" => "required"
        ]);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->image = $request->image;

        if ($product->save()) {
            return response()->json([
                "status" => true,
                "product" => $product
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Ops, product could not be updated."
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->delete()) {
            return response()->json([
                "status" => true,
                "product" => $product
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Ops, product could not be deleted."
            ]);
        }
    }
}

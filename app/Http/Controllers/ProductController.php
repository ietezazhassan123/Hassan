<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;


use App\Exceptions\ProductUserNotMatch;
use App\Exceptions\MyProductException;
use App\Exceptions\CheckUser4Deletion;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductCollection;

use App\Http\Requests\ProductValid;
use Auth;

class ProductController extends Controller
{ 


    public function __construct()
    {
        $this->middleware('auth:api')->except('index','show');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductCollection::collection(Product::all());
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductValid $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->detail = $request->detail;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->discount = $request->discount;
        $product->save();

        return Response([
            'data' => new ProductResource($product)] , Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductValid $request, Product $product)
    {
       $this->checkUserNow($product);
       $product->update($request->all());
       return Response([
            'data' => new ProductResource($product)] , Response::HTTP_CREATED);
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->CheckUserForDelete($product);
        $product->delete();
        return "Product Deleted Successfully";
    }


    public function CheckUserCredential($product)
    {
        if(Auth::id() !== $product->user_id)
        {
            throw new ProductUserNotMatch; 
        }
    }



    public function checkUserNow($product)
    {
          if(Auth::id() !== $product->user_id)
          {
            throw new MyProductException; 
          }
    }


    public function CheckUserForDelete($product)
    {
         if(Auth::id() !== $product->user_id)
         {
            throw new CheckUser4Deletion;
         }
    }
}

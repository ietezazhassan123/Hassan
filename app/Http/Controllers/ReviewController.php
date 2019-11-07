<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;
use App\Http\Resources\ReviewResource;
use App\Http\Requests\ReviewRequest;
use Illuminate\Http\Response;
use App\Exceptions\Reviewdelete;
use App\Product;


class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product_id)
    {
        
         return  ReviewResource::collection($product_id->review);
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
    public function store(ReviewRequest $request,Product $product_id)
    {
        $review = new Review;
        $review->product_id = $product_id->id;
        $review->customer = $request->customer;
        $review->review = $request->review;
        $review->star = $request->star;
        $review->save();

        return response()->json([
            'Date'=>new ReviewResource($review)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product_id,Review $review)
    {
        $this->checkReviewDeletion($product_id,$review);
        $review->delete();
        return response()->json([
            'data'=>'Review deleted Successfully'
        ],Response::HTTP_NO_CONTENT);
    } 


    public function checkReviewDeletion($product_id , $review)
    {
        if($product_id->id !== $review->product_id)
        {
            throw new Reviewdelete;
        }
    }
}

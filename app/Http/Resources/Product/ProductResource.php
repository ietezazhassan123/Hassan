<?php

namespace App\Http\Resources\Product;


use Illuminate\Http\Resources\Json\JsonResource;
use App\Review;


class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
           'name' =>$this->name ,
           'description' => $this->detail ,
           'price' => $this->price ,
           'stock' => $this->stock==0 ? 'Out of stock' : $this->stock,
           'discount' => $this->discount,
           'total_Price' => round((1-($this->discount/100)) * $this->price,2),
           'rating' => round($this->review->sum('star') / $this->review->count(),2) == 0 ? 'No Rating' : round($this->review->sum('star') / $this->review->count(),2),
           'reviews' => route('reviews.index',$this->id)
        ];
    }
}

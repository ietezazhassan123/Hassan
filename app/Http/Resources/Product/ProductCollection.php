<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\Resource;

class ProductCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'name'=>$this->name ,
            'rating'=> $this->review->count()==0 ? 'No Rating' : round($this->review->sum('star')/$this->review->count(),2),
            'total_price'=> round((1-($this->discount/100))*$this->price,2),
            'href' => [
                'link' => route('products.show',$this->id)
            ]
        ];
    }
}

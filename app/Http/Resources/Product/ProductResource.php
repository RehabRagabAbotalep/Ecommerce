<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'id'         =>$this->id,
            'name'       =>$this->name,
            'description'=>$this->description,
            'price'      =>$this->price,
            'code'       =>$this->code,
            'image'      =>$this->image,
            'discount'   =>$this->discount,
            'total_price' =>round((1-($this->discount/100))*$this->price,2),
            'rate' => $this->review->count() >0 ?round($this->review->sum('star')/$this->review->count(),2):"No Rating",
            'href'=>[
                'Reviews' =>route('reviews.index',$this->id)
            ]
        ];
    }
}

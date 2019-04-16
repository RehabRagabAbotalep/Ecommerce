<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'id' =>$this->id,
            'total_price' =>$this->total_price,
            'quantity' =>$this->quantity,
            'status' =>$this->status,
            'href' =>[
                'products'=>route('order.products',$this->id)
            ],
            
        ];
    }
}

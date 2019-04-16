<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'review' => $this->review,
            'star'  => $this->star,
            //'rate'  =>($this->review->sum('star'))/($this->review->count()),
            'user_id' => $this->user_id,
            'href' =>[
                'Userdetails' =>route('users.show',$this->user_id)
            ]
        ];
    }
}
